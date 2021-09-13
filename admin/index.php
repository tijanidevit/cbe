<?php 
include "./dependencies/functions.php";
if (isset($_SESSION["admin_logged"])) {
	header("location: ./dashboard.php");
}
include_once 'actions/admin-authentication.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Admin Authenication Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<?php if (!file_exists("../setup/images/school-favicon.png")) {
	       ?>
		<link rel="shortcut icon" href="../setup/images/default-favicon.png">
	<?php } else {?>
		<link rel="shortcut icon" href="../setup/images/school-favicon.png">
		<?php } ?>

	

	<!-- App css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />

	<style>
		.mycard{
			background-color: rgba(255,255,255,.4);border-radius: 20px;
		}
		.mycard input, .mycard button{
			border-radius: 5px
		}
		.bg-theme-colored2{
			background-color: #0274A6;
		}
	</style>

</head>

<body class="authentication-bg body">

	<div class="home-btn d-none d-sm-block">
		<a href="index.php"><i class="fas fa-home h2 text-dark"></i></a>
	</div>

	<div class="account-pages mt-5 mb-5">
		<div class="container">
			<br/><br/>
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="text-center">
						<a href="index.php">
							<?php if (!file_exists("../setup/images/school-logo.png")) {
						       ?>
							<span style=";"><img src="../setup/images/default-logo.png" alt="" height="75"></span>
						<?php } else {?>
							<span style=";"><img src="../setup/images/school-logo.png" alt="" height="75"></span>
							<?php } ?>
						</a>
					</div>
					<div class="card mycard mt-5" style=""> 

						<div class="card-body  p-4">

							<div class="text-center mb-4" style="margin-bottom: 1.0rem">
								<h4 class="text-uppercase mt-0">Sign In</h4>
							</div>

							<form method="post">

								<?php if(isset($_SESSION['response'])){
				                  echo $_SESSION['response'];
				                  unset($_SESSION['response']);
				                }
				                if(isset($error)){
				                  echo $error;
				                }
				                 ?>

									<div class="form-group mb-3">
										<label for="form_username">Username</label>
                      				<input id="form_username" name="username" class="form-control required" type="text">
									</div>

									<div class="form-group mb-3">
										<label for="form_password">PIN</label>
                      					<input id="form_password" name="access_pin" class="form-control required" type="password">
									</div>

									<div class="form-group mb-3">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
											<label class="custom-control-label" for="checkbox-signin">Remember me</label>
										</div>
									</div>

									<div class="form-group mb-0 text-center">
										<button class="btn bg-theme-colored2 btn-block mybtn" type="submit" name="login"> Log In </button>
									</div>

									<div class="form-group mb-0 text-center">
										<br />
										</div>

									</form> 
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end page -->

			<!-- Vendor js -->
			<script src="../assets/js/vendor.min.js"></script>

			<!-- App js-->
			<script src="../assets/js/app.min.js"></script>

		</body>
		</html>
