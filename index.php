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

$DB_CONNECTION = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$updateUserAccount = $DB_CONNECTION->query("SELECT * FROM `modules`;");
$dbModules = $updateUserAccount->fetch_all();
?>
<!DOCTYPE html>
<html data-wf-page="63619a386216ae01ef9340bc" data-wf-site="63619a386216ae681d93409b" data-wf-status="1">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $TITLE_NAME; ?> • Home</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		<link href="assets/images/favicon.png" rel="apple-touch-icon">
	</head>
	<body>
		<div style="opacity:0" class="page-wrapper">
			<?php getMainHeader(); ?>
			<div class="section hero-page wf-section">
				<div class="container-default w-container">
					<div class="inner-container _634px center">
						<div class="text-center">
							<div class="inner-container _500px---tablet center">
								<div class="inner-container _450px---mbl center">
									<div class="inner-container _380px---mbp center">
										<h1 data-w-id="ae759b9d-c001-fa5f-f339-1b3806eee70c" style="-webkit-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 84%, 0) scale3d(0.5, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="display-1 mg-bottom-14px">
											<span class="text-no-wrap">Welcome<br></span> <?php echo $_SESSION['USER_NAME']; ?>
										</h1>
									</div>
								</div>
							</div>
							<p data-w-id="7b40bbeb-4e1b-9a9f-5dab-ea34571de1e9" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="mg-bottom-40px">Securely automate your data collection and processing with our advanced processing algorithms.</p>
						</div>
						<div data-w-id="c95c5576-e1eb-966f-5e39-00d4c61f8483" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="buttons-row center">
							<a href="#modules" class="btn-secondary w-button">Explore modules</a>
						</div>
					</div>
				</div>
			</div>
			<div class="section pd-200px pd-top-0px wf-section">
				<div class="container-default w-container">
					<div id="modules" class="inner-container _700px---tablet center">
						<div class="inner-container _500px---mbl center">
							<div class="inner-container _680px center">
								<div data-w-id="f241a4ae-c676-2e72-86d5-fdb7691a58fc" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="text-center">
									<h2 class="display-2 mg-bottom-8px">What would you like to extract?</span>
									</h2>
									<div class="inner-container _450px---mbl center">
										<p class="mg-bottom-40px">The tool as of now comprises of <?php echo count($dbModules); ?> extraction modules that are configured with the Django REST API. Choose from the below options to proceed.</span>
										</p>
									</div>
								</div>
							</div>
							<div data-w-id="6b08ae02-d6d5-021d-5bba-711e57249298" style="-webkit-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 30px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0;" class="w-layout-grid grid-3-columns _1-col-tablet">
								<?php
								foreach ($dbModules as $tempModule)
								{
								?>
								<div id="w-node-_186fbe43-5fbe-0034-e8b4-787e8adcfd3f-ef9340bc" class="card whats-included">
									<a href="<?php echo $tempModule[3]; ?>" target="_blank" style="text-decoration: none;">
										<div class="card-sales-home-content">
											<div class="display-3"><?php echo $tempModule[1]; ?></div>
										</div>
									</a>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php getAuthFooter(); ?>
		</div>
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		<script src="assets/js/file.js" type="text/javascript"></script>
	</body>
</html>