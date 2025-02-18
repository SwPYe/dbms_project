<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = ''; // Add your database password here
$DATABASE = 'project';

// Attempt to connect to the database
$conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>
