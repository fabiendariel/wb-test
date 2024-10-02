<?php
/** Session loading */
session_start();
/** Database connection */
$mysqli = new mysqli("db", "wingbuddypromo_admin", "N97a45Drs57a5#6A6E2!rte", "wingbuddypromo_db");

/** Kill the process if the database is not connected */
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
/** We get the login form datas */
$email = $_POST['email'];
$password = $_POST['password'];

/** We prepare the sql request */
$stmt = $mysqli->prepare("SELECT CLID, PASSWORD FROM CLIENTS WHERE EMAIL = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($clid, $hashed_password);
$stmt->fetch();

/** If we find a corresponding user with this email and password we add the user id to the session data */
if (password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $clid;
    echo $clid;
} else { /** Else we notify the user that there is a issue*/
    echo "Invalid credentials";
}

/** We close the current request and the database connection */
$stmt->close();
$mysqli->close();
?>
