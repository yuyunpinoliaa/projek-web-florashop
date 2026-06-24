<?php
session_start();

$host = 'localhost';
$dbname = 'florashop'; // Ensure this database exists
$username = 'root'; // Change if different
$password = ''; // Change if different

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
