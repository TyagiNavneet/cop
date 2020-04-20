<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Cavendish Park - Residential Building Services</title>

	<!-- Material Design for Bootstrap fonts and icons -->
	<link rel="icon" type="image/png" href="assets/images/favicon.png" />

	<!-- Material Design for Bootstrap CSS -->
	<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
	<link href="assets/css/login.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

</head>

<body>
	<?php
error_reporting(0);

	?>
	<div class="container center_div login-page">
		<div class="row">
			<div class="col-md-6 col-lg-5  white-color blue_bg">
				<div class="login_intro">
					<div class="title">Login</div>
					<div class="branding">
						<a href="#"><img src="assets/images/logo-login.png"></a>
						<p>A COMPLETE SERVICE FOR HOMEOWNERS<br>ACCREDITED, TRUSTWORTHY AND COMPETITIVE</p>
					</div>
				</div>
			</div>
			<div class="col-md-6 white-bg col-lg-7 p-0">
				<div class="form-container">
					<div class="login_icon  text-center">
						<img src="assets/images/login_icon.png" alt="">
					</div>
					<div class="form">
						<form method="POST" action="checklogin.php">
							<div class="form-group">
								<label for="username" class="bmd-label-floating">Enter Your Email</label>
								<input type="text" class="form-control" name="username" id="username" required>
							</div>
							<div class="form-group">
								<label for="userpassword" class="bmd-label-floating">Enter Your Password</label>
								<input type="password" class="form-control" name="userpassword" id="userpassword" required>
							</div>
							<!--<div class="form-group text-right">
							<a href="mailto:paul@cavendishpark.co.uk">Forgot Password ?</a>
						</div> -->
							<button type="submit" class="btn btn-raised btn-primary btn-block">Login</button>
						</form>
					</div>
					<?PHP if (!empty($_GET['loginerror'])) {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: #f2dede;border-color: #ebcccc;color: #a94442;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>'
							. $_GET['loginerror'] . '</div>';
					}  ?>

				</div>
			</div>
		</div>
	</div>
	<footer class="text-center dashboard-footer">
		<p>Copyright © Cavendish Park 2020. All Rights reserved</p>
	</footer>

	<!-- js added -->
	<script src="assets/js/vendor.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('body').bootstrapMaterialDesign();
		});
	</script>

</body>