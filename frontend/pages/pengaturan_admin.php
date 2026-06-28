<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login_admin.php');
    exit();
}

$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'Admin';

// Fetch data if necessary
require_once '../../backend/config/db.php';
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Pengaturan Admin</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Literata:opsz,wght@7..72,400..700&family=Plus_Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#a43073",
                        "primary-container": "#f472b6",
                        "on-primary": "#ffffff",
                        "on-primary-container": "#6d0047",
                        "secondary": "#635c61",
                        "secondary-container": "#e7dde3",
                        "on-secondary-container": "#686066",
                        "surface": "#f8f9ff",
                        "surface-container": "#e6eeff",
                        "on-surface": "#121c2a",
                        "on-surface-variant": "#544249",
                        "outline": "#87717a",
                        "outline-variant": "#dac0c9",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "success": "#006d30",
                        "success-container": "#95f8a7",
                        "on-success-container": "#00210a",
                        "warning": "#eab308",
                        "warning-container": "#fef08a",
                        "on-warning-container": "#713f12"
                    },
                    "fontFamily": {
                        "headline-md": ["Literata"],
                        "headline-lg": ["Literata"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface font-body-md h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-outline-variant/30 flex flex-col hidden md:flex z-20">
        <div class="h-16 flex items-center px-6 border-b border-outline-variant/30">
            <span class="material-symbols-outlined text-primary mr-2">local_florist</span>
            <span class="font-headline-md font-semibold text-primary">Admin Florashop</span>
        </div>
        
        <div class="p-4 flex-1 overflow-y-auto">
            <p class="text-xs font-label-md text-outline mb-4 uppercase tracking-wider px-4">Menu</p>
            <nav class="space-y-1">
                <a href="dashboard_admin.php" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md font-semibold">Dasbor</span>
                </a>
                <a href="manajemen_katalog.php" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-label-md font-semibold">Manajemen Katalog</span>
                </a>
                <a href="pesanan_admin.php" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="font-label-md font-semibold">Pesanan</span>
                </a>
                <a href="pelanggan_admin.php" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">people</span>
                    <span class="font-label-md font-semibold">Pelanggan</span>
                </a>
                <a href="pengaturan_admin.php" class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-colors">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-label-md font-semibold">Pengaturan</span>
                </a>
            </nav>
        </div>
        
        <div class="p-4 border-t border-outline-variant/30">
            <div class="flex items-center space-x-3 px-4 py-2">
                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">A</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-label-md font-semibold text-on-surface truncate"><?php echo htmlspecialchars($admin_email); ?></p>
                    <p class="text-xs text-secondary truncate">Administrator</p>
                </div>
            </div>
            <a href="../../backend/auth/logout_admin.php" class="mt-4 flex items-center space-x-2 text-error hover:text-error/80 px-4 py-2 transition-colors">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span class="font-label-md font-semibold">Keluar</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-surface-container relative">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-outline-variant/30 flex items-center justify-between px-6 z-10 shadow-sm">
            <div class="flex items-center">
                <button class="md:hidden mr-4 text-secondary hover:text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="font-headline-md text-lg font-semibold">Pengaturan</h1>
            </div>
            <div class="flex items-center space-x-4">

            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-auto p-6">
            
            <div class="mb-8">
                <h2 class="font-headline-md text-2xl font-bold text-primary mb-2">Pengaturan Akun & Sistem</h2>
                <p class="text-secondary font-label-md">Kelola profil admin dan konfigurasi sistem toko Anda.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 p-6 max-w-2xl">
                <h3 class="font-headline-md text-lg font-semibold text-on-surface mb-4">Profil Admin</h3>
                
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-label-md text-secondary mb-1">Email</label>
                        <input type="email" value="<?php echo htmlspecialchars($admin_email); ?>" disabled class="w-full px-4 py-2 rounded-xl border border-outline-variant/40 bg-surface-container/50 text-secondary focus:outline-none">
                        <p class="text-xs text-secondary mt-1">Email digunakan untuk login dan tidak dapat diubah.</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-label-md text-secondary mb-1">Nama Tampilan</label>
                        <input type="text" placeholder="Admin Florashop" class="w-full px-4 py-2 rounded-xl border border-outline-variant/40 focus:ring-primary focus:border-primary">
                    </div>
                    
                    <hr class="border-outline-variant/30 my-6">
                    
                    <h3 class="font-headline-md text-lg font-semibold text-on-surface mb-4">Ubah Kata Sandi</h3>
                    
                    <div>
                        <label class="block text-sm font-label-md text-secondary mb-1">Kata Sandi Lama</label>
                        <input type="password" class="w-full px-4 py-2 rounded-xl border border-outline-variant/40 focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-label-md text-secondary mb-1">Kata Sandi Baru</label>
                        <input type="password" class="w-full px-4 py-2 rounded-xl border border-outline-variant/40 focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div class="pt-4 flex justify-end">
                        <button type="button" class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-xl font-semibold transition-colors shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </main>

</body>
</html>
