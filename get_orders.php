<?php
session_start();
header('Content-Type: application/json');

// If not logged in, return unauthorized
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Connect to your database
$conn = new mysqli('localhost', 'root', 'root', 'coffee_db', 3308);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection error']);
    exit();
}

// Fetch only the orders belonging to the current user
$sql = "SELECT item, price, quantity FROM orders WHERE user_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);

$stmt->close();
$conn->close();
?>