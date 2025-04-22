<?php
require 'dbconnection.php';

$un = htmlspecialchars($_POST['uname']);
$fn = htmlspecialchars($_POST['fname']);
$ln = htmlspecialchars($_POST['lname']);
$em = htmlspecialchars($_POST['email']);
$gen = htmlspecialchars($_POST['gender']);
$bdate = htmlspecialchars($_POST['bdate']);
$pass = htmlspecialchars($_POST['pass']);
$cpass = htmlspecialchars($_POST['conpass']);

echo "User name: $un <br>";
echo "First name: $fn <br>";
echo "Last name: $ln <br>";
echo "Email: $em <br>";
echo "Gender: $gen <br>";
echo "Birthdate: ".date('m/d/y', strtotime($bdate))." <br>";
echo "Password: $pass <br>";
echo "Confirm password: $cpass <br>";

$con = create_connection();

if($con->connect_error){
    die("Failed to connect: ".$con->connect_error);
}

$uname_error = 0;
$email_error = 0;
$password_error = 0;

// Check username
$stmt = $con->prepare("SELECT id FROM user WHERE username = ?");
$stmt->bind_param("s", $un);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0) {
    $uname_error = 1;
}
$stmt->close();

// Check email
$stmt = $con->prepare("SELECT id FROM user WHERE email = ?");
$stmt->bind_param("s", $em);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0) {
    $email_error = 1;
}
$stmt->close();

// Check passwords match
if($pass !== $cpass){
    $password_error = 1;
}

if($uname_error == 0 && $email_error == 0 && $password_error == 0){
    // Hash the password before saving
    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

    $stmt = $con->prepare("INSERT INTO user (username, firstname, lastname, email, gender, birthdate, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $un, $fn, $ln, $em, $gen, $bdate, $hashed_pass);

    if($stmt->execute()){
        header("Location: ../login.php?regsuccess=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: ../registration.php?uname_error=$uname_error&email_error=$email_error&password_error=$password_error");
}

$con->close();
?>
