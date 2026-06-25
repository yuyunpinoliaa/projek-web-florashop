<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../../backend/config/db.php';
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Profile</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/katalog.css">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#a43073",
                        "on-primary": "#ffffff",
                        "primary-container": "#f472b6",
                        "surface": "#f8f9ff",
                        "on-surface": "#121c2a",
                        "secondary": "#635c61",
                        "outline-variant": "#dac0c9"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Literata"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface font-body-md min-h-screen pb-32">
<header class="bg-surface/80 backdrop-blur-md sticky top-0 z-50 flex justify-center items-center w-full px-4 py-4 shadow-sm">
    <h1 class="font-headline-lg-mobile text-[24px] text-primary">My Profile</h1>
</header>
<main class="max-w-[800px] mx-auto px-4 mt-8">
    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-6 flex flex-col items-center">
        <div class="w-24 h-24 bg-primary-container/20 rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-primary text-[48px]">person</span>
        </div>
        <h2 class="text-[24px] font-semibold text-primary"><?= htmlspecialchars($user['name'] ?? '') ?></h2>
        <p class="text-secondary mt-1"><?= htmlspecialchars($user['email'] ?? '') ?></p>
        <p class="text-secondary mt-1 capitalize">Role: <?= htmlspecialchars($user['role'] ?? 'User') ?></p>
        
        <div class="mt-8 w-full max-w-sm">
            <a href="../../backend/auth/logout.php" class="block w-full text-center py-3 rounded-full bg-red-50 text-red-600 font-label-md hover:bg-red-100 transition-colors border border-red-200">
                Sign Out
            </a>
        </div>
    </div>
</main>
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-surface/80 backdrop-blur-md border-t border-outline-variant/30 shadow-[0px_-4px_20px_rgba(244,114,182,0.08)] rounded-t-xl">
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all" href="home.php">
        <span class="material-symbols-outlined">home</span>
        <span class="font-label-md text-label-md mt-1">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all" href="katalog.php">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">local_florist</span>
        <span class="font-label-md text-label-md mt-1">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all" href="keranjang.php">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="font-label-md text-label-md mt-1">Cart</span>
    </a>
    <a class="flex flex-col items-center justify-center bg-primary-container/20 text-primary rounded-full px-4 py-1" href="profile.php">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person</span>
        <span class="font-label-md text-label-md mt-1">Profile</span>
    </a>
</nav>
</body>
</html>
