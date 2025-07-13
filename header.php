<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Glam Gita Styles </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <section id="header">
        <div>
            <a href="homepage.php"><img src="Images/logo.png" class="logo" alt="logo"></a>
        </div>
        <div class="search-box">
            <form action="" method="POST">
                <div class="input-box">
                    <input type="text" name="search" placeholder="Search...">
                </div>
            </form>
        </div>
        <div>
            <ul id="navbar">
                <li><a class="active" href="homepage.php">Home</a></li>
                <li><a href="newarrivals.php">New Arrival</a></li>
                <li id="lg-bag">
                    <a href="" id="cart-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                </li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="#" id="cart-mobile-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            <i id="bar" class="fa fa-outdent" aria-hidden="true"></i>
        </div>
    </section>

    <script>
        // Function to display login message
        function showLoginMessage(event) {
            event.preventDefault(); // Prevent default link behavior
            alert("Please log in to view your cart.");
        }

        // Attach event listener to desktop cart link
        const cartLink = document.getElementById("cart-link");
        if (cartLink) {
            cartLink.addEventListener("click", showLoginMessage);
        }

        // Attach event listener to mobile cart link
        const cartMobileLink = document.getElementById("cart-mobile-link");
        if (cartMobileLink) {
            cartMobileLink.addEventListener("click", showLoginMessage);
        }
    </script>
</body>
</html>
