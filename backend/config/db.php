<?php
session_start();

$host = 'localhost';
$dbname = 'florashop'; // Ensure this database exists
$username = 'root'; // Change if different
$password = ''; // Change if different

try 
    die("Connection failed: " . $e->getMessage());
}
?>
