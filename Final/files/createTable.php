<?php
$servername = "localhost";
$username = "bowen";
$password = "bowen1234";
$dbname = "testing";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE breweries (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
Name VARCHAR(50) NOT NULL,
Address1 VARCHAR(50) NOT NULL,
Address2 VARCHAR(50),
City VARCHAR(25) NOT NULL,
State VARCHAR(2) NOT NULL,
ZIP VARCHAR(10) NOT NULL,
Phone VARCHAR(12),
Established VARCHAR(4),
Website VARCHAR(50)
)";

if ($db->query($sql) === TRUE) {
    echo "Table breweries created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

$db->close();
?>