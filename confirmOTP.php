<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once('siteConfig.php');

$decryptionKey = $_SESSION['VERIFY_PRIVATE_KEY'];
$encryptedString = $_POST['data'];

$res = openssl_get_privatekey($decryptionKey);
openssl_private_decrypt(base64_decode($encryptedString), $decryptedData, $res);

$formData = array();
parse_str($decryptedData, $formData);

$encryptedCode = base64_decode($formData['code']);
$actualOTP = openssl_decrypt($encryptedCode, $AES_ENCRYPTION_ALG, $AES_ENCRYPTION_PASSPHRASE, $AES_ENCRYPTION_OPTION, $_SESSION['USER_AUTH_VERIFICATION_OTP_IV']);

if ($actualOTP == $_SESSION['USER_AUTH_VERIFICATION_OTP'])
    $_SESSION['USER_AUTH_VALID'] = true;
else   
    $_SESSION['USER_AUTH_VALID'] = false;
?>