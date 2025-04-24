<?php
session_start();
if (!isset($_SESSION['user'])) echo "<script>window.location.href='login.php';</script>";

$total = 0;
include "db.php";

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $id) {
        $res = $conn->query("SELECT * FROM products WHERE id=$id");
        if ($row = $res->fetch_assoc()) $total += $row['price'];
    }
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Daraz Clone</title>
    <style>
        body { font-family: Arial; background: #e0ffe0; }
        .box { width: 500px; margin: 100px auto; padding: 40px; background: white; text-align: center;
               border-radius: 10px; box-shadow: 0 0 10px #aaa; }
        h2 { color: green; }
        .btn {
            margin-top: 20px; padding: 10px 20px; background: #ff6f00; color: white; border: none;
            border-radius: 5px; cursor: pointer;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>✅ Order Placed Successfully!</h2>
    <p>Total Amount: Rs. <?= $total ?></p>
    <button class="btn" onclick="window.location.href='home.php'">Back to Home</button>
</div>
</body>
</html>
