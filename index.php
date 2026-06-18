<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: frontend/pages/login.php");
    exit;
}
// Here later will be the home page content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Florashop - Home</title>
</head>
<body>
    <h1>Welcome to Florashop Home!</h1>
    <a href="backend/auth/logout.php">Logout</a>
</body>
</html>
