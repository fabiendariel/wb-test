<?php
session_start();
$mysqli = new mysqli("db", "user", "password", "mydb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("SELECT CLID, PASSWORD FROM CLIENTS WHERE EMAIL = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($clid, $hashed_password);
$stmt->fetch();

if (password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $clid;
    echo $clid;
} else {
    echo "Invalid credentials";
}

$stmt->close();
$mysqli->close();
?>
