<!DOCTYPE html>
<html>
<head>
    <title>Login | JobHub</title>
</head>
<body>
<h2>Login</h2>

<?php
if (isset($_GET['error'])) {
    echo "<p style='color:red;'>".htmlspecialchars($_GET['error'])."</p>";
}
?>

<form action="models/login_user.php" method="POST">   <!-- updated name -->
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="pass" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
