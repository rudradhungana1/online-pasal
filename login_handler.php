<?php
// Start session
session_start();

// Connect to database
require_once('db_config.php');

// Define constants for lockout threshold and duration
define('MAX_FAILED_ATTEMPTS', 3);
define('LOCKOUT_DURATION', 5); // minutes

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = mysqli_real_escape_string($conn, $_POST['login_username']);
    $password = mysqli_real_escape_string($conn, $_POST['login_password']);

    // Verify reCAPTCHA response
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $secret_key = "6Lc03jwlAAAAAGNaAq3yKiO-XHqQaTxaEMf1m_1P";
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}");
    $response_data = json_decode($verify_response);
    if (!$response_data->success) {
        $_SESSION['error'] = "Invalid reCAPTCHA response.";
        header("location: login.php");
        exit;
    }

    // Check if the username exists
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($result && mysqli_num_rows($result) == 1) {
        // If the username exists, verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, log the user in
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['success'] = "Successfully logged in.";
            header("location: logeduser.php"); // Redirect to user page
            exit;
        } else {
            // Incorrect password
            $_SESSION['error'] = "Invalid Password.";
            header("location: login.php");
            exit;
        }
    } else {
        // Username not found
        $_SESSION['error'] = "Invalid Username.";
        header("location: login.php");
        exit;
    }
}

// Close database connection
mysqli_close($conn);
?>
