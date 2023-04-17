<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once('siteConfig.php');

$decryptionKey = $_SESSION['SECURITY_FIRST_PRIVATE_KEY'];
$encryptedString = $_POST['data'];

$res = openssl_get_privatekey($decryptionKey);
openssl_private_decrypt(base64_decode($encryptedString), $decryptedData, $res);

$formData = array();
parse_str($decryptedData, $formData);
var_dump($formData);

// Encrypt security questions prior to account creation
$encIV = $_SESSION['USER_IV'];
$userRole = encryptData('USER', $encIV);
$userStatus = 0;
$questionOne = encryptData($formData['sec-question-01'], $encIV);
$answerOne = encryptData($formData['sec-answer-01'], $encIV);
$questionTwo = encryptData($formData['sec-question-02'], $encIV);
$answerTwo = encryptData($formData['sec-answer-02'], $encIV);
$questionThree = encryptData($formData['sec-question-03'], $encIV);
$answerThree = encryptData($formData['sec-answer-03'], $encIV);

// Insert encrypted security questions data to MySQL database
$DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$updateUserAccount = $DB_CONNECTION->prepare("UPDATE `users` SET `Role` = ?, `Active` = ?, `secQuestion01` = ?, `secAnswer01` = ?, `secQuestion02` = ?, `secAnswer02` = ?, `secQuestion03` = ?, `secAnswer03` = ? WHERE ID = ?");
$updateUserAccount->bind_param("ssssssssi", $userRole, $userStatus, $questionOne, $answerOne, $questionTwo, $answerTwo, $questionThree, $answerThree, $_SESSION['USER_TABLE_ID']);
$updateUserAccount->execute();
?>