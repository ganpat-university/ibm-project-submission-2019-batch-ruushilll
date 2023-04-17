<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once('siteConfig.php');

if (isset($_SESSION['AUTH_VALID'])) {
    if ($_SESSION['AUTH_VALID'] == true) {
        header('Location: verify');
    }
    else {
        echo '<script>window.location.href = "login";</script>';
        die();
    }
}
if (isset($_SESSION['AUTH_ERROR'])) {
    echo '<script>alert("' . $_SESSION['AUTH_ERROR'] . '"); window.location.href = "login"; </script>';
    die();
}
?>