<?php
session_start();
require_once('siteConfig.php');

if (!isset($_SESSION['EMAIL_VERIFICATION_OTP']))
	header('Location: register');

if ($_SESSION['EMAIL_VERIFICATION_OTP_VALID'] != true) {
	echo '<script>alert("The verification code provided is incorrect, please try again!"); window.location.href="confirm";</script>';
}

unset($_SESSION['CONFIRM_PUBLIC_KEY']);
unset($_SESSION['CONFIRM_PRIVATE_KEY']);

$rsaKey = openssl_pkey_new(array(
	'digest_alg' => 'sha256',
	'private_key_bits' => 4096,
	'private_key_type' => OPENSSL_KEYTYPE_RSA,
));
openssl_pkey_export($rsaKey, $privateKey);

$publicKey = openssl_pkey_get_details($rsaKey);
$publicKey = $publicKey["key"];
$_SESSION['SECURITY_FIRST_PUBLIC_KEY'] = $publicKey;
$_SESSION['SECURITY_FIRST_PRIVATE_KEY'] = $privateKey;
?>
<!DOCTYPE html>
<html data-wf-page="636e673db0633076ab64f070" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $TITLE_NAME; ?> • Security First</title>
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
								<div>Hi there, please wait while we create your account, do not refresh or reload this page</div>
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
											<div class="mg-bottom-32px keep">
												<div class="inner-container _59px center">
													<div class="image-wrapper">
														<img src="https://assets.website-files.com/63619a386216ae681d93409b/636ead22c0125c9b3c507b02_icon-password-page-dataplus-template.svg" loading="eager" alt class="image" />
													</div>
												</div>
											</div>
											<h1 class="heading-h2-size mg-bottom-8px"><span class="gradient-color-01">Security</span> first! </h1>
											<p class="mg-bottom-48px">Please answer the following security questions to keep your account secure in case of an attack.</p>
                                            <form id="verification-form" name="verification-form" data-name="Verification Form" method="post" autocomplete="off">
												<div id="w-node-ff03d10d-d5d5-849c-28e3-7660ea78370c-706d21f8" class="sign-up-form">
                                                    <div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
                                                        <select class="input select---inside w-select" name="sec-question-01">
                                                            <option value="Security Question #01" selected disabled>Security Question #01</option>
                                                            <option value="What city were you born in?">What city were you born in?</option>
                                                            <option value="What is your oldest sibling's middle name?">What is your oldest sibling's middle name?</option>
                                                            <option value="What was the first concert you attended?">What was the first concert you attended?</option>
                                                            <option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
                                                        </select>
                                                        <br><input type="text" class="input w-input" maxlength="256" name="sec-answer-01" data-name="sec-answer-01" placeholder="Your answer" id="sec-question-01" required="">
													</div>
                                                    <div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
                                                        <select class="input select---inside w-select" name="sec-question-02">
                                                            <option value="Security Question #02" selected disabled>Security Question #02</option>
                                                            <option value="What was your driving instructor's first name?">What was your driving instructor's first name?</option>
                                                            <option value="What is the name of a college you applied to but didn't attend?">What is the name of a college you applied to but didn't attend?</option>
                                                            <option value="What is your maternal grandmother's maiden name?">What is your maternal grandmother's maiden name?</option>
                                                            <option value="In what city or town did your parents meet?">In what city or town did your parents meet?</option>
                                                        </select>
                                                        <br><input type="text" class="input w-input" maxlength="256" name="sec-answer-02" data-name="sec-answer-02" placeholder="Your answer" id="sec-question-02" required="">
													</div>
                                                    <div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
                                                        <select class="input select---inside w-select" name="sec-question-03">
                                                            <option value="Security Question #03" selected disabled>Security Question #03</option>
                                                            <option value="What was the name of the first school you remember attending?">What was the name of the first school you remember attending?</option>
                                                            <option value="Where was the destination of your most memorable school field trip?">Where was the destination of your most memorable school field trip?</option>
                                                            <option value="What was your maths teacher's surname in your 8th year of school?">What was your maths teacher's surname in your 8th year of school?</option>
                                                            <option value="What was the name of your first stuffed toy?">What was the name of your first stuffed toy?</option>
                                                        </select>
                                                        <br><input type="text" class="input w-input" maxlength="256" name="sec-answer-03" data-name="sec-answer-03" placeholder="Your answer" id="sec-question-03" required="">
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
			$("form[name=verification-form]").submit(function(event) {
				$('.w-commerce-commercecartwrapper').css('display', 'flex');
				event.preventDefault();
				var encryptionObject = new JSEncrypt();
                encryptionObject.setPublicKey(`<?php echo $_SESSION['SECURITY_FIRST_PUBLIC_KEY']; ?>`);
                var encryptedData = encryptionObject.encrypt($(this).serialize());
				$.ajax({
    			    type: "POST",
    			    url: "createAccount.php",
    			    data: {'data': encryptedData},
    			    success: function (response) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						window.location.href = 'success';
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