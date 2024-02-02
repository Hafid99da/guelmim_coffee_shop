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
        $tabll = $_POST['tabll'];
        $person = $_POST['person'];
        $menuId = $_POST['menuId'];
        
        $stmt = $pdo->prepare("INSERT INTO `ordermenu`(`name`, `tabll`, `person`, `menuId`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $tabll, $person, $menuId]);

        header('Location: menu.php');
        exit;
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

</style>

    </style>
</head>
<body>
    <div class="order">
        <h1 class="heading"><span>Order</span> Form</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" name="menuId" value="<?php echo $_POST['menuId']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br><br>

            <label for="tabll">table Number:</label>
            <input type="number" name="tabll" id="tabll" required><br><br>

            <label for="prson">how many person:</label>
            <input type="number" name="person" id="person" required><br><br>

            <button type="submit" name="submit">Submit Order</button>
        </form>
    </div>
</body>
</html>


<script src="js/script.js"></script>
</body>
</html>