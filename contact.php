<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "coffee";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $table = "contact";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $review = $_POST['review'];

    $stmt = $pdo->prepare('INSERT INTO contact (name, email, number, review, date) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP())');
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $number);
    $stmt->bindParam(4, $review);
    
    $stmt->execute();

    $message = "review sent successfully! <br> thank you";
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
            <a href="menu.html">menu</a>
            <a href="products.php">products</a>
            <a href="store.html">store design</a>
            <a href="#contact">contact us</a>
        </nav>
        
        <div class="icons">
            <div class="fa-solid fa-mug-saucer" id="mug-sugar"></div>
            <div class="fa-solid fa-bars" id="menu-btn"></div>
        </div>
    
    </header>

<!--header end-->
<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <form action="contact.php" method="POST">
        <?php if (isset($message)) : ?>
        <div class="successMessage" style="font-size: 2rem; color :#50d174;"><?php echo $message; ?></div>
        <?php endif; ?>
        <h3>get in touch</h3>
        <div class="inputBox">
            <span class="fas fa-user"></span>
            <input type="text" placeholder="name" name="name">
        </div>
        <div class="inputBox">
            <span class="fas fa-envelope"></span>
            <input type="email" placeholder="email" name="email">
        </div>
        <div class="inputBox">
            <span class="fas fa-phone"></span>
            <input type="number" placeholder="number" name="number">
        </div>
        <div class="inputBox">
            <span class="fa-solid fa-pen-nib"></span>
            <input type="text" placeholder="help us to improve our service with your review" name="review">
        </div>

        <input type="submit" value="Send now" class="btn btn-outline-secondary">
    </form>
    
    <h1 class="heading"> <span>find</span> us </h1>

    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3489.74478648503!2d-10.070431384930407!3d28.99493277433707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb503d72d5c1afb%3A0x6847398c7134dc9a!2sISTA%20NTIC%20Guelmim!5e0!3m2!1sfr!2sma!4v1672783315762!5m2!1sfr!2sma" allowfullscreen="" loading="lazy"></iframe>

</section>

<!-- contact section ends -->
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
        <a href="menu.html">menu</a>
        <a href="products.php">products</a>
        <a href="store.html">store design</a>
        <a href="#contact">contact us</a>
    </div>

    <div class="credit">created by <span>Jibaili & Daoudi</span></div>

</section>

<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>