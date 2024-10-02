<?php
/** Session loading */
session_start();
/** Database connection */
$mysqli = new mysqli("db", "wingbuddypromo_admin", "N97a45Drs57a5#6A6E2!rte", "wingbuddypromo_db");

/** Kill the process if the database is not connected */
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $clid = $_SESSION['user_id'];
    $result = $mysqli->query("SELECT * FROM INVOICES WHERE CLID = $clid");

    if ($result->num_rows > 0) {
        echo "<table class=\"table table-striped\">
        <thead><tr><th>ID</th><th>Description</th><th>Amount</th><th>Tax</th><th>Total</th></tr></thead><tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['INID']}</td><td>{$row['DESCRIPTION']}</td><td>{$row['AMOUNT']}</td><td>{$row['TAX']}</td><td>{$row['TOTAL']}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No invoices found.";
    }
} else {
    echo "User not logged in.";
}

$mysqli->close();
?>
