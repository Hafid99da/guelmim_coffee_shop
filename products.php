<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "coffee";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guelmim Coffe shop</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/91721256ac.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--header start-->
    <header class="header">

        <a href="#" class="logo">
            <img src="images/home/Logo.png" alt="">
        </a>
    
        <nav class="navbar">
            <a href="index.html">home</a>
            <a href="index.html#about">about us</a>
            <a href="menu.php">menu</a>
            <a href="#products">products</a>
            <a href="store.html">store design</a>
            <a href="contact.php">contact us</a>
        </nav>
        
        <div class="icons">
            <div class="fa-solid fa-mug-saucer" id="mug-sugar"></div>
            <div class="fa-solid fa-bars" id="menu-btn"></div>
        </div>
    
    </header>
<!--header end-->
<!-- products section starts  -->

<section class="products" id="products">
    <h1 class="heading"> our <span>products</span> </h1>
    <div class="card-deck">
    <?php
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $name = $product['name'];
        $image = $product['image'];
        $price = $product['price'];
        $quantity = $product['quantity'];
        
        echo '<div class="card">';
            echo '<img class="card-img-top" src="'.$image.'" alt="Card image cap">';
            echo '<div class="card-body">';
                echo '<h2 class="card-title">'.$name.'</h2>';
                echo '<p class="card-text"><legend>Price: '.$price.' DH</legend></p>';
            echo '</div>';
            echo '<div class="card-footer">';
                echo '<form method="POST" action="order.php">';
                echo '<input type="hidden" name="product_id" value="'.$product['id'].'">';
                echo '<button type="submit" name="order" class="btn btn-dark" style="width: 100%; height:3rem">Order Now</button>';
                echo '</form>';
            echo '</div>';
        echo '</div>';
        
        }
    ?>
    </div>
</section>

<!-- products section ends -->
<!-- footer section starts-->

<section class="footer">

    <div class="share">
        <a href="#" class="fa-brands fa-facebook"></a>
        <a href="#" class="fa-brands fa-twitter"></a>
        <a href="#" class="fa-brands fa-whatsapp"></a>
        <a href="#" class="fa-brands fa-instagram"></a>
        <a href="#" class="fa-brands fa-linkedin"></a>
        <a href="#" class="fa-brands fa-tiktok"></a>
        <a href="#" class="fa-brands fa-paypal"></a>
    </div>

    <div class="links">
        <a href="index.html">home</a>
        <a href="index.html#about">about us</a>
        <a href="menu.php">menu</a>
        <a href="#products">products</a>
        <a href="store.html">store design</a>
        <a href="contact.php">contact us</a>
    </div>

    <div class="credit">created by <span>Jibaili & Daoudi</span></div>

</section>

<!-- footer section ends -->
<script src="js/script.js"></script>
    
</body>
</html>