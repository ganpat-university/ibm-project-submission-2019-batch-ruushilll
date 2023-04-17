<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once('siteConfig.php');
require_once('BrowserDetection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require('Exception.php');
require('PHPMailer.php');
require('SMTP.php');

// Initialize necessary variables
$_SESSION['EMAIL_VERIFICATION_OTP'] = strtoupper(bin2hex(openssl_random_pseudo_bytes(16)));
$_SESSION['EMAIL_VERIFICATION_OTP_IV'] = openssl_random_pseudo_bytes(16);
$_SESSION['OTP_REQUEST_TIME'] = time();
$cipherText = str_replace('=', '', base64_encode(openssl_encrypt($_SESSION['EMAIL_VERIFICATION_OTP'], $AES_ENCRYPTION_ALG, $AES_ENCRYPTION_PASSPHRASE, $AES_ENCRYPTION_OPTION, $_SESSION['EMAIL_VERIFICATION_OTP_IV'])));
$timeStamp = date('F d, Y, h:i A (T)');
$decryptionKey = $_SESSION['REGISTER_PRIVATE_KEY'];
$encryptedString = $_POST['data'];

// Access RSA private key
$formData = array();
$rsaResult = openssl_get_privatekey($decryptionKey);
openssl_private_decrypt(base64_decode($encryptedString), $decryptedData, $rsaResult);
parse_str($decryptedData, $formData);

// Set user's data to session variables in an encrypted manner
$saltValue = bin2hex(openssl_random_pseudo_bytes(16));
$hashedPassword = hash_pbkdf2("sha512", $formData["passwordOne"], $saltValue, 1000, 64);
$encIV = openssl_random_pseudo_bytes(16);
$_SESSION['USER_IV'] = $encIV;
$_SESSION['USER_DB_IV'] = str_replace('==', '', base64_encode($encIV));
$_SESSION['NAME'] = encryptData($formData['name'], $encIV);
$_SESSION['USER_MOBILE'] = encryptData($formData['mobile'], $encIV);
$_SESSION['USER_EMAIL'] = encryptData($formData['email'], $encIV);
$_SESSION['USER_PASSWORD_SALT'] = encryptData($saltValue, $encIV);
$_SESSION['USER_PASSWORD'] = encryptData($hashedPassword, $encIV);
$dbTimeStamp = encryptData(date('Y-m-d h:i:s'), $encIV);

// Insert encrypted data to MySQL database
$DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$updateUserAccount = $DB_CONNECTION->prepare("INSERT INTO `users` (`IV`, `Name`, `Mobile`, `Email`, `Salt`, `Password`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$updateUserAccount->bind_param("sssssss", $_SESSION['USER_DB_IV'], $_SESSION['NAME'], $_SESSION['USER_MOBILE'], $_SESSION['USER_EMAIL'], $_SESSION['USER_PASSWORD_SALT'], $_SESSION['USER_PASSWORD'], $dbTimeStamp);
$updateUserAccount->execute();
$_SESSION['USER_TABLE_ID'] = mysqli_insert_id($DB_CONNECTION);

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
$verificationMail->Subject = '[' . $TITLE_NAME . '] Email Verification Code';
$verificationMail->Body = '<!DOCTYPE html><html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml"><head><title></title><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><style>@import url(\'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap\');*{box-sizing: border-box;font-family: \'IBM Plex Sans\', sans-serif;}body{margin: 0;padding: 0;}a[x-apple-data-detectors]{color: inherit !important;text-decoration: inherit !important;}#MessageViewBody a{color: inherit;text-decoration: none;}p{line-height: inherit}.desktop_hide,.desktop_hide table{mso-hide: all;display: none;max-height: 0px;overflow: hidden;}@media (max-width:520px){.desktop_hide table.icons-inner{display: inline-block !important;}.icons-inner{text-align: center;}.icons-inner td{margin: 0 auto;}.row-content{width: 100% !important;}.mobile_hide{display: none;}.stack .column{width: 100%;display: block;}.mobile_hide{min-height: 0;max-height: 0;max-width: 0;overflow: hidden;font-size: 0px;}.desktop_hide,.desktop_hide table{display: table !important;max-height: none !important;}}</style></head><body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;"><table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; background-color: #FFFFFF; width: 500px;" width="500"><tbody><tr><td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="image_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:30px;"><div align="center" class="alignment" style="line-height:10px"><img src="https://i.ibb.co/f1zWrpY/sasdac.png" style="display: block; height: auto; border: 0; width: 151px; max-width: 100%;" width="151"/></div></td></tr></table><table border="0" cellpadding="0" cellspacing="0" class="divider_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:40px;"><div align="center" class="alignment"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #144ee3;"><span></span></td></tr></table></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; border-radius: 0; color: #000000; width: 500px;" width="500"><tbody><tr><td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad" style="text-align:center;width:100%;padding-top:30px;"><h1 style="margin: 0; color: #0b101b; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 20px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Hey ' . $formData['name'] . '</span></h1></td></tr></table><table border="0" cellpadding="0" cellspacing="0" class="paragraph_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"><tr><td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:40px;"><div style="color:#0b101b;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;"><p style="margin: 0; margin-bottom: 16px;">Thanks for registering for the ' . $TITLE_NAME . '; we have received a request to activate your account. Please enter the following code to show that it\'s really you. If you don\'t recognise <a href="mailto:' . $formData['email'] . '" rel="noopener" style="text-decoration: none; color: #144ee3;" target="_blank" title="' . $formData['email'] . '">' . $formData['email'] . '</a>, someone was trying to register an account linked to this email, below is what we\'ve captured.</p><p style="margin: 0; margin-bottom: 16px;"></p><p style="margin: 0; margin-bottom: 16px;">Date: ' . $timeStamp . '<br/>Device: ' . $emailMsg . '<br/>Location: ' . $cityName . ', ' . $countryName . '</p><p style="margin: 0;"></p></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="button_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"><tr><td class="pad"><div align="center" class="alignment"><div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#144ee3;border-radius:4px;width:auto;border-top:0px solid transparent;font-weight:400;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:14px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="word-break: break-word; line-height: 28px;">' . $cipherText . '</span></span></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="paragraph_block block-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"><tr><td class="pad"><div style="color:#0b101b;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;"><p style="margin: 0; margin-bottom: 16px;"></p><p style="margin: 0; margin-bottom: 16px;">The content of this email is classified as confidential and intended for the recipient specified in the message only. If you received this message by mistake, please reply to it or mail us at  <a href="mailto:security@sasdac.in" rel="noopener" style="text-decoration: none; color: #144ee3;" target="_blank" title="security@sasdac.in">security@sasdac.in</a> and follow up with its deletion so that we can ensure such an error does not occur in the future. </p><p style="margin: 0; margin-bottom: 16px;"></p><p style="margin: 0;">~ ' . $TITLE_NAME . ' Security team</p></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>';
$verificationMail->AddAddress($formData['email'], $formData['name']);
$verificationMail->Send();

// Encrypt email data prior to log creation
$emailIV = openssl_random_pseudo_bytes(16);
$emailEncIV = str_replace('==', '', base64_encode($emailIV));
$encMessageID = encryptData($messageID, $emailIV);
$encRecipientName = encryptData($formData['name'], $emailIV);
$encSubject = encryptData('[' . $TITLE_NAME . '] Email Verification Code', $emailIV);
$encVerificationOTP = encryptData($_SESSION['EMAIL_VERIFICATION_OTP'], $emailIV);
$encTimeStamp = encryptData(date('Y-m-d h:i:s'), $emailIV);

// Insert encrypted email log to MySQL database
$DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$updateUserAccount = $DB_CONNECTION->prepare("INSERT INTO `emails` (`IV`, `messageID`, `recipientName`, `emailSubject`, `emailCode`, `TimeStamp`) VALUES (?, ?, ?, ?, ?, ?)");
$updateUserAccount->bind_param("ssssss", $emailEncIV, $encMessageID, $encRecipientName, $encSubject, $encVerificationOTP, $encTimeStamp);
$updateUserAccount->execute();
?>