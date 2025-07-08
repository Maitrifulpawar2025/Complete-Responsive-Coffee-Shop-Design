<?php
// DB connection
$db_name = 'coffee_db';
$username = 'root';
$password = 'root';
$host = 'localhost';
$port = '3308';
$dsn = "mysql:host=$host;port=$port;dbname=$db_name";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "DB Connection Error: " . $e->getMessage();
    exit;
}

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect inputs
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $message = $_POST['message'] ?? '';
    $rating = $_POST['rating'] ?? 0;

    // Validation
    if ($name == '' || $email == '' || $mobile == '' || $message == '') {
        echo "Validation Error: All fields are required.";
        exit;
    }

    try {
        // Insert feedback
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, mobile, message, rating) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $mobile, $message, $rating]);
        echo "success";
    } catch (PDOException $e) {
        echo "SQL Error: " . $e->getMessage(); // 🛠️ Real-time error print
    }
}
?>
