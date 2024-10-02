<?php
/** Session loading */
session_start();
/** Database connection */
$mysqli = new mysqli("db", "wingbuddypromo_admin", "N97a45Drs57a5#6A6E2!rte", "wingbuddypromo_db");

/** Kill the process if the database is not connected */
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
/** We get the register form datas */
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$telephone = $_POST['telephone'];
/** We prepare the sql request */
$stmt = $mysqli->prepare("INSERT INTO CLIENTS (NAME, EMAIL, PASSWORD, TELEPHONE) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $password, $telephone);

/** If we can insert a new user we confirm that it work */
if ($stmt->execute()) {
    echo "Success";
} else {
    /** Else If we have already this user in the database we notify the user */
    if ($mysqli->errno == 1062) {
        echo "Existing User";
    } else { /** Else we notify the user that an erro occur during the process */
        echo "Error: " . $mysqli->error;
    }
}
/** We close the current request and the database connection */
$stmt->close();
$mysqli->close();
?>
