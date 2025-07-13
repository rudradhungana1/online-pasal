<?php
session_start();
// connect to the database
require_once('db_config.php');

// Verify reCAPTCHA response
$recaptcha_response = $_POST['g-recaptcha-response'];
$secret_key = "6Lc03jwlAAAAAGNaAq3yKiO-XHqQaTxaEMf1m_1P"; 
$verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}");
$response_data = json_decode($verify_response);
if (!$response_data->success) {
	$error = "Invalid reCAPTCHA response";
	header("location: register.php");
	exit;
}

// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// get the form data
	$email = $_POST["email_input"];
	$username = $_POST["user_name_input"];
	$password = $_POST["password_input"];
	$confirm_password = $_POST["confirm_password_input"];
	$status = 'active';
    $role = 'user';
	
	// check if the username is already registered
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		exit;
	}
	
	if (mysqli_num_rows($result) > 0) {
		echo "Sorry, this user is already registered. Please use a different email address.";
		exit;
	}
	
	// check if the passwords match
	if ($password != $confirm_password) {
		echo "Sorry, the passwords do not match. Please try again.";
		exit;
	}
	
	// hash the password for security
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	// insert the user's details into the database
	$sql = "INSERT INTO users (email, username, password, status, role) 
	VALUES ('$email', '$username', '$hashed_password', '$status', '$role')";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['success'] = "Successfully registered as a user";
		header("location: login.php");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	// close the database connection
	mysqli_close($conn);
}


?>
