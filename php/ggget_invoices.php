<?php
$mysqli = new mysqli("db", "user", "password", "mydb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

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

if ($mysqli->query($sql_clients) === TRUE && $mysqli->query($sql_invoices) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $mysqli->error;
}
