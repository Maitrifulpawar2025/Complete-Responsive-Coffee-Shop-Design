<?php
session_start();

$db_name = 'coffee_db';
$username = 'root';
$password = 'root';
$host = 'localhost';
$port = '3308';
$dsn = "mysql:host=$host;port=$port;dbname=$db_name";

try {
    // 1. Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo "You must be logged in to place an order.";
        exit;
    }
    $user_id = $_SESSION['user_id'];

    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Always check if POST data exists to avoid undefined index notices
    $item = isset($_POST['item']) ? trim($_POST['item']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';

    // Basic validation
    if ($item === '' || $price === '' || $quantity === '') {
        http_response_code(400);
        echo "Missing order data.";
        exit;
    }

    // 2. Insert order with user_id
    $stmt = $conn->prepare("INSERT INTO orders (user_id, item, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $item, $price, $quantity]);
    echo "Order saved!";
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
?>