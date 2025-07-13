<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Glam Geet Styles</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/forget.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
<?php include 'header.php'; ?>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <a href="login.php" style="margin-top: 5px;">Go Back</a>

                <header>Forgot Password</header>

                <p style="font-size:12px; color:green">
                    <?php echo isset($success_message) ? $success_message : '' ?></p>
                    <p style="font-size:15px; color:white">
                            <?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                <form action="" method="POST">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input">
                        
                    </div>
                    <div class="field button-field">
                        <button name='proceed-button'>Proceed</button>
                    </div>
                </form>
            </div>

        </div>

    </section>

    <!-- JavaScript -->
    <script src="login.js"></script>
</body>