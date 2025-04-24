<?php
include "db.php";
session_start();
if (!isset($_SESSION['user'])) echo "<script>window.location.href='login.php';</script>";

$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM products WHERE 1=1";
if ($category) $query .= " AND category='$category'";
if ($search) $query .= " AND name LIKE '%$search%'";
$products = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daraz Clone - Home</title>
    <style>
        body { font-family: Arial; margin: 0; background: #fafafa; }
        .header { background: #ff6f00; color: white; padding: 20px; text-align: center; }
        .search-bar { text-align: center; padding: 20px; }
        input[type="text"] { width: 300px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        .categories { text-align: center; margin-bottom: 20px; }
        .categories a { margin: 0 10px; text-decoration: none; color: #ff6f00; font-weight: bold; }
        .products { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; padding: 20px; }
        .product { background: white; border-radius: 10px; box-shadow: 0 0 5px #ccc; padding: 10px; text-align: center; }
        img { max-width: 100%; height: 200px; border-radius: 8px; }
        .btn { background: #ff6f00; color: white; padding: 8px 12px; border: none; border-radius: 5px; margin-top: 10px; cursor: pointer; }
    </style>
</head>
<body>
<div class="header">
    <h1>Daraz Clone</h1>
    <a href="add_product.php" style="color:white; margin-right:20px;">Add Product</a>
    <a href="cart.php" style="color:white; margin-right:20px;">Cart</a>
    <a href="logout.php" style="color:white;">Logout</a>
</div>

<div class="search-bar">
    <form method="GET">
        <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
        <button class="btn">Search</button>
    </form>
</div>

<div class="categories">
    <a href="home.php">All</a>
    <a href="home.php?category=Electronics">Electronics</a>
    <a href="home.php?category=Fashion">Fashion</a>
    <a href="home.php?category=Home">Home</a>
</div>

<div class="products">
<?php while($row = $products->fetch_assoc()): ?>
    <div class="product">
        <img src="<?= $row['image'] ?>" alt="">
        <h3><?= $row['name'] ?></h3>
        <p>Rs. <?= $row['price'] ?></p>
        <form method="POST" action="cart.php">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <button class="btn" type="submit">Add to Cart</button>
        </form>
    </div>
<?php endwhile; ?>
</div>
</body>
</html>
