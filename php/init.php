<?php
/** Database connection */
$mysqli = new mysqli("db", "wingbuddypromo_admin", "N97a45Drs57a5#6A6E2!rte", "wingbuddypromo_db");

/** Kill the process if the database is not connected */
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

/** We create 2 SQL tables in the database which will be containing users information and invoices informations */
$sql_clients = "CREATE TABLE IF NOT EXISTS CLIENTS (
    CLID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255),
    EMAIL VARCHAR(255) UNIQUE,
    PASSWORD VARCHAR(255),
    TELEPHONE VARCHAR(15)
) ENGINE=InnoDB;";

$sql_invoices = "CREATE TABLE IF NOT EXISTS INVOICES (
    INID INT AUTO_INCREMENT PRIMARY KEY,
    CLID INT,
    DESCRIPTION VARCHAR(255),
    AMOUNT DECIMAL(10, 2),
    TAX DECIMAL(10, 2),
    TOTAL DECIMAL(10, 2),
    FOREIGN KEY (CLID) REFERENCES CLIENTS(CLID)
) ENGINE=InnoDB;";

/** If the creation succeed we confirm the user */
if ($mysqli->query($sql_clients) === TRUE && $mysqli->query($sql_invoices) === TRUE) {
    echo "Tables created successfully";
} else { /** Else we notify the user */
    echo "Error creating tables: " . $mysqli->error;
}

/** We close the database connection */
$mysqli->close();
