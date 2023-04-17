<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set("Asia/Kolkata");
require_once('siteConfig.php');
require_once('BrowserDetection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require('Exception.php');
require('PHPMailer.php');
require('SMTP.php');

unset($_SESSION['AUTH_ERROR']);
unset($_SESSION['AUTH_VALID']);

$decryptionKey = $_SESSION['LOGIN_PRIVATE_KEY'];
$encryptedString = $_POST['data'];

$res = openssl_get_privatekey($decryptionKey);
openssl_private_decrypt(base64_decode($encryptedString), $decryptedData, $res);

$formData = array();
parse_str($decryptedData, $formData);

var_dump($formData);
$DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$updateUserAccount = $DB_CONNECTION->query("SELECT `ID`, `IV`, `Name`, `Mobile`, `Email`, `Role`, `Active`, `Salt`, `Password`, `accessCount` FROM `users`;");
$dbUsers = $updateUserAccount->fetch_all();
$validUser = false;
foreach ($dbUsers as $userAccount) 
{
    $userEmail = decryptData($userAccount[4], $userAccount[1]);
    $dbHashedPassword = decryptData($userAccount[8], $userAccount[1]);
    $dbSaltVal = decryptData($userAccount[7], $userAccount[1]);
    if (($userEmail == $formData['email']) && ($dbHashedPassword == hash_pbkdf2("sha512", $formData["password"], $dbSaltVal, 1000, 64)))
    {
        $validUser = true;
        break;
    }
}

if ($validUser == true) 
{
    $userName = decryptData($userAccount[2], $userAccount[1]);
    $userMobile = decryptData($userAccount[3], $userAccount[1]);
    $userEmail = decryptData($userAccount[4], $userAccount[1]);
    $userRole = decryptData($userAccount[5], $userAccount[1]);
    if ($userAccount[6] == 1) 
    {
        $ipAddress = json_decode(file_get_contents("https://httpbin.org/ip"), true)['origin'];
        $ipReputationScore = getIPReputation($ipAddress);

        if ($ipReputationScore <= 1)
        {
            $_SESSION['USER_NAME'] = $userName;
            $_SESSION['USER_EMAIL'] = $formData['email'];
            $_SESSION['USER_AUTH_VERIFICATION_OTP'] = strtoupper(bin2hex(openssl_random_pseudo_bytes(16)));
            $_SESSION['USER_AUTH_VERIFICATION_OTP_IV'] = openssl_random_pseudo_bytes(16);
            $_SESSION['USER_AUTH_OTP_REQUEST_TIME'] = time();
            $cipherText = str_replace('=', '', base64_encode(openssl_encrypt($_SESSION['USER_AUTH_VERIFICATION_OTP'], $AES_ENCRYPTION_ALG, $AES_ENCRYPTION_PASSPHRASE, $AES_ENCRYPTION_OPTION, $_SESSION['USER_AUTH_VERIFICATION_OTP_IV'])));
            $timeStamp = date('F d, Y, h:i A (T)');
    
            // Initialize browser and geo-location detection tags
            $browserData = new BrowserDetection();
            $userAgent = $_SERVER["HTTP_USER_AGENT"];
            $browserData = $browserData->getAll($userAgent);
            $emailMsg = $browserData["browser_name"] . " on " . $browserData["os_title"];
    
            // Invoke geo-location API
            $userIPAddress = json_decode(file_get_contents("https://httpbin.org/ip"), true)["origin"];
            $geoLocationAPIURL = json_decode(file_get_contents("http://ip-api.com/json/$userIPAddress"), true);
            $countryName = $geoLocationAPIURL["country"];
            $regionName = $geoLocationAPIURL["regionName"];
            $cityName = $geoLocationAPIURL["city"];
            $zipCode = $geoLocationAPIURL["zip"];
            $latitudeValue = $geoLocationAPIURL["lat"];
            $longitudeValue = $geoLocationAPIURL["lon"];
            $ispName = $geoLocationAPIURL["isp"];
            $orgName = $geoLocationAPIURL["org"];
            $asName = $geoLocationAPIURL["as"];
    
            // Send verification mail to end-user
            $messageID = getMessageID();
            $verificationMail = new PHPMailer;
            $verificationMail->CharSet = 'utf-8';
            $verificationMail->IsSMTP();
            $verificationMail->SMTPDebug = 0;
            $verificationMail->SMTPAuth = true;
            $verificationMail->SMTPSecure = 'ssl';
            $verificationMail->Host = $EMAIL_HOSTNAME;
            $verificationMail->Port = $EMAIL_PORT;
            $verificationMail->IsHTML(true);
            $verificationMail->Username = $EMAIL_USERNAME;
            $verificationMail->Password = $EMAIL_APP_PASSWORD;
            $verificationMail->From = $EMAIL_USERNAME;
            $verificationMail->FromName = $TITLE_NAME;
            $verificationMail->MessageID = $messageID;
            $verificationMail->Subject = '[' . $TITLE_NAME . '] Authentication Code';
            $verificationMail->Body = '<!DOCTYPE html><html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml"><head><title></title><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><style>@import url(\'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap\');*{box-sizing: border-box;font-family: \'IBM Plex Sans\', sans-serif;}body{margin: 0;padding: 0;}a[x-apple-data-detectors]{color: inherit !important;text-decoration: inherit !important;}#MessageViewBody a{color: inherit;text-decoration: none;}p{line-height: inherit}.desktop_hide,.desktop_hide table{mso-hide: all;display: none;max-height: 0px;overflow: hidden;}@media (max-width:520px){.desktop_hide table.icons-inner{display: inline-block !important;}.icons-inner{text-align: center;}.icons-inner td{margin: 0 auto;}.row-content{width: 100% !important;}.mobile_hide{display: none;}.stack .column{width: 100%;display: block;}.mobile_hide{min-height: 0;max-height: 0;max-width: 0;overflow: hidden;font-size: 0px;}.desktop_hide,.desktop_hide table{display: table !important;max-height: none !important;}}</style></head><body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;"><table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; background-color: #FFFFFF; width: 500px;" width="500"><tbody><tr><td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="image_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:30px;"><div align="center" class="alignment" style="line-height:10px"><img src="https://i.ibb.co/f1zWrpY/sasdac.png" style="display: block; height: auto; border: 0; width: 151px; max-width: 100%;" width="151"/></div></td></tr></table><table border="0" cellpadding="0" cellspacing="0" class="divider_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:40px;"><div align="center" class="alignment"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #144ee3;"><span></span></td></tr></table></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; border-radius: 0; color: #000000; width: 500px;" width="500"><tbody><tr><td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad" style="text-align:center;width:100%;padding-top:30px;"><h1 style="margin: 0; color: #0b101b; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 20px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Hey ' . $userName . '</span></h1></td></tr></table><table border="0" cellpadding="0" cellspacing="0" class="paragraph_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"><tr><td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:40px;"><div style="color:#0b101b;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;"><p style="margin: 0; margin-bottom: 16px;">We have received a request to login to your account. Please enter the following code to show that it\'s really you. If you don\'t recognise this action on <a href="mailto:' . $formData['email'] . '" rel="noopener" style="text-decoration: none; color: #144ee3;" target="_blank" title="' . $formData['email'] . '">' . $formData['email'] . '</a>, someone was trying to login to your account linked to this email, below is what we\'ve captured.</p><p style="margin: 0; margin-bottom: 16px;"></p><p style="margin: 0; margin-bottom: 16px;">Date: ' . $timeStamp . '<br/>Device: ' . $emailMsg . '<br/>Location: ' . $cityName . ', ' . $countryName . '</p><p style="margin: 0;"></p></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="button_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad"><div align="center" class="alignment"><div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#144ee3;border-radius:4px;width:auto;border-top:0px solid transparent;font-weight:400;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:14px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="word-break: break-word; line-height: 28px;">' . $cipherText . '</span></span></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="paragraph_block block-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"><tr><td class="pad"><div style="color:#0b101b;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;"><p style="margin: 0; margin-bottom: 16px;"></p><p style="margin: 0; margin-bottom: 16px;">The content of this email is classified as confidential and intended for the recipient specified in the message only. If you received this message by mistake, please reply to it or mail us at  <a href="mailto:security@sasdac.in" rel="noopener" style="text-decoration: none; color: #144ee3;" target="_blank" title="security@sasdac.in">security@sasdac.in</a> and follow up with its deletion so that we can ensure such an error does not occur in the future. </p><p style="margin: 0; margin-bottom: 16px;"></p><p style="margin: 0;">~ ' . $TITLE_NAME . ' Security team</p></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>';
            $verificationMail->AddAddress($formData['email'], $formData['name']);
            $verificationMail->Send();
    
            // Encrypt email data prior to log creation
            $emailIV = openssl_random_pseudo_bytes(16);
            $emailEncIV = str_replace('==', '', base64_encode($emailIV));
            $encMessageID = encryptData($messageID, $emailIV);
            $encRecipientName = encryptData($userName, $emailIV);
            $encSubject = encryptData('[' . $TITLE_NAME . '] Authentication Code', $emailIV);
            $encVerificationOTP = encryptData($_SESSION['USER_AUTH_VERIFICATION_OTP'], $emailIV);
            $encTimeStamp = encryptData(date('Y-m-d h:i:s'), $emailIV);
                    
            // Insert encrypted email log to MySQL database
            $updateUserAccount = $DB_CONNECTION->prepare("INSERT INTO `emails` (`IV`, `messageID`, `recipientName`, `emailSubject`, `emailCode`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?)");
            $updateUserAccount->bind_param("ssssss", $emailEncIV, $encMessageID, $encRecipientName, $encSubject, $encVerificationOTP, $encTimeStamp);
            $updateUserAccount->execute();

            // Encrypt login data prior to log creation
            $loginIV = openssl_random_pseudo_bytes(16);
            $loginEncIV = str_replace('==', '', base64_encode($loginIV));
            $encUserName = encryptData($userName, $loginIV);
            $encUserEmail = encryptData($userEmail, $loginIV);
            $encUserIP = encryptData($ipAddress, $loginIV);
            $encUserScore = encryptData($ipReputationScore, $loginIV);
            $encUserStatus = encryptData((int)true, $loginIV);
            $encUserTimeStamp = encryptData(date('Y-m-d h:i:s'), $loginIV);

            // Insert encrypted login request to MySQL database
            $createLoginRequest = $DB_CONNECTION->prepare("INSERT INTO `logins` (`IV`, `Name`, `Email`, `ipAddress`, `Score`, `Status`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $createLoginRequest->bind_param("sssssss", $loginEncIV, $encUserName, $encUserEmail, $encUserIP, $encUserScore, $encUserStatus, $encUserTimeStamp);
            $createLoginRequest->execute();
    
            // Increment access count variable for current user
            $newAccessCount = (int)$userAccount[9] + 1;
            $tempUserID = $userAccount[0];
            $updateUserAccount = $DB_CONNECTION->prepare("UPDATE `users` SET accessCount = ?, lastLogin = ? WHERE `ID` = ?;");
            $updateUserAccount->bind_param("ssi", $newAccessCount, $encUserTimeStamp, $tempUserID);
            $updateUserAccount->execute();

            $_SESSION['AUTH_VALID'] = true;
        }
        else
        {
            // Encrypt login data prior to log creation
            $loginIV = openssl_random_pseudo_bytes(16);
            $loginEncIV = str_replace('==', '', base64_encode($loginIV));
            $encUserName = encryptData($userName, $loginIV);
            $encUserEmail = encryptData($userEmail, $loginIV);
            $encUserIP = encryptData($ipAddress, $loginIV);
            $encUserScore = encryptData($ipReputationScore, $loginIV);
            $encUserStatus = encryptData((int)false, $loginIV);
            $encUserTimeStamp = encryptData(date('Y-m-d h:i:s'), $loginIV);

            // Insert encrypted login request to MySQL database
            $DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
            $createLoginRequest = $DB_CONNECTION->prepare("INSERT INTO `logins` (`IV`, `Name`, `Email`, `ipAddress`, `Score`, `Status`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $createLoginRequest->bind_param("sssssss", $loginEncIV, $encUserName, $encUserEmail, $encUserIP, $encUserScore, $encUserStatus, $encUserTimeStamp);
            $createLoginRequest->execute();

            $_SESSION['AUTH_ERROR'] = 'Hi there, you are not authorized to access the application from the IP address, please try again from a different network!';
        }
    }
    else 
    {
        $ipAddress = json_decode(file_get_contents("https://httpbin.org/ip"), true)['origin'];
        $ipReputationScore = getIPReputation($ipAddress);

        // Encrypt login data prior to log creation
        $loginIV = openssl_random_pseudo_bytes(16);
        $loginEncIV = str_replace('==', '', base64_encode($loginIV));
        $encUserName = encryptData($userName, $loginIV);
        $encUserEmail = encryptData($userEmail, $loginIV);
        $encUserIP = encryptData($ipAddress, $loginIV);
        $encUserScore = encryptData($ipReputationScore, $loginIV);
        $encUserStatus = encryptData((int)false, $loginIV);
        $encUserTimeStamp = encryptData(date('Y-m-d h:i:s'), $loginIV);

        // Insert encrypted login request to MySQL database
        $DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        $createLoginRequest = $DB_CONNECTION->prepare("INSERT INTO `logins` (`IV`, `Name`, `Email`, `ipAddress`, `Score`, `Status`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $createLoginRequest->bind_param("sssssss", $loginEncIV, $encUserName, $encUserEmail, $encUserIP, $encUserScore, $encUserStatus, $encUserTimeStamp);
        $createLoginRequest->execute();

        $_SESSION['AUTH_ERROR'] = 'Hi there, your account seems to have been locked, this could possibly be due to your account not being activated by the administrators or a temporary lock for security reasons. Please try again in a while!';
    }
}
else 
{
    $ipAddress = json_decode(file_get_contents("https://httpbin.org/ip"), true)['origin'];
    $ipReputationScore = getIPReputation($ipAddress);
    
    // Encrypt login data prior to log creation
    $tempUserMail = $formData['email'];
    $loginIV = openssl_random_pseudo_bytes(16);
    $loginEncIV = str_replace('==', '', base64_encode($loginIV));
    $encUserName = encryptData('NA', $loginIV);
    $encUserEmail = encryptData($tempUserMail, $loginIV);
    $encUserIP = encryptData($ipAddress, $loginIV);
    $encUserScore = encryptData($ipReputationScore, $loginIV);
    $encUserStatus = encryptData((int)false, $loginIV);
    $encUserTimeStamp = encryptData(date('Y-m-d h:i:s'), $loginIV);
    
    // Insert encrypted login request to MySQL database
    $DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $createLoginRequest = $DB_CONNECTION->prepare("INSERT INTO `logins` (`IV`, `Name`, `Email`, `ipAddress`, `Score`, `Status`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $createLoginRequest->bind_param("sssssss", $loginEncIV, $encUserName, $encUserEmail, $encUserIP, $encUserScore, $encUserStatus, $encUserTimeStamp);
    $createLoginRequest->execute();

    $_SESSION['AUTH_ERROR'] = 'We couldn\'t verify your identity, please head over to registration to create an account. If this issue still persists, feel free to contact us.';
}
?>