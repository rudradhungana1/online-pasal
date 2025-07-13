<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<div class='error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<div class='success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glam Geet Styles</title>
    <!---------------  CSS  --------------------->
    <link rel="stylesheet" href="css/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
     
        <div class="form_box">
           <h1> Login </h1>
            <form id="login" class="input_group" method="post" action="login_handler.php">
                <div class="form_div">
                    <input type="text" id="login_username" name="login_username" class="form_input" placeholder=" " autocomplete="off" required>
                    <label for="" class="form_label">User Name</label>
                </div>
                <div class="form_div">
                    <input type="password" id="login_password" name="login_password" class="form_input" placeholder=" " autocomplete="off" required>
                    <label for="" class="form_label">Password</label>
                </div>
                <div class="g-recaptcha" data-sitekey="6Lc03jwlAAAAAJ8jcy9P-82hQq4chU4aF_TfHXZK"></div>
                    <br>
                <button type="submit" class="submit_btn">Log in</button>
                <div class="login-footer">
                    <p>Not registered yet ? <a href="register.php">Register Here</a></p>
                    <p>Forgot Password ? <a href="forgot_password.php"> Click Here</a></p>
</div>
            </form> 
        </div>
    </div>
    
    <script src="script.js"></script> 
 </body>

  </html>