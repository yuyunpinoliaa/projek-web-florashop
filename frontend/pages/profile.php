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
if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}
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
<body class="bg-[#f5f5f5] text-on-surface font-body-md min-h-screen pb-24 overflow-x-hidden">

<!-- Header Section (Like Shopee) -->
<header class="bg-primary text-white w-full relative">
    <div class="flex justify-between items-center p-4">
        <h1 class="font-semibold text-lg">Saya</h1>
        <div class="flex gap-4">
            <span class="material-symbols-outlined text-[24px]">settings</span>
            <span class="material-symbols-outlined text-[24px]">shopping_cart</span>
            <span class="material-symbols-outlined text-[24px]">chat</span>
        </div>
    </div>
    
    <div class="flex items-center gap-4 px-4 pb-6 pt-2">
        <div class="relative">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-primary overflow-hidden border-2 border-white/50 shadow-sm">
                <span class="material-symbols-outlined text-[40px]">person</span>
            </div>
        </div>
        <div class="flex-1">
            <h2 class="font-bold text-[20px] leading-tight text-white"><?= htmlspecialchars($user['name'] ?? '') ?></h2>
            <div class="inline-flex items-center gap-1 bg-white/20 px-2 py-0.5 rounded-full mt-1">
                <span class="material-symbols-outlined text-[14px]">workspace_premium</span>
                <span class="text-[12px] font-medium"><?= htmlspecialchars($user['role'] === 'admin' ? 'Admin' : 'Classic Member') ?></span>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            </div>
        </div>
    </div>
</header>

<main class="max-w-[800px] mx-auto w-full">
    <!-- Pesanan Saya (My Orders) -->
    <section class="bg-white mt-2 px-4 py-3 shadow-sm">
        <div class="flex justify-between items-center border-b border-gray-100 pb-3 mb-3">
            <h3 class="font-semibold text-[15px] text-gray-800">Pesanan Saya</h3>
            <a href="#" class="text-[13px] text-gray-500 flex items-center">
                Lihat Riwayat Pesanan <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            </a>
        </div>
        <div class="flex justify-between items-center px-2">
            <a href="#" class="flex flex-col items-center gap-2 group relative">
                <span class="material-symbols-outlined text-[28px] text-gray-600 group-hover:text-primary transition-colors">account_balance_wallet</span>
                <span class="text-[12px] text-gray-700">Belum Bayar</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-2 group relative">
                <span class="material-symbols-outlined text-[28px] text-gray-600 group-hover:text-primary transition-colors">inventory_2</span>
                <span class="text-[12px] text-gray-700">Dikemas</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-2 group relative">
                <span class="material-symbols-outlined text-[28px] text-gray-600 group-hover:text-primary transition-colors">local_shipping</span>
                <span class="text-[12px] text-gray-700">Dikirim</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-2 group relative">
                <span class="material-symbols-outlined text-[28px] text-gray-600 group-hover:text-primary transition-colors">star_rate</span>
                <span class="text-[12px] text-gray-700">Beri Penilaian</span>
            </a>
        </div>
    </section>

    <!-- Dompet & Layanan (Wallet & Services) -->
    <section class="bg-white mt-2 px-4 py-3 shadow-sm">
        <h3 class="font-semibold text-[15px] text-gray-800 mb-3">Dompet Saya</h3>
        <div class="grid grid-cols-4 gap-2">
            <div class="flex flex-col items-center gap-1 border-r border-gray-100 last:border-0">
                <span class="material-symbols-outlined text-[28px] text-primary">account_balance</span>
                <span class="text-[12px] text-gray-800 font-semibold">FloraPay</span>
                <span class="text-[11px] text-gray-500">Rp0</span>
            </div>
            <div class="flex flex-col items-center gap-1 border-r border-gray-100 last:border-0">
                <span class="material-symbols-outlined text-[28px] text-yellow-500">monetization_on</span>
                <span class="text-[12px] text-gray-800 font-semibold">Koin Flora</span>
                <span class="text-[11px] text-gray-500">0 Koin</span>
            </div>
            <div class="flex flex-col items-center gap-1 border-r border-gray-100 last:border-0">
                <span class="material-symbols-outlined text-[28px] text-green-500">confirmation_number</span>
                <span class="text-[12px] text-gray-800 font-semibold">Voucher Saya</span>
                <span class="text-[11px] text-gray-500">2 Baru</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <span class="material-symbols-outlined text-[28px] text-blue-500">credit_card</span>
                <span class="text-[12px] text-gray-800 font-semibold">FloraLater</span>
                <span class="text-[11px] text-gray-500">Aktifkan</span>
            </div>
        </div>
    </section>

    <!-- Menu List -->
    <section class="bg-white mt-2 shadow-sm flex flex-col">
        <a href="#" class="flex items-center px-4 py-3 border-b border-gray-100 hover:bg-gray-50">
            <span class="material-symbols-outlined text-primary text-[24px] mr-3">favorite</span>
            <span class="flex-1 text-[14px] text-gray-800">Favorit Saya</span>
            <span class="material-symbols-outlined text-gray-400">chevron_right</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 border-b border-gray-100 hover:bg-gray-50">
            <span class="material-symbols-outlined text-blue-500 text-[24px] mr-3">history</span>
            <span class="flex-1 text-[14px] text-gray-800">Terakhir Dilihat</span>
            <span class="material-symbols-outlined text-gray-400">chevron_right</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 border-b border-gray-100 hover:bg-gray-50">
            <span class="material-symbols-outlined text-green-500 text-[24px] mr-3">manage_accounts</span>
            <span class="flex-1 text-[14px] text-gray-800">Pengaturan Akun</span>
            <span class="text-[13px] text-gray-400 mr-1"><?= htmlspecialchars($user['email'] ?? '') ?></span>
            <span class="material-symbols-outlined text-gray-400">chevron_right</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50">
            <span class="material-symbols-outlined text-orange-500 text-[24px] mr-3">help</span>
            <span class="flex-1 text-[14px] text-gray-800">Pusat Bantuan</span>
            <span class="material-symbols-outlined text-gray-400">chevron_right</span>
        </a>
    </section>
    
    <!-- Logout Button -->
    <div class="mt-6 mb-8 px-4">
        <a href="../../backend/auth/logout.php" class="block w-full text-center py-3 rounded-lg bg-white text-gray-800 font-semibold shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors">
            Logout
        </a>
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
