<?php
/* GLOBAL VARIABLES */
$TITLE_NAME = 'SASDAC';

/* DATABASE VARIABLES */
$DB_HOSTNAME = '';      // Remote or localhost database endpoint
$DB_USERNAME = '';      // Database user
$DB_PASSWORD = '';      // Database password
$DB_NAME = '';          // Database name

/* ENCRYPTION VARIABLES */
$RSA_DIGEST_ALG = 'SHA256';
$RSA_KEY_BITS = 4096;
$RSA_KEY_TYPE = OPENSSL_KEYTYPE_RSA;

$AES_ENCRYPTION_ALG = 'AES-256-XTS';
$AES_ENCRYPTION_PASSPHRASE = 'v9y$B&E(H+MbQeThWmZq4t7w!z%C*F-J@NcRfUjXn2r5u8x/A?D(G+KbPdSg';
$AES_ENCRYPTION_OPTION = OPENSSL_RAW_DATA;

$AES_PRIMARY_ENCRYPTION_ALG = 'AES-256-CTR';
$AES_PRIMARY_ENCRYPTION_PASSPHRASE = 'JaNdRgUkX2r5u8x/A?D(G+KbPeShVmYq';
$AES_PRIMARY_ENCRYPTION_OPTION = OPENSSL_RAW_DATA;

/* EMAIL CREDENTIALS */
$EMAIL_HOSTNAME = 'smtp.gmail.com';
$EMAIL_PORT = 465;
$EMAIL_USERNAME = '';       // Email ID for SMTP
$EMAIL_APP_PASSWORD = '';   // Email application password for third party authentication

/* ENCRYPT DATA */
function encryptData($inputString, $initVector) {
    return str_replace('=', '', base64_encode(openssl_encrypt($inputString, 'AES-256-CTR', 'JaNdRgUkX2r5u8x/A?D(G+KbPeShVmYq', OPENSSL_RAW_DATA, $initVector)));
}

/* DECRYPT DATA */
function decryptData($encryptedString, $initVector) {
    return openssl_decrypt(base64_decode($encryptedString), 'AES-256-CTR', 'JaNdRgUkX2r5u8x/A?D(G+KbPeShVmYq', OPENSSL_RAW_DATA, base64_decode($initVector));
}

/* GENERATE MESSAGE ID */
function getMessageID($msgID = null) {
    $msgID = $msgID ?? random_bytes(16);
    assert(strlen($msgID) == 16);
    $msgID[6] = chr(ord($msgID[6]) & 0x0f | 0x40);
    $msgID[8] = chr(ord($msgID[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($msgID), 4)) . '@' . $_SERVER['SERVER_NAME'];
}

/* GET IP REPUTATION */
function getIPReputation($ipAddress)
{
    $apiURL = 'https://api.xforce.ibmcloud.com/api/ipr/' . $ipAddress;
    $authHeader = '';       // X-Force API Authorization Token
    
    $ipReputationAPI = curl_init();
    curl_setopt($ipReputationAPI, CURLOPT_URL, $apiURL);
    curl_setopt($ipReputationAPI, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ipReputationAPI, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authHeader));
    $captureResult = curl_exec($ipReputationAPI);
    curl_close ($ipReputationAPI);
    
    return json_decode($captureResult, true)["score"]; 
}

/* SITE HEADER & FOOTER */
function getAuthHeader(){
    echo '<div data-w-id="d60ddca1-d07c-112f-3c2f-794a5c0af801" data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="header-wrapper v2 w-nav">
                <div class="container-default w-container">
                    <div class="header-content-wrapper">
                        <div class="header-middle center---tablet">
                            <a href="index.html" class="header-logo-link w-nav-brand">
                                <img src="assets/images/sasdac.png" class="header-logo" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>' . PHP_EOL;
}

function getMainHeader() {
    echo '<div data-w-id="296f8093-73a5-a05e-210a-be41bc6222cc" data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="header-wrapper w-nav">
                <div class="container-default w-container">
                    <div class="dropdown-header-wrapper---bg-copy"></div>
                    <div class="header-content-wrapper">
                        <a href="index.html" aria-current="page" class="header-logo-link w-nav-brand w--current">
                            <img src="assets/images/sasdac.png" alt="Logo - Dataplus X Webflow Template" class="header-logo" />
                        </a>
                        <div class="header-right-side">
                        <a href="#" class="header-nav-link w-inline-block"><div class="custom-icon-font link-icon-left"></div><div class="link-text">Log out</div></a>
                            <a href="register" class="btn-primary small header-btn-hidde-on-mb w-button">Get started</a>
                            <div class="hamburger-menu-btn w-nav-button">
                                <div class="hamburger-menu-wrapper">
                                    <div class="hamburger-menu-bar top"></div>
                                    <div class="hamburger-menu-bar bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-wrapper---bg"></div>
                <div class="header-nav-menu---bg"></div>
            </div>' . PHP_EOL;
}

function getAuthFooter(){
    echo '<footer class="footer-wrapper v2">
					<div class="container-default w-container">
						<div data-w-id="b4234064-9c46-ece5-3a78-23e2b6487e92" class="footer-bottom text-right text-center---tablet v2">
							<div class="w-layout-grid footer-bottom---grid">
								<a id="w-node-b4234064-9c46-ece5-3a78-23e2b6487e94-b6487e90" href="index.html" class="footer-logo-wrapper mg-bottom-0 w-inline-block">
									<img src="assets/images/sasdac.png" class="footer-logo" />
								</a>
								<p class="mg-bottom-0">IBM Project</p>
							</div>
						</div>
					</div>
				</footer>' . PHP_EOL;
}
?>