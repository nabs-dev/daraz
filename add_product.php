<?php
session_start();
include "db.php";
if (!isset($_SESSION['user'])) echo "<script>window.location.href='login.php';</script>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    // Upload Image
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $folder = "uploads/" . basename($imageName);
    move_uploaded_file($imageTmp, $folder);

    // Insert into database
    $conn->query("INSERT INTO products (name, description, price, image, category, stock)
                  VALUES ('$name', '$desc', '$price', '$folder', '$category', '$stock')");
    echo "<script>alert('Product Added!'); window.location.href='home.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body { font-family: Arial; background: #f3f3f3; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .form-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); width: 400px; }
        input, textarea, select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { background: #ff6f00; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Add Product</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="number" name="price" placeholder="Price (PKR)" required>
            <select name="category" required>
                <option value="">Select Category</option>
                <option value="Electronics">Electronics</option>
                <option value="Fashion">Fashion</option>
            </select>
            <input type="number" name="stock" placeholder="Stock Quantity" required>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
