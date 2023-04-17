<?php
session_start();
require_once('siteConfig.php');

$rsaKey = openssl_pkey_new(array(
	'digest_alg' => $RSA_DIGEST_ALG,
	'private_key_bits' => $RSA_KEY_BITS,
	'private_key_type' => $RSA_KEY_TYPE,
));
openssl_pkey_export($rsaKey, $privateKey);

$publicKey = openssl_pkey_get_details($rsaKey);
$publicKey = $publicKey["key"];
$_SESSION['LOGIN_PUBLIC_KEY'] = $publicKey;
$_SESSION['LOGIN_PRIVATE_KEY'] = $privateKey;
?>
<!DOCTYPE html>
<html data-wf-page="636d671faa9e997ab94b6290" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $TITLE_NAME; ?> • Sign In</title>
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
							<h4 style="margin-left: auto; margin-right: auto;" class="w-commerce-commercecartheading heading-h5-size">Awaiting server confirmation ...</h4>
						</div>
						<div class="w-commerce-commercecartformwrapper cart-form-wrapper">
							<div class="w-commerce-commercecartemptystate empty-state cart-empty">
							<img src="assets/images/animation.gif" height="128">
								<div>Hi there, please wait while we authenticate your request, do not refresh or reload this page</div>
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
								<div data-w-id="f963a4b1-9334-1186-0ba5-c2362fef5e80" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="card sign-in">
									<div class="sign-in-form-block w-form">
										<form id="login-form" name="login-form" data-name="Login Form" method="post">
											<div class="mg-bottom-48px">
												<div class="text-center">
													<h1 class="display-2">Welcome back</h1>
													<p class="mg-bottom-0">Please fill your email and password <span class="text-no-wrap">to sign in.</span>
													</p>
												</div>
											</div>
											<div id="w-node-_84077c31-097a-31a1-f58c-7481f808facb-b94b6290" class="sign-in-form">
												<div id="w-node-_9562e056-a3c5-9839-1462-55feaaf0e122-b94b6290">
													<label for="email-01">Email</label>
													<input type="email" class="input w-input" maxlength="256" name="email" data-name="Email" placeholder="example@domain.com" id="email-01" required="" />
												</div>
												<div id="w-node-d3e6f74f-aa07-85e7-9368-223d0f6877d3-b94b6290">
													<label for="password">Password</label>
													<input type="password" class="input w-input" maxlength="256" name="password" data-name="Password" placeholder="Enter your password" id="password" required="" />
												</div>
											</div>
											<div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
												<div class="mg-top-38px">
													<input type="submit" value="Sign in" data-wait="Please wait..." class="btn-primary width-100 w-button">
												</div>
											</div>
											<div class="divider _40px"></div>
											<div class="text-center">
												<div>Don't have an account? <a style="text-decoration: none;" href="register" class="text-link default">Sign up today</a>
												</div>
											</div>
										</form>
										<div class="success-message w-form-done">
											<div>
												<div class="line-rounded-icon success-message-check large"></div>
												<h2 class="display-3 mg-bottom-12px">Welcome back!</h2>
												<div class="color-neutral-300">Redirecting you to our home page...</div>
											</div>
										</div>
										<div class="error-message text-center w-form-fail">
											<div>Oops! Something went wrong.</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="position-absolute bg-grid top-v2">
					<div class="w-layout-grid bg-grid-lights---hero-v16">
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="9eff7c92-3f5e-c185-b473-4c0914810e4f" id="w-node-_9eff7c92-3f5e-c185-b473-4c0914810e4f-b94b6290" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="9eff7c92-3f5e-c185-b473-4c0914810e50" id="w-node-_9eff7c92-3f5e-c185-b473-4c0914810e50-b94b6290" alt="" class="image grid-comet" />
					</div>
				</div>
			</div>
			<div class="mg-top-auto">
				<?php getAuthFooter(); ?>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/sha1.js"></script>
		<script src="assets/js/main.js" type="text/javascript"></script>
		<script src="assets/js/jsencrypt.min.js"></script>
		<script>
			$("form[name=login-form]").submit(function(event) {
				$('.w-commerce-commercecartwrapper').css('display', 'flex');
				event.preventDefault();
				var encryptionObject = new JSEncrypt();
                encryptionObject.setPublicKey(`<?php echo $_SESSION['LOGIN_PUBLIC_KEY']; ?>`);
                var encryptedData = encryptionObject.encrypt($(this).serialize());
				$.ajax({
    			    type: "POST",
    			    url: "userAuth.php",
    			    data: {'data': encryptedData},
    			    success: function (response) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						window.location.href = 'routeUser';
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