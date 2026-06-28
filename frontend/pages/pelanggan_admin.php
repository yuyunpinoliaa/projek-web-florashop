<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login_admin.php');
    exit();
}

$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'Admin';

require_once '../../backend/config/db.php';

// Search & filter
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch customers (users) from DB
$where_sql = '';
$params    = [];
if (!empty($search_query)) {
    $where_sql = "WHERE u.name LIKE :search OR u.email LIKE :search2";
    $params[':search']  = '%' . $search_query . '%';
    $params[':search2'] = '%' . $search_query . '%';
}

try {
    $stmt = $conn->prepare("
        SELECT u.id, u.name, u.email, u.created_at,
               COUNT(o.id) AS total_orders,
               COALESCE(SUM(o.total), 0) AS total_spent
        FROM users u
        LEFT JOIN orders o ON o.user_id = u.id
        $where_sql
        GROUP BY u.id, u.name, u.email, u.created_at
        ORDER BY u.created_at DESC
    ");
    $stmt->execute($params);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $customers = [];
    $db_error  = $e->getMessage();
}

// Stats
try {
    $total_customers       = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $new_this_month        = $conn->query("SELECT COUNT(*) FROM users WHERE MONTH(created_at)=MONTH(NOW()) AND YEAR(created_at)=YEAR(NOW())")->fetchColumn();
    $customers_with_orders = $conn->query("SELECT COUNT(DISTINCT user_id) FROM orders WHERE user_id IS NOT NULL")->fetchColumn();
    $pending_orders        = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'")->fetchColumn();
} catch (PDOException $e) {
    $total_customers = $new_this_month = $customers_with_orders = $pending_orders = 0;
}
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Manajemen Pelanggan</title>

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
                        "on-warning-container": "#713f12",
                        "info": "#0284c7",
                        "info-container": "#e0f2fe",
                        "on-info-container": "#075985"
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

    <style>
        .stat-card { @apply bg-white p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4 transition-all hover:shadow-md hover:-translate-y-0.5; }
        .customer-row { @apply border-b border-outline-variant/10 hover:bg-surface-container/30 transition-colors; }
        .modal-backdrop { transition: opacity 0.2s ease; }
        .modal-content  { transition: transform 0.2s ease, opacity 0.2s ease; }
        .modal-backdrop.show { opacity: 1; }
        .modal-backdrop:not(.show) { opacity: 0; pointer-events: none; }
        .modal-backdrop.show .modal-content { transform: scale(1); opacity: 1; }
        .modal-backdrop:not(.show) .modal-content { transform: scale(0.95); opacity: 0; }
    </style>
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
                    <?php if ($pending_orders > 0): ?>
                    <span class="ml-auto bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded-full"><?php echo $pending_orders; ?></span>
                    <?php endif; ?>
                </a>
                <a href="pelanggan_admin.php" class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-colors">
                    <span class="material-symbols-outlined">people</span>
                    <span class="font-label-md font-semibold">Pelanggan</span>
                </a>
                <a href="pengaturan_admin.php" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
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
                <h1 class="font-headline-md text-lg font-semibold">Manajemen Pelanggan</h1>
            </div>
            <div class="flex items-center space-x-4">
                <form method="GET" class="hidden sm:flex items-center">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[20px]">search</span>
                        <input type="text" name="search" placeholder="Cari pelanggan..."
                               value="<?php echo htmlspecialchars($search_query); ?>"
                               class="pl-10 pr-4 py-2 rounded-full border border-outline-variant/40 text-sm focus:ring-primary focus:border-primary bg-surface-container/50 w-56">
                    </div>
                </form>

            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-auto p-6">

            <?php if (!empty($db_error)): ?>
            <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-4 font-semibold shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">error</span>
                Kesalahan Database: <?php echo htmlspecialchars($db_error); ?>
            </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">group</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Total Pelanggan</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $total_customers; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-success/10 text-success flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Baru Bulan Ini</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $new_this_month; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-info/10 text-info flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Sudah Pernah Beli</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $customers_with_orders; ?></p>
                    </div>
                </div>
            </div>

            <!-- Customers Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/20 flex justify-between items-center">
                    <h2 class="font-headline-md text-lg font-semibold text-on-surface">
                        Daftar Pelanggan
                        <?php if (!empty($search_query)): ?>
                        <span class="text-sm font-normal text-secondary ml-2">— hasil pencarian "<?php echo htmlspecialchars($search_query); ?>"</span>
                        <?php endif; ?>
                    </h2>
                    <span class="text-sm text-secondary font-label-md"><?php echo count($customers); ?> pelanggan</span>
                </div>

                <?php if (empty($customers)): ?>
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <span class="material-symbols-outlined text-[64px] text-outline-variant/50 mb-4">person_search</span>
                    <h3 class="text-lg font-semibold text-secondary mb-1">
                        <?php echo !empty($search_query) ? 'Pelanggan tidak ditemukan' : 'Belum ada pelanggan'; ?>
                    </h3>
                    <p class="text-sm text-outline">
                        <?php echo !empty($search_query) ? 'Coba kata kunci lain.' : 'Pelanggan yang sudah mendaftar akan muncul di sini.'; ?>
                    </p>
                </div>
                <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container text-secondary text-xs font-label-md border-b border-outline-variant/20 uppercase tracking-wider">
                                <th class="p-4 font-semibold">ID</th>
                                <th class="p-4 font-semibold">Pelanggan</th>
                                <th class="p-4 font-semibold">Email</th>
                                <th class="p-4 font-semibold">Total Pesanan</th>
                                <th class="p-4 font-semibold">Total Belanja</th>
                                <th class="p-4 font-semibold">Tanggal Daftar</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($customers as $customer): ?>
                            <tr class="customer-row">
                                <td class="p-4">
                                    <span class="text-secondary font-mono">#<?php echo str_pad($customer['id'], 4, '0', STR_PAD_LEFT); ?></span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm flex-shrink-0">
                                            <?php echo strtoupper(mb_substr($customer['name'], 0, 1)); ?>
                                        </div>
                                        <span class="font-semibold text-on-surface"><?php echo htmlspecialchars($customer['name']); ?></span>
                                    </div>
                                </td>
                                <td class="p-4 text-secondary"><?php echo htmlspecialchars($customer['email']); ?></td>
                                <td class="p-4">
                                    <?php if ($customer['total_orders'] > 0): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-info-container text-on-info-container">
                                        <span class="material-symbols-outlined text-[13px]">shopping_bag</span>
                                        <?php echo $customer['total_orders']; ?> pesanan
                                    </span>
                                    <?php else: ?>
                                    <span class="text-secondary text-xs">Belum ada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <?php if ($customer['total_spent'] > 0): ?>
                                    <span class="font-semibold text-success">Rp <?php echo number_format($customer['total_spent'], 0, ',', '.'); ?></span>
                                    <?php else: ?>
                                    <span class="text-secondary text-xs">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-secondary">
                                    <?php
                                    $date = new DateTime($customer['created_at']);
                                    echo $date->format('d M Y');
                                    ?>
                                    <br>
                                    <span class="text-xs"><?php echo $date->format('H:i'); ?> WIB</span>
                                </td>
                                <td class="p-4 text-right">
                                    <button onclick='openCustomerModal(<?php echo json_encode($customer); ?>)'
                                            class="text-secondary hover:text-primary p-1.5 rounded-lg hover:bg-primary/5 transition-colors" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <!-- Modal Detail Pelanggan -->
    <div id="modalCustomer" class="modal-backdrop fixed inset-0 bg-black/50 z-50 flex justify-center items-center backdrop-blur-sm" style="opacity:0;pointer-events:none;">
        <div class="modal-content bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl mx-4">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-headline-md text-xl font-bold text-primary">Detail Pelanggan</h2>
                <button onclick="closeCustomerModal()" class="p-1 text-secondary hover:text-error rounded-full hover:bg-error/5 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div id="customerModalContent" class="space-y-4">
                <!-- Filled dynamically -->
            </div>
        </div>
    </div>

    <script>
        function openCustomerModal(customer) {
            const modal   = document.getElementById('modalCustomer');
            const content = document.getElementById('customerModalContent');

            function formatRp(n) {
                return 'Rp ' + parseInt(n).toLocaleString('id-ID');
            }
            function formatDate(d) {
                const date = new Date(d);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            }

            const initial = (customer.name || '?').charAt(0).toUpperCase();

            content.innerHTML = `
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-2xl flex-shrink-0">
                        ${initial}
                    </div>
                    <div>
                        <p class="font-bold text-lg text-on-surface">${customer.name}</p>
                        <p class="text-sm text-secondary">${customer.email}</p>
                    </div>
                </div>

                <div class="bg-surface-container/50 p-4 rounded-xl space-y-3 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px]">badge</span>
                        <span class="text-secondary">ID Pelanggan:</span>
                        <span class="font-semibold">#${String(customer.id).padStart(4, '0')}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px]">calendar_today</span>
                        <span class="text-secondary">Terdaftar sejak:</span>
                        <span class="font-semibold">${formatDate(customer.created_at)}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-info-container/50 rounded-xl p-4 text-center">
                        <p class="text-2xl font-bold text-on-info-container">${customer.total_orders}</p>
                        <p class="text-xs text-on-info-container/70 mt-1">Total Pesanan</p>
                    </div>
                    <div class="bg-success-container/50 rounded-xl p-4 text-center">
                        <p class="text-sm font-bold text-on-success-container">${parseInt(customer.total_spent) > 0 ? formatRp(customer.total_spent) : '-'}</p>
                        <p class="text-xs text-on-success-container/70 mt-1">Total Belanja</p>
                    </div>
                </div>
            `;

            modal.style.opacity = '1';
            modal.style.pointerEvents = 'auto';
            modal.classList.add('show');
        }

        function closeCustomerModal() {
            const modal = document.getElementById('modalCustomer');
            modal.classList.remove('show');
            modal.style.opacity = '0';
            modal.style.pointerEvents = 'none';
        }

        document.getElementById('modalCustomer').addEventListener('click', function(e) {
            if (e.target === this) closeCustomerModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeCustomerModal();
        });
    </script>
</body>
</html>
