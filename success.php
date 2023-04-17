<?php
session_start();
require_once('siteConfig.php');

if (!isset($_SESSION['EMAIL_VERIFICATION_OTP']))
{
	header('Location: register');
}

unset($_SESSION['CONFIRM_PUBLIC_KEY']);
unset($_SESSION['CONFIRM_PRIVATE_KEY']);
?>
<!DOCTYPE html>
<html data-wf-page="636e673db0633076ab64f070" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $TITLE_NAME; ?> • Success</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		<link href="assets/images/favicon.png" rel="apple-touch-icon">
	</head>
	<body>
		<div class="page-wrapper flex-vertical">
            <?php getAuthHeader(); ?>
			<div class="overflow-hidden position-relative">
				<div class="section hero v18 wf-section" style="margin-top: -50px;">
					<div class="container-default w-container">
						<div class="inner-container _570px center">
							<div class="inner-container _350px---mbl center">
								<div data-w-id="bfbdf333-e5d7-3cf7-9adb-7af2d37b6268" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0;" class="card confirm-email">
									<div class="inner-container _350px---mbl center" style="margin-top: -50px;">
                                        <div class="text-center">
											<div class="mg-bottom-32px keep">
												<div class="inner-container _59px center">
													<div class="image-wrapper">
														<img src="https://assets.website-files.com/63619a386216ae681d93409b/6365c61339e0286c3d5a1500_icon-3-values-dataplus-template.svg" loading="eager" alt="Verify Your Email! - Dataplus X Webflow Template" class="image" />
													</div>
												</div>
											</div>
											<h1 class="heading-h2-size mg-bottom-8px"><span class="gradient-color-01">Thank you</span>! </h1>
											<p class="mg-bottom-48px">Your request has been received and processed. The next step is to verify the information provided. Once the verification process is completed, your account will be activated. A notification email will be sent to the email provided, confirming that the account is active and ready to use.</p>
										</div>
                                        <div class="divider _40px"></div>
										<div class="text-center">
											<div>Account activated? <a style="text-decoration: none;" href="login" class="text-link default">Sign in</a></div>
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
                encryptionObject.setPublicKey(`<?php echo $_SESSION['CONFIRM_PUBLIC_KEY']; ?>`);
                var encryptedData = encryptionObject.encrypt($(this).serialize());
				$.ajax({
    			    type: "POST",
    			    url: "verifyOTP.php",
    			    data: {'data': encryptedData},
    			    success: function (response) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						window.location.href = 'security-first';
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