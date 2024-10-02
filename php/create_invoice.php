<?php
/** Session loading */
session_start();

/** Database connection */
$mysqli = new mysqli("db", "wingbuddypromo_admin", "N97a45Drs57a5#6A6E2!rte", "wingbuddypromo_db");

/** Kill the process if the database is not connected */
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

/** If we find a user logged in the session the app give access to the invoice submission form */
if (isset($_SESSION['user_id'])) {
    /** We get the invoice form datas */
    $clid = $_SESSION['user_id'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $tax = $_POST['tax'];
    $total = $_POST['total'];

    /** We prepare the sql request */
    $stmt = $mysqli->prepare("INSERT INTO INVOICES (CLID, DESCRIPTION, AMOUNT, TAX, TOTAL) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $clid, $description, $amount, $tax, $total);
    
    /** If we can insert a new invoice we confirm that it work */
    if ($stmt->execute()) {
        echo "Invoice created successfully";
    } else { /** Else we notify the user */
        echo "Error: " . $mysqli->error;
    }
    /** We close the current request */
    $stmt->close();
} else {
  /** If we didn't find a user logged */
    echo "User not logged in";
}

/** We close the database connection */
$mysqli->close();
?>
