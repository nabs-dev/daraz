<?php
session_start();
include "db.php";
if (!isset($_SESSION['user'])) echo "<script>window.location.href='login.php';</script>";

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $_SESSION['cart'][] = $_POST['product_id'];
}

if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

$cart_items = $_SESSION['cart'];
$products = [];
$total = 0;

foreach ($cart_items as $id) {
    $res = $conn->query("SELECT * FROM products WHERE id=$id");
    if ($row = $res->fetch_assoc()) {
        $products[] = $row;
        $total += $row['price'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart - Daraz Clone</title>
    <style>
        body { font-family: Arial; background: #f3f3f3; }
        .box { width: 700px; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        img { height: 80px; border-radius: 8px; }
        .btn { background: #ff6f00; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; }
        .total { font-size: 20px; font-weight: bold; text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
<div class="box">
    <h2>Your Cart</h2>
    <?php if (count($products) == 0): ?>
        <p>No items in cart.</p>
    <?php else: ?>
    <table>
        <tr><th>Image</th><th>Name</th><th>Price</th><th>Action</th></tr>
        <?php foreach ($products as $index => $p): ?>
            <tr>
                <td><img src="<?= $p['image'] ?>"></td>
                <td><?= $p['name'] ?></td>
                <td>Rs. <?= $p['price'] ?></td>
                <td><a class="btn" href="?remove=<?= $index ?>">Remove</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="total">Total: Rs. <?= $total ?></div><br>
    <a class="btn" href="checkout.php">Proceed to Checkout</a>
    <?php endif; ?>
</div>
</body>
</html>
