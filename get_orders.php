<?php
$db_name = 'coffee_db';
$username = 'root';
$password = 'root';
$host = 'localhost';
$port = '3308';
$dsn = "mysql:host=$host;port=$port;dbname=$db_name";

header('Content-Type: application/json');

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM orders ORDER BY id DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($orders);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>