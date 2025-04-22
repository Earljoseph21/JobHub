<?php
session_start();
require 'dbconnection.php';

$em = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['pass']);

$con = create_connection();

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT id, username, password, user_type FROM user WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $em);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];

        if ($user['user_type'] == 'admin') {
            header("Location: ../admin_dashboard.php");
        } elseif ($user['user_type'] == 'vendor') {
            header("Location: ../vendor_dashboard.php");
        } else {
            header("Location: ../user_home.php");
        }
        exit;
    } else {
        header("Location: ../login.php?error=Invalid Password");
        exit;
    }
} else {
    header("Location: ../login.php?error=User Not Found");
    exit;
}

$stmt->close();
$con->close();
?>
