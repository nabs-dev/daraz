<?php
session_start();
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username']; $p = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE username='$u' AND password='$p'");
    if ($res->num_rows > 0) {
        $_SESSION['user'] = $u;
        echo "<script>window.location.href='home.php';</script>";
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; background: #ffe6cc; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #999; width: 300px; text-align: center; }
        input, button { width: 90%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { background: #ff6f00; color: white; border: none; }
        .error { color: red; }
    </style>
</head>
<body>
<div class="box">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>Login</button>
        <p><a href="signup.php">Create new account</a></p>
    </form>
</div>
</body>
</html>
