<?php
// Database configuration
$dbHost = 'localhost'; // or your database host
$dbUsername = 'root'; // your database username
$dbPassword = ''; // your database password
$dbName = 'testdb'; // your database name

// Establish database connection
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//echo "Connected successfully";
?>
