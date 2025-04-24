<?php
session_start();
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username']; $p = $_POST['password'];
    $conn->query("INSERT INTO users (username, password) VALUES ('$u', '$p')");
    echo "<script>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body { font-family: Arial; background: #ffe6cc; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #999; width: 300px; text-align: center; }
        input, button { width: 90%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { background: #ff6f00; color: white; border: none; }
    </style>
</head>
<body>
<div class="box">
    <h2>Signup</h2>
    <form method="post">
        <input name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>Signup</button>
        <p><a href="login.php">Already have account?</a></p>
    </form>
</div>
</body>
</html>
