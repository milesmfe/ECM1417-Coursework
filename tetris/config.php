<?php
// Database credentials.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ecm1417');
define('DB_PASSWORD', 'WebDev2021');
define('DB_NAME', 'tetris');
 
// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect to internal databse. " . mysqli_connect_error());
}
?>