<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Connect to your DB
$conn = new mysqli('localhost', 'db_username', 'db_password', 'db_name');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch orders for this user
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- home section starts -->
  <div class="home-bg">
    <section class="home" id="home">
      
    </section>
  </div>
  <!-- home section ends -->
   
<div class="container mt-5">
    <h2>Your Order History</h2>
    <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th><th>Price</th><th>Quantity</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['item']) ?></td>
                <td>₹ <?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
                <td><?= htmlspecialchars($row['order_date']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No orders yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>