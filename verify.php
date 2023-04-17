<?php
session_start();
require_once('siteConfig.php');

if (!isset($_SESSION['AUTH_VALID']))
{
    if ($_SESSION['AUTH_VALID'] != true) {
        header('Location: login');
    }
}

unset($_SESSION['LOGIN_PUBLIC_KEY']);
unset($_SESSION['LOGIN_PRIVATE_KEY']);

$rsaKey = openssl_pkey_new(array(
	'digest_alg' => $RSA_DIGEST_ALG,
	'private_key_bits' => $RSA_KEY_BITS,
	'private_key_type' => $RSA_KEY_TYPE,
));
openssl_pkey_export($rsaKey, $privateKey);

$publicKey = openssl_pkey_get_details($rsaKey);
$publicKey = $publicKey["key"];
$_SESSION['VERIFY_PUBLIC_KEY'] = $publicKey;
$_SESSION['VERIFY_PRIVATE_KEY'] = $privateKey;
?>
<!DOCTYPE html>
<html data-wf-page="636e673db0633076ab64f070" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $TITLE_NAME; ?> • Verify</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		<link href="assets/images/favicon.png" rel="apple-touch-icon">
	</head>
	<body>
		<div class="page-wrapper flex-vertical">
            <?php getAuthHeader(); ?>
			<div data-node-type="commerce-cart-wrapper" style="display: none;" data-open-product="" data-wf-cart-type="modal" class="w-commerce-commercecartwrapper cart-button-wrapper">
				<div data-node-type="commerce-cart-container-wrapper" class="w-commerce-commercecartcontainerwrapper w-commerce-commercecartcontainerwrapper--cartType-modal cart-wrapper">
					<div data-node-type="commerce-cart-container" class="w-commerce-commercecartcontainer cart-container">
						<div class="w-commerce-commercecartheader cart-header">
							<h4 style="margin-left: auto; margin-right: auto;" class="w-commerce-commercecartheading heading-h5-size">Awaiting confirmation ...</h4>
						</div>
						<div class="w-commerce-commercecartformwrapper cart-form-wrapper">
							<div class="w-commerce-commercecartemptystate empty-state cart-empty">
							<img src="assets/images/animation.gif" height="128">
								<div>Hi there, please wait while we verify your passcode, do not refresh or reload this page</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="overflow-hidden position-relative">
				<div class="section hero v18 wf-section" style="margin-top: -50px;">
					<div class="container-default w-container">
						<div class="inner-container _570px center">
							<div class="inner-container _350px---mbl center">
								<div data-w-id="bfbdf333-e5d7-3cf7-9adb-7af2d37b6268" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0;" class="card confirm-email">
									<div class="inner-container _350px---mbl center" style="margin-top: -50px;">
                                        <div class="text-center">
                                            <div data-node-type="commerce-cart-error" class="w-commerce-commercecarterrorstate error-message cart-error">
                                                <div class="w-cart-error-msg" data-w-cart-quantity-error="Verification code expires in 00:59" data-w-cart-general-error="Something went wrong when adding this item to the cart." data-w-cart-checkout-error="Checkout is disabled on this site." data-w-cart-cart_order_min-error="The order minimum was not met. Add more items to your cart to continue." data-w-cart-subscription_error-error="Before you purchase, please use your email invite to verify your address so we can send order updates.">Verification code expires in <span id="otp-timer">03:00</span></div>
                                            </div>
											<div class="mg-bottom-32px keep">
												<div class="inner-container _59px center">
													<div class="image-wrapper">
														<img src="https://assets.website-files.com/63619a386216ae681d93409b/636e73a09b355be7fd53f39f_icon-verify-email-dataplus-template.svg" loading="eager" alt="Verify Your Email! - Dataplus X Webflow Template" class="image" />
													</div>
												</div>
											</div>
											<h1 class="heading-h2-size mg-bottom-8px">Verify your <span class="gradient-color-01">email</span>! </h1>
											<p class="mg-bottom-48px">We have sent you a verification code via email. Please enter the following code to verify it's really you.</p>
                                            <form id="verification-form" name="verification-form" data-name="Verification Form" method="post" autocomplete="off">
												<div id="w-node-ff03d10d-d5d5-849c-28e3-7660ea78370c-706d21f8" class="sign-up-form">
                                                    <div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
														<label for="code">Please enter the verification code</label>
														<input type="text" class="input w-input" maxlength="43" name="code" data-name="code" placeholder="Verification Code" id="code" required="">
													</div>
                                                    <div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
														<div class="mg-top-38px">
															<input type="submit" value="Submit" data-wait="Please wait..." class="btn-primary width-100 w-button">
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="position-absolute bg-grid extended">
					<div class="w-layout-grid bg-grid-lights---hero-v17">
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="bfbdf333-e5d7-3cf7-9adb-7af2d37b6291" id="w-node-bfbdf333-e5d7-3cf7-9adb-7af2d37b6291-ab64f070" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="bfbdf333-e5d7-3cf7-9adb-7af2d37b6292" id="w-node-bfbdf333-e5d7-3cf7-9adb-7af2d37b6292-ab64f070" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="bfbdf333-e5d7-3cf7-9adb-7af2d37b6293" id="w-node-bfbdf333-e5d7-3cf7-9adb-7af2d37b6293-ab64f070" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="bfbdf333-e5d7-3cf7-9adb-7af2d37b6294" id="w-node-bfbdf333-e5d7-3cf7-9adb-7af2d37b6294-ab64f070" alt="" class="image grid-comet" />
					</div>
				</div>
			</div>
			<div class="mg-top-auto">
				<?php getAuthFooter(); ?>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		<script src="assets/js/main.js" type="text/javascript"></script>
		<script src="assets/js/jsencrypt.min.js"></script>
		<script>
			var countdown = 180, timer = setInterval(function() {
				var minutes = Math.floor( countdown / 60 );
    			if (minutes < 10) minutes = "0" + minutes;
    			var seconds = countdown % 60;
    			if (seconds < 10) seconds = "0" + seconds; 
                $("#otp-timer").html(minutes + ':' + seconds);
				countdown --;
                if(countdown == -1) {
                    $(".w-cart-error-msg").html("Your OTP has expired, please try again!");
					$('input[type=submit]').attr('disabled', true);
					$('input[type=submit]').css('color', '#737B89');
					$('input[type=submit]').css('background-color', '#353C4A');
					$('input[type=submit]').css('border-color', '#353C4A');
                    clearInterval(timer)
                };
            }, 1000);

			$("form[name=verification-form]").submit(function(event) {
				$('.w-commerce-commercecartwrapper').css('display', 'flex');
				event.preventDefault();
				var encryptionObject = new JSEncrypt();
                encryptionObject.setPublicKey(`<?php echo $_SESSION['VERIFY_PUBLIC_KEY']; ?>`);
                var encryptedData = encryptionObject.encrypt($(this).serialize());
				$.ajax({
    			    type: "POST",
    			    url: "confirmOTP.php",
    			    data: {'data': encryptedData},
    			    success: function (response) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						window.location.href = 'index';
    			    },
    			    error: function (xhr, ajaxOptions, thrownError) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						console.log(xhr.status);
        				console.log(thrownError);
        				console.log(xhr.responseText);
    			    }
    			});
			});
		</script>
	</body>
</html>