<?php
session_start();
$mysqli = new mysqli("db", "user", "password", "mydb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $clid = $_SESSION['user_id'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $tax = $_POST['tax'];
    $total = $_POST['total'];

    $stmt = $mysqli->prepare("INSERT INTO INVOICES (CLID, DESCRIPTION, AMOUNT, TAX, TOTAL) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $clid, $description, $amount, $tax, $total);
    
    if ($stmt->execute()) {
        echo "Invoice created successfully";
    } else {
        echo "Error: " . $mysqli->error;
    }

    $stmt->close();
} else {
    echo "User not logged in";
}

$mysqli->close();
?>
