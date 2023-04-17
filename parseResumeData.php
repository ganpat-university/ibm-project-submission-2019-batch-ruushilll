<?php
session_start();
require_once('siteConfig.php');

if (isset($_SESSION['USER_AUTH_VALID'])) {
	if ($_SESSION['USER_AUTH_VALID'] != true) {
		header('Location: login');
	}
}
else {
	header('Location: login');
}

$pageName = explode('/', $_SERVER['REQUEST_URI'])[2];
$DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$moduleDataQuery = $DB_CONNECTION->prepare("SELECT * FROM `modules` WHERE `pageName` = ?;");
$moduleDataQuery->bind_param('s', $pageName);
$moduleDataQuery->execute();
$moduleData = $moduleDataQuery->get_result()->fetch_row();

$_SESSION['source'] = $moduleData[3];
$_SESSION['endpoint'] = $moduleData[2];
?>
<!DOCTYPE html>
<html data-wf-page="63619a386216ae2a209340ab" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
	<meta charset="utf-8" />
		<title><?php echo $TITLE_NAME; ?> • Module (<?php echo $moduleData[1]; ?>)</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		<link href="assets/images/favicon.png" rel="apple-touch-icon">
	</head>
	<body>
		<div style="opacity:0" class="page-wrapper">
			<?php getMainHeader(); ?>
			<div data-node-type="commerce-cart-wrapper" style="display: none;" data-open-product="" data-wf-cart-type="modal" class="w-commerce-commercecartwrapper cart-button-wrapper">
				<div data-node-type="commerce-cart-container-wrapper" class="w-commerce-commercecartcontainerwrapper w-commerce-commercecartcontainerwrapper--cartType-modal cart-wrapper">
					<div data-node-type="commerce-cart-container" class="w-commerce-commercecartcontainer cart-container">
						<div class="w-commerce-commercecartheader cart-header">
							<h4 style="margin-left: auto; margin-right: auto;" class="w-commerce-commercecartheading heading-h5-size">Awaiting server response ...</h4>
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
			<div class="overflow-hidden position-relative">
				<div class="position-relative z-index-1">
					<section class="section hero v9 wf-section">
						<div class="container-default w-container">
							<div class="w-layout-grid grid-2-columns product-page">
								<div id="w-node-_0f32cc4f-ffc7-a450-e437-60635588a204-209340ab" class="inner-container _518px">
									<div data-w-id="d5f4122d-d8d3-fd22-5292-becf92f60975" style="-webkit-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0">
										<div class="mg-bottom-16px">
											<div class="flex-horizontal children-wrap">
												<h1 class="display-1 mg-bottom-0 gradient-color-01" style="font-size: 48px;"><?php echo $moduleData[1]; ?></h1>
												<div class="display-1"></div>
												<h2 class="display-1 mg-bottom-0" style="font-size: 48px;">module</h2>
											</div>
										</div>
									</div>
									<div class="inner-container _445px">
										<p data-w-id="e0a745cd-b47a-fa9c-d350-6cc2c0e714bd" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="mg-bottom-48px">This module is responsible for extracting bill-related data such as account number, billing period, and amount due from uploaded documents. This module utilizes advanced data extraction techniques to accurately retrieve the required information.</p>
										<div data-w-id="214932b9-ea12-200e-36e1-945f65352632" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="w-layout-grid grid-1-column gap-row-24px">
											<div>
												<div class="mg-bottom-48px">
													<div class="inner-container _311px _100---tablet">
														<h3 class="heading-h5-size mg-bottom-20px">Inputs required</h3>
														<div class="w-layout-grid grid-1-column gap-row-24px contact-links---grid">
															<?php
															foreach (json_decode($moduleData[4], true) as $tempModule)
															{
															?>
															<a class="card link-card contact-link w-inline-block">
																<div class="mg-right-12px">
																	<div class="inner-container _25px">
																		<div class="image-wrapper">
																			<img src="assets/images/folder.png" loading="eager" class="image" />
																		</div>
																	</div>
																</div>
																<div class="text-200 medium"><?php echo $tempModule['name']; ?></div>
															</a>
															<?php
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="w-node-_07337d64-cbb4-0eb7-1f5a-62c19679a822-209340ab" data-w-id="07337d64-cbb4-0eb7-1f5a-62c19679a822" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="inner-container _536px width-100 _100---tablet">
									<div class="card add-to-cart---item">
										<div class="card-add-to-cart---content-top">
											<h2 class="heading-h3-size mg-bottom-14px keep">Configure your API's input parameters</h2>
											<p class="mg-bottom-48px">Enter your unique client ID to securely access and manage your data.</p>
										</div>
										<p class="w-dyn-bind-empty"></p>
										<div class="add-to-cart">
											<form id="invokeAPI" class="w-commerce-commerceaddtocartform add-to-cart---default-state" method="post" enctype="multipart/form-data">
												<?php
												foreach (json_decode($moduleData[4], true) as $tempModule)
												{
												?>
												<div class="mg-bottom-16px keep">
													<div class="flex-horizontal">
														<div data-wf-sku-bindings="%5B%7B%22from%22%3A%22f_sku_values_3dr%22%2C%22to%22%3A%22optionValues%22%7D%5D" data-commerce-product-sku-values="%7B%228a7ae659e692337f5068f8c0ad9f5951%22%3A%22aa1a224846910fb14484a918f7529412%22%7D" data-node-type="commerce-add-to-cart-option-list" data-commerce-product-id="636ae4783f6c7d0f5318ec82" data-preselect-default-variant="false" class="width-100" role="group">
															<div role="group">
																<label for="<?php echo $tempModule["fieldName"]; ?>">Enter <?php echo $tempModule["name"]; ?></label>
																<input type="file" class="input w-input" name="<?php echo $tempModule["fieldName"]; ?>" id="<?php echo $tempModule["fieldName"]; ?>" required="" accept="application/pdf"/>
															</div>
														</div>
													</div>
												</div>
												<?php
												}
												?>
												<div class="buttons-row vertical">
													<input type="submit" data-node-type="commerce-add-to-cart-button" data-loading-text="Adding to cart..." name="submit" value="Execute <?php echo $moduleData[1]; ?> API" aria-busy="false" aria-haspopup="dialog" class="w-commerce-commerceaddtocartbutton btn-primary width-100" />
												</div>
											</form>
											<div style="display:none" class="w-commerce-commerceaddtocartoutofstock empty-state card-empty">
												<div>This product is out of stock.</div>
											</div>
											<div data-node-type="commerce-add-to-cart-error" style="display:none" class="w-commerce-commerceaddtocarterror error-message">
												<div data-node-type="commerce-add-to-cart-error" data-w-add-to-cart-quantity-error="Product is not available in this quantity." data-w-add-to-cart-general-error="Something went wrong when adding this item to the cart." data-w-add-to-cart-mixed-cart-error="You can’t purchase another product with a subscription." data-w-add-to-cart-buy-now-error="Something went wrong when trying to purchase this item." data-w-add-to-cart-checkout-disabled-error="Checkout is disabled on this site." data-w-add-to-cart-select-all-options-error="Please select an option in each set.">Product is not available in this quantity.</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="position-absolute bg-grid">
					<div class="w-layout-grid bg-grid-lights---hero-v9">
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="0a025bb4-166f-1a6c-3a12-4269a3020c2c" id="w-node-_0a025bb4-166f-1a6c-3a12-4269a3020c2c-209340ab" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="0a025bb4-166f-1a6c-3a12-4269a3020c2d" id="w-node-_0a025bb4-166f-1a6c-3a12-4269a3020c2d-209340ab" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="0a025bb4-166f-1a6c-3a12-4269a3020c2e" id="w-node-_0a025bb4-166f-1a6c-3a12-4269a3020c2e-209340ab" alt="" class="image grid-comet" />
						<img src="https://assets.website-files.com/63619a386216ae681d93409b/6362a54182b1e776879a164f_shape-light-grid-dataplus-template.svg" loading="eager" style="-webkit-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 200%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" data-w-id="e04bc735-9222-35a6-e7ce-6c8c8dc57ee1" id="w-node-e04bc735-9222-35a6-e7ce-6c8c8dc57ee1-209340ab" alt="" class="image grid-comet" />
					</div>
				</div>
			</div>
			<div class="divider _0px"></div>
			<?php getAuthFooter(); ?>
		</div>
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		<script src="assets/js/file.js" type="text/javascript"></script>
		<script>
			$("#invokeAPI").submit(function(event) {
				$('.w-commerce-commercecartwrapper').css('display', 'flex');
				event.preventDefault();

	 			var fileData = $('#filePath').prop('files')[0];
    			var formData = new FormData();
    			formData.append('filePath', fileData);

				$.ajax({
    			    type: "POST",
    			    url: "invokeAPI.php",
    			    data: formData,
    			    success: function (response) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						var apiResponse = JSON.parse(JSON.parse(response));
						if (apiResponse.success == false) 
							alert('An error occurred while processing your request!\n\nError Message: ' + apiResponse.message);
						else
							alert('Data processed successfully, the file has been successfully uploaded to the S3 bucket as ' + apiResponse.S3FileName);
    			    },
    			    error: function (xhr, ajaxOptions, thrownError) {
						$('.w-commerce-commercecartwrapper').css('display', 'none');
						console.log(xhr.status);
        				console.log(thrownError);
        				console.log(xhr.responseText);
    			    },
        			cache: false,
        			contentType: false,
        			processData: false
    			});
			});
		</script>
	</body>
</html>