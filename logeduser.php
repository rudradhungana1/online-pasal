<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Glam Gita Styles </title>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER -->
    <?php include 'header2.php'; ?>
<!-- SLIDER -->
<div id="2"></div>
<script>
    load("slider.html");
    function load(url)
    {
        req = new XMLHttpRequest();
        req.open("GET", url, false);
        req.send(null);
        document.getElementById(2).innerHTML = req.responseText;
    }
</script>
<!-- new Product -->
<div id="3"></div>
<script>
    load("new2.php");
    function load(url)
    {
        req = new XMLHttpRequest();
        req.open("GET", url, false);
        req.send(null);
        document.getElementById(3).innerHTML = req.responseText;
    }
</script>

<section id="banner" class="section-m1">
    <h4>Dashain Offer!</h4>
    <h2>Up to<span> 70% Off</span>-All t-Shirt</h2>
    <button class="normal">Explore more</button>
</section>

<!-- Categories -->
<div id="4"></div>
<script>
    load("categories.html");
    function load(url)
    {
        req = new XMLHttpRequest();
        req.open("GET", url, false);
        req.send(null);
        document.getElementById(4).innerHTML = req.responseText;
    }
</script>

<!-- Categories -->
<div id="5"></div>
<script>
    load("footer2.php");
    function load(url)
    {
        req = new XMLHttpRequest();
        req.open("GET", url, false);
        req.send(null);
        document.getElementById(5).innerHTML = req.responseText;
    }
</script>


</body>

<!-- slider JS START -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
    $(document).ready(function()
    {
    $('#containerSlider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        });
    });
</script>
<!-- slider JS ENDS -->
<script src="script.js">
    </script>
</html>