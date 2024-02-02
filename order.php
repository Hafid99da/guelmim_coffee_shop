<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "coffee";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $stmt = $pdo->prepare("SELECT quantity FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentQuantity = $product['quantity'];

        if ($currentQuantity >= $quantity) {
            $updatedQuantity = $currentQuantity - $quantity;
            $stmt = $pdo->prepare("UPDATE products SET quantity = ? WHERE id = ?");
            $stmt->execute([$updatedQuantity, $productId]);
            
            $stmt = $pdo->prepare("INSERT INTO `orders`(`name`, `adresse`, `phone`, `productId`, `quantity`) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $address, $phone, $productId, $quantity]);

            header('Location: products.php');
            exit;

        } else {
            $errorMessage = "Insufficient quantity available.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guelmim Coffee Shop</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/91721256ac.js" crossorigin="anonymous"></script>
    <style>
    .order {
        width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #fff;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .error-message {
        color: red;
        margin-top: 10px;
    }
</style>

    </style>
</head>
<body>
    <div class="order">
        <h1 class="heading"><span>Order</span> Form</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" name="product_id" value="<?php echo $_POST['product_id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br><br>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required><br><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required><br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required><br><br>

            <button type="submit" name="submit">Submit Order</button>

            <?php if (isset($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>


<script src="js/script.js"></script>
</body>
</html>
