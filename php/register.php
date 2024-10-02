<?php
session_start();
$mysqli = new mysqli("db", "user", "password", "mydb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$telephone = $_POST['telephone'];

$stmt = $mysqli->prepare("INSERT INTO CLIENTS (NAME, EMAIL, PASSWORD, TELEPHONE) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $password, $telephone);

if ($stmt->execute()) {
    echo "Success";
} else {
    if ($mysqli->errno == 1062) {
        echo "Existing User";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$stmt->close();
$mysqli->close();
?>
