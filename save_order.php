<?php
$db_name = 'coffee_db';
$username = 'root';
$password = 'root';
$host = 'localhost';
$port = '3308';
$dsn = "mysql:host=$host;port=$port;dbname=$db_name";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Always check if POST data exists to avoid undefined index notices
    $item = isset($_POST['item']) ? trim($_POST['item']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';

    // Basic validation (optional but recommended)
    if ($item === '' || $price === '' || $quantity === '') {
        http_response_code(400);
        echo "Missing order data.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO orders (item, price, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$item, $price, $quantity]);
    echo "Order saved!";
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
?>