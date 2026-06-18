<?php
<<<<<<< HEAD
$host = "localhost";
$user = "root";
$pass = "";
$db   = "florashop_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
=======
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
>>>>>>> 8885c56dd68b483b6724449d6273e7e3787a101e
}
?>
