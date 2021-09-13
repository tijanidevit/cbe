<?php 
include "./dependencies/functions.php";
// if (isset($_SESSION["student_logged"])) {
// 	header("location: ./home.php");
// }
// include_once '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Student Authenication Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<?php if (!file_exists("setup/images/school-favicon.png")) {
	       ?>
		<link rel="shortcut icon" href="setup/images/default-favicon.png">
	<?php } else {?>
		<link rel="shortcut icon" href="setup/images/school-favicon.png">
		<?php } ?>

	

	<!-- App css -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

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
							<?php if (!file_exists("setup/images/school-logo.png")) {
						       ?>
							<span style=";"><img src="setup/images/default-logo.png" alt="" height="75"></span>
						<?php } else {?>
							<span style=";"><img src="setup/images/school-logo.png" alt="" height="75"></span>
							<?php } ?>
						</a>
					</div>
					<div class="card mycard mt-5" style=""> 
						
						<div class="card-body  p-4">

							<div class="text-center mb-4" style="margin-bottom: 1.0rem">
								<h4 class="text-uppercase mt-0">Sign In</h4>
							</div>
							<?php if (isset($_SESSION['submit-success'])) {
								echo displaySuccess("<h4 class='text-center'>YOUR EXAMINATION HAS SUCCESSFULLY BEEN SUBMITTED.</h4>");
							} ?>
							<form method="post" action="actions/student-authentication.php" id="student-login-form">
								
				                 <div class="row">
				                 	<div id="response-msg" class="alert alert-danger text-center col-12" style="display: none;"></div>
				                 </div>

									<div class="form-group mb-3">
										<label for="form_username">Exam No</label>
                      				<input id="form_username" name="exam_no" class="form-control required" type="text"/>
									</div>

									<div class="form-group mb-3">
										<label for="form_password">PIN</label>
                      					<input id="form_password" name="access_pin" class="form-control required" type="password"/>
									</div>

									<input name="student-login" class="form-control" type="hidden" value="student-login" />
									<div class="form-group mb-0 text-center">
										<button class="btn bg-theme-colored2 btn-block mybtn" type="submit" name="login" id="student-login"> Log In </button>
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
			<div id="process-loader">
            <h3 class="text-center text-white"><i class="fa fa-spin fa-spinner"></i> <i>Please Wait...</i></h3>
        </div>
			<!-- end page -->

			<!-- Vendor js -->
			<script src="assets/js/vendor.min.js"></script>

			<!-- App js-->
			<script src="assets/js/app.min.js"></script>
			<!-- App js-->
			<script src="assets/js/custom.js"></script>

		</body>
		</html>
