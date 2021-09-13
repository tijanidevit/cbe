<?php 

require_once "./dependencies/functions.php";

if (isset($_POST['login'])) {
	$username = test_input($_POST['username']);
	$access_pin = test_input($_POST['access_pin']);
	$error = '';

	$query = $conn->prepare("SELECT * FROM admin WHERE username='$username'");
	$query->execute();
	if ($query->rowCount() == 0) {
		$error = displayError("Unrecognized Username. Please confirm your username and try again.");
	}else{
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if ($row['active'] != 1) {
			$error = displayWarning("Opps! It appears that this username has been deactivated.");
		}else{
			if (encrypt($access_pin) !== $row['access_pin']) {
				$error = displayError("Access denied! Access pin is incorrect.");
			}else{
				$_SESSION['admin_logged'] = $row['admin_id'];
				$_SESSION['response'] = displaySuccess("Welcome back.");
				header("Location: dashboard.php");
				exit();
			}
		}
	}

}
 ?>