<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login_admin.php');
    exit();
}

$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'Admin';

// Fetch data from database for stats
require_once '../../backend/config/db.php';
$stmt = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 5");
$recent_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_products = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();

// Order stats
try {
    $total_active_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE status IN ('Menunggu','Diproses','Dikirim')")->fetchColumn();
    $pending_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'")->fetchColumn();
    $today_revenue_raw = $conn->query("SELECT COALESCE(SUM(total),0) FROM orders WHERE status = 'Selesai' AND DATE(created_at) = CURDATE()")->fetchColumn();
    $today_revenue = floatval($today_revenue_raw);
} catch (PDOException $e) {
    $total_active_orders = 0;
    $pending_orders = 0;
    $today_revenue = 0;
}
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Dasbor Admin</title>
    
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
                <a href="dashboard_admin.php" class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-colors">
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
                    <?php if ($pending_orders > 0): ?>
                    <span class="ml-auto bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded-full"><?php echo $pending_orders; ?></span>
                    <?php endif; ?>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">people</span>
                    <span class="font-label-md font-semibold">Pelanggan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
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
                <h1 class="font-headline-md text-lg font-semibold">Ringkasan Dasbor</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-secondary hover:bg-surface-container rounded-full transition-colors relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-error rounded-full"></span>
                </button>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-auto p-6">
            
            <div class="mb-8">
                <h2 class="font-headline-md text-2xl font-bold text-primary mb-2">Selamat Datang, Admin!</h2>
                <p class="text-secondary font-label-md">Berikut adalah ringkasan singkat dari aktivitas toko Florashop.</p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined">inventory_2</span>
                    </div>
                    <div>
                        <p class="text-sm text-secondary font-label-md">Total Produk</p>
                        <p class="text-2xl font-headline-md font-bold text-on-surface"><?php echo $total_products; ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-success/10 text-success flex items-center justify-center">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </div>
                    <div>
                        <p class="text-sm text-secondary font-label-md">Pesanan Aktif</p>
                        <p class="text-2xl font-headline-md font-bold text-on-surface"><?php echo $total_active_orders; ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-warning/10 text-warning flex items-center justify-center">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <div>
                        <p class="text-sm text-secondary font-label-md">Pendapatan (Hari Ini)</p>
                        <p class="text-2xl font-headline-md font-bold text-on-surface">Rp <?php echo number_format($today_revenue, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Quick Access / Recent Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-headline-md text-lg font-semibold text-on-surface">Produk Terbaru Ditambahkan</h3>
                    <a href="manajemen_katalog.php" class="text-primary font-label-md font-semibold hover:underline">Kelola Katalog →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <?php foreach($recent_products as $rp): ?>
                    <div class="border border-outline-variant/30 rounded-xl p-3 flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full overflow-hidden mb-2 bg-surface-container">
                            <img src="<?php echo htmlspecialchars($rp['img']); ?>" class="w-full h-full object-cover">
                        </div>
                        <p class="font-label-md font-semibold text-sm truncate w-full text-on-surface"><?php echo htmlspecialchars($rp['name']); ?></p>
                        <p class="text-xs text-secondary">Rp <?php echo number_format($rp['price'], 0, ',', '.'); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
