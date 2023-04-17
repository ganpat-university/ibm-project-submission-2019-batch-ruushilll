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
$_SESSION['REGISTER_PUBLIC_KEY'] = $publicKey;
$_SESSION['REGISTER_PRIVATE_KEY'] = $privateKey;
?>
<!DOCTYPE html>
<html data-wf-page="636d8e3e4a3e3c90706d21f8" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
		<meta charset="utf-8">
		<title><?php echo $TITLE_NAME; ?> • Sign Up</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		<link href="assets/images/favicon.png" rel="apple-touch-icon">
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="page-wrapper flex-vertical">
			<?php getAuthHeader(); ?>
			<div data-node-type="commerce-cart-wrapper" style="display: none;" data-open-product="" data-wf-cart-type="modal" class="w-commerce-commercecartwrapper cart-button-wrapper">
				<div data-node-type="commerce-cart-container-wrapper" class="w-commerce-commercecartcontainerwrapper w-commerce-commercecartcontainerwrapper--cartType-modal cart-wrapper">
					<div data-node-type="commerce-cart-container" class="w-commerce-commercecartcontainer cart-container">
						<div class="w-commerce-commercecartheader cart-header">
							<h4 style="margin-left: auto; margin-right: auto;" class="w-commerce-commercecartheading heading-h5-size">Awaiting request confirmation ...</h4>
						</div>
						<div class="w-commerce-commercecartformwrapper cart-form-wrapper">
							<div class="w-commerce-commercecartemptystate empty-state cart-empty">
							<img src="assets/images/animation.gif" height="128">
								<div>Hi there, please wait while we process your request, do not refresh or reload this page</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<section class="section hero pd-0px sign-up---section wf-section">
				<div class="container-default grow w-container">
					<div class="w-layout-grid grid-2-columns gap-0 sign-up---main-grid">
						<div id="w-node-a69ad777-c0c8-a647-a84f-d81fa86f1134-706d21f8" class="sign-up-main-content---left">
							<div class="inner-container _574px width-100">
								<div class="inner-container _500px---mbl center">
									<div class="mg-bottom-38px keep">
										<div class="text-center---tablet">
											<h1 data-w-id="22f0595a-5889-d68b-96c6-912aa8cdb7f9" style="-webkit-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="display-2">Create your <span class="gradient-color-01">account.</span></h1>
											<p data-w-id="8ac7f2a7-02e4-9d7b-8eee-f4a81de3a48e" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="mg-bottom-0">Create an account today and start <span class="text-no-wrap">using <?php echo $TITLE_NAME; ?>.</span>
											</p>
										</div>
									</div>
									<div data-w-id="b9a2ed13-6a3f-ed30-bce7-323c250ca85b" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="card sign-up">
										<div class="sign-up-form-block w-form">
											<form id="email-form" name="email-form" data-name="Email Form" method="post" autocomplete="off">
												<div id="w-node-ff03d10d-d5d5-849c-28e3-7660ea78370c-706d21f8" class="sign-up-form">
													<div id="w-node-e300ae4b-c024-5066-e460-760eac7561ff-706d21f8">
														<label for="name">Name</label>
														<input type="text" class="input w-input" maxlength="256" name="name" data-name="name" placeholder="Full name" id="name" required="">
													</div>
                                                    <div id="w-node-e300ae4b-c024-5066-e460-760eac7561ff-706d21f8">
														<label for="mobile">Mobile</label>
														<input type="tel" class="input w-input" maxlength="256" name="mobile" data-name="mobile" placeholder="90XXXXXXXX" id="mobile" required="">
													</div>
													<div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
														<label for="email-01">Email</label>
														<input type="email" class="input w-input" maxlength="256" name="email" data-name="email" placeholder="example@domain.com" id="email-01" required="">
													</div>
													<div id="w-node-e300ae4b-c024-5066-e460-760eac7561ff-706d21f8">
														<label for="password">Password</label>
														<input type="password" class="input w-input" maxlength="256" name="passwordOne" data-name="password" placeholder="Enter your password" id="passwordOne" required="">
                                                    </div>
                                                    <div id="w-node-e300ae4b-c024-5066-e460-760eac7561ff-706d21f8">
														<label for="password">Confirm Password</label>
														<input type="password" class="input w-input" maxlength="256" name="passwordTwo" data-name="password" placeholder="Re-enter password" id="passwordTwo" required="">
                                                    </div>
                                                    <div id="w-node-b9a2ed13-6a3f-ed30-bce7-323c250ca86a-706d21f8">
                                                        <div class="mg-top-16px" id="password-requirements" style="display: none;">
                                                            <div><span id="password-match" style="color: #DC2B2B" class="line-rounded-icon"></span> Passwords match</div>
                                                            <div><span id="12-char" style="color: #DC2B2B" class="line-rounded-icon"></span> Minimum 12 characters</div>
                                                            <div><span id="char-comb" style="color: #DC2B2B" class="line-rounded-icon"></span> One uppercase, one lowercase and one numeric character</div>
                                                            <div><span id="english-dict" style="color: #DC2B2B" class="line-rounded-icon"></span> No English dictionary words</div>
                                                            <div><span id="sequential-char" style="color: #DC2B2B" class="line-rounded-icon"></span> No repetitive or sequential characters</div>
                                                            <div><span id="no-username" style="color: #DC2B2B" class="line-rounded-icon"></span> Not contain the user's account name, email or mobile</div>
                                                            <div><span id="previous-breach" style="color: #DC2B2B" class="line-rounded-icon"></span> Not contained in previous data breaches</div>
                                                        </div>
														<div class="mg-top-38px">
															<input type="submit" value="Create account" data-wait="Please wait..." class="btn-primary width-100 w-button" disabled>
														</div>
													</div>
												</div>
												<div class="divider _40px"></div>
												<div class="text-center">
													<div>Already have an account? <a href="sign-in.html" class="text-link default">Sign in</a>
													</div>
												</div>
											</form>
											<div class="success-message w-form-done">
												<div>
													<div class="line-rounded-icon success-message-check large"></div>
													<h2 class="display-3 mg-bottom-12px">Thank you!</h2>
													<div class="color-neutral-300">Please check your inbox to confirm your email.</div>
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
						<div id="w-node-_4d09589e-a0a5-3d49-2f58-aa90d64f6e58-706d21f8" class="sign-up-main-content---right">
							<div data-w-id="7e42f4e1-0d3a-a04b-06eb-e3aacdff966f" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="inner-container _1087px">
								<div data-w-id="7e42f4e1-0d3a-a04b-06eb-e3aacdff9670" class="sign-up-images">
									<div class="inner-container sign-up---image-01">
										<div class="image-wrapper style-01">
											<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362b8c632be3d1c56cdc377_image-1-hero-v1-dataplus-template.png" loading="eager" srcset="https://assets.website-files.com/63619a386216ae681d93409b/6362b8c632be3d1c56cdc377_image-1-hero-v1-dataplus-template-p-500.png 500w, https://assets.website-files.com/63619a386216ae681d93409b/6362b8c632be3d1c56cdc377_image-1-hero-v1-dataplus-template-p-800.png 800w, https://assets.website-files.com/63619a386216ae681d93409b/6362b8c632be3d1c56cdc377_image-1-hero-v1-dataplus-template-p-1080.png 1080w, https://assets.website-files.com/63619a386216ae681d93409b/6362b8c632be3d1c56cdc377_image-1-hero-v1-dataplus-template-p-1600.png 1600w, https://assets.website-files.com/63619a386216ae681d93409b/6362b8c632be3d1c56cdc377_image-1-hero-v1-dataplus-template.png 1902w" sizes="(max-width: 479px) 82vw, (max-width: 767px) 84vw, (max-width: 991px) 85vw, 976.296875px" alt="A CRM Platform For Power Users - Dataplus X Webflow Template" class="image cover border-radius-16px">
										</div>
									</div>
									<div class="position-absolute sign-up---image-02">
										<div class="image-wrapper style-02">
											<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362b8c69f5a435930e96920_image-2-hero-v1-dataplus-template.svg" loading="eager" class="image cover border-radius-16px">
										</div>
									</div>
								</div>
							</div>
							<div class="position-absolute bg-grid bg-grid-accent cta"></div>
						</div>
					</div>
				</div>
			</section>
			<div class="mg-top-auto">
				<?php getAuthFooter(); ?>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/sha1.js"></script>
		<script src="assets/js/main.js" type="text/javascript"></script>
		<script src="assets/js/jsencrypt.min.js"></script>
        <script>
			var passwordsMatch = false, charLength = false, charCombination = false, sequentialChar = false, noUsername = false, englishDict = false, passwordBreach = false;

            $('input[type=password][name=passwordOne]').bind('click keyup', function() {
				var passwordValidationRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
				var passwordOne = $('input[type=password][name=passwordOne]').val();
				var passwordTwo = $('input[type=password][name=passwordTwo]').val();
                $('#password-requirements').css('display', 'block');
                
				// Password match validation
				if (passwordOne.length > 0) {
                    if (passwordOne == passwordTwo) {
						passwordsMatch = true;
                        $('#password-match').html('');
                        $('#password-match').css('color', '#05C168');
                    }
                    else {
						passwordsMatch = false;
                        $('#password-match').html('');
                        $('#password-match').css('color', '#DC2B2B');
                    }
                }
                
				// Password character length validation
                if (passwordOne.length >= 12) {
					charLength = true;
                    $('#12-char').html('');
                    $('#12-char').css('color', '#05C168');
                }
                else {
					charLength = false;
                    $('#12-char').html('');
                    $('#12-char').css('color', '#DC2B2B');
                }

				// One uppercase, one lowercase and one numeric character validation
				if (passwordValidationRegex.test(passwordOne) == true) {
					charCombination = true;
					$('#char-comb').html('');
                	$('#char-comb').css('color', '#05C168');
				}
				else {
					charCombination = false;
                    $('#char-comb').html('');
                    $('#char-comb').css('color', '#DC2B2B');
                }

				// No repetitive or sequential characters validation
				if (passwordOne.length > 0) {
					if (/(.)\1\1/.test(passwordOne) == false) {
						sequentialChar = true;
            	        $('#sequential-char').html('');
            	        $('#sequential-char').css('color', '#05C168');
            	    }
            	    else {
						sequentialChar = false;
            	        $('#sequential-char').html('');
            	        $('#sequential-char').css('color', '#DC2B2B');
            	    }
				}
				
				// Not contain the user's account name, email or mobile validation
				if (passwordOne.length > 0) {
					if (passwordOne.includes($('input[type=text][name=name]').val(), 0) == false) {
						console.log($('input[type=text][name=name]').val() + " :: " + passwordOne.includes($('input[type=text][name=name]').val(), 0));
						noUsername = true;
            	        $('#no-username').html('');
            	        $('#no-username').css('color', '#05C168');
            	    }
            	    else {
						noUsername = false;
            	        $('#no-username').html('');
            	        $('#no-username').css('color', '#DC2B2B');
            	    }
				}
            });

            $('input[type=password][name=passwordTwo]').on('keyup', function() {
				var passwordOne = $('input[type=password][name=passwordOne]').val();
				var passwordTwo = $('input[type=password][name=passwordTwo]').val();
                $('#password-requirements').css('display', 'block');
                
				// Password match validation
				if (passwordOne.length > 0) {
                    if (passwordOne == passwordTwo) {
						passwordsMatch = true;
                        $('#password-match').html('');
                        $('#password-match').css('color', '#05C168');
                    }
                    else {
						passwordsMatch = false;
                        $('#password-match').html('');
                        $('#password-match').css('color', '#DC2B2B');
                    }
                }

				// Password character length validation
                if (passwordOne.length >= 12) {
					charLength = true;
                    $('#12-char').html('');
                    $('#12-char').css('color', '#05C168');
                }
                else {
					charLength = false;
                    $('#12-char').html('');
                    $('#12-char').css('color', '#DC2B2B');
                }
            });

			var typingTimerOne, typingTimerTwo;
			var englishDictionaryInterval = 500, passwordBreachedInterval = 500;

			$('input[type=password][name=passwordOne]').on('keyup', function () {
				clearTimeout(typingTimerOne);
				clearTimeout(typingTimerTwo);
				typingTimerOne = setTimeout(englishDictionary, englishDictionaryInterval);
				typingTimerTwo = setTimeout(passwordBreached, passwordBreachedInterval);
			});

			$('input[type=password][name=passwordOne]').on('keydown', function () {
				clearTimeout(typingTimerOne);
				clearTimeout(typingTimerTwo);
			});

			function englishDictionary() {
				var passwordOne = $('input[type=password][name=passwordOne]').val();
				if (passwordOne.length > 0) {
					$.getJSON('https://api.dictionaryapi.dev/api/v2/entries/en/' + passwordOne, function(resultData) {
						englishDict = false;
						$('#english-dict').html('');
            	        $('#english-dict').css('color', '#DC2B2B');
					}).fail(function() {
						englishDict = true;
    					$('#english-dict').html('');
            	    	$('#english-dict').css('color', '#05C168');
  					});
				}
			}

			function passwordBreached() {
				var breachFlag = false;
				var passwordOne = $('input[type=password][name=passwordOne]').val();	
				if (passwordOne.length > 0) {
					var execHash = String(CryptoJS.SHA1(passwordOne)).toUpperCase();
					$.get('https://api.pwnedpasswords.com/range/' + execHash.substring(0,5), function(breachData) {
						var hashArray = breachData.split('\r\n');
						for (var i = 0; i < hashArray.length; i++) {
						    if (execHash.substring(5) == hashArray[i].split(':')[0]) {
								breachFlag = true;
								break;
							}
						}

						if (breachFlag == false) {
							passwordBreach = true;
            	    	    $('#previous-breach').html('');
            	    	    $('#previous-breach').css('color', '#05C168');
            	    	}
            	    	else {
							passwordBreach = false;
            	    	    $('#previous-breach').html('');
            	    	    $('#previous-breach').css('color', '#DC2B2B');
            	    	}
					});
				}
			}

			function allowSubmission(){
				if ((passwordsMatch) && (charLength) && (charCombination) && (sequentialChar) && (noUsername) && (englishDict) && (passwordBreach)) {
					$('input[type=submit]').prop('disabled', false);
					$('input[type=submit]').css('color', '#FFFFFF');
					$('input[type=submit]').css('background-color', '#144EE3');
				}
				else {
					$('input[type=submit]').prop('disabled', true);
					$('input[type=submit]').css('color', '#EAF4FF');
					$('input[type=submit]').css('background-color', '#1D88FE');
				}
				window.setInterval(allowSubmission, 100);
			}

			$("form[name=email-form]").submit(function(event) {
				$('.w-commerce-commercecartwrapper').css('display', 'flex');
				event.preventDefault();
				var encryptionObject = new JSEncrypt();
                encryptionObject.setPublicKey(`<?php echo $_SESSION['REGISTER_PUBLIC_KEY']; ?>`);
                var encryptedData = encryptionObject.encrypt($(this).serialize());
				$.ajax({
    			    type: "POST",
    			    url: "verifyAccount.php",
    			    data: {'data': encryptedData},
    			    success: function (response) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						window.location.href = 'confirm';
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