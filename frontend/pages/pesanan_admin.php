<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login_admin.php');
    exit();
}

$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'Admin';

// Fetch orders from database
require_once '../../backend/config/db.php';

// Filter by status if provided
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$search_query  = isset($_GET['search']) ? trim($_GET['search']) : '';

$where_clauses = [];
$params = [];

if (!empty($status_filter) && in_array($status_filter, ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'])) {
    $where_clauses[] = "o.status = :status";
    $params[':status'] = $status_filter;
}

if (!empty($search_query)) {
    $where_clauses[] = "(o.customer_name LIKE :search OR o.id LIKE :search_id)";
    $params[':search'] = '%' . $search_query . '%';
    $params[':search_id'] = '%' . $search_query . '%';
}

$where_sql = '';
if (!empty($where_clauses)) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

try {
    $stmt = $conn->prepare("SELECT o.* FROM orders o $where_sql ORDER BY o.created_at DESC");
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $orders = [];
    $db_error = $e->getMessage();
}

// Fetch order items for each order
$order_items_map = [];
try {
    $items_stmt = $conn->query("SELECT * FROM order_items ORDER BY id ASC");
    $all_items = $items_stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($all_items as $item) {
        $order_items_map[$item['order_id']][] = $item;
    }
} catch (PDOException $e) {
    // Silently handle - items won't show
}

// Stats
try {
    $total_orders    = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    $pending_orders  = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'")->fetchColumn();
    $process_orders  = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Diproses'")->fetchColumn();
    $complete_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Selesai'")->fetchColumn();
} catch (PDOException $e) {
    $total_orders = $pending_orders = $process_orders = $complete_orders = 0;
}
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Manajemen Pesanan</title>
    
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
        .status-badge { @apply px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1; }
        .stat-card { @apply bg-white p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4 transition-all hover:shadow-md hover:-translate-y-0.5; }
        .filter-btn { @apply px-4 py-2 rounded-full text-sm font-semibold transition-all border; }
        .filter-btn.active { @apply bg-primary text-white border-primary shadow-md; }
        .filter-btn:not(.active) { @apply bg-white text-secondary border-outline-variant/40 hover:border-primary hover:text-primary; }
        .order-row { @apply border-b border-outline-variant/10 hover:bg-surface-container/30 transition-colors; }
        
        /* Modal transition */
        .modal-backdrop { transition: opacity 0.2s ease; }
        .modal-content { transition: transform 0.2s ease, opacity 0.2s ease; }
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
                <a href="pesanan_admin.php" class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-colors">
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
                <button class="md:hidden mr-4 text-secondary hover:text-primary" onclick="toggleMobileSidebar()">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="font-headline-md text-lg font-semibold">Manajemen Pesanan</h1>
            </div>
            <div class="flex items-center space-x-4">
                <form method="GET" class="hidden sm:flex items-center">
                    <?php if (!empty($status_filter)): ?>
                    <input type="hidden" name="status" value="<?php echo htmlspecialchars($status_filter); ?>">
                    <?php endif; ?>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[20px]">search</span>
                        <input type="text" name="search" placeholder="Cari pesanan..." 
                               value="<?php echo htmlspecialchars($search_query); ?>"
                               class="pl-10 pr-4 py-2 rounded-full border border-outline-variant/40 text-sm focus:ring-primary focus:border-primary bg-surface-container/50 w-56">
                    </div>
                </form>
                <button class="p-2 text-secondary hover:bg-surface-container rounded-full transition-colors relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <?php if ($pending_orders > 0): ?>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-error rounded-full"></span>
                    <?php endif; ?>
                </button>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-auto p-6">
            
            <!-- Flash Messages -->
            <?php if(isset($_GET['success'])): ?>
                <div class="bg-success-container text-on-success-container p-4 rounded-xl mb-4 font-semibold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                    <?php echo htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['error'])): ?>
                <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-4 font-semibold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Total Pesanan</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $total_orders; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-warning/10 text-warning flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">hourglass_top</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Menunggu</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $pending_orders; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-info/10 text-info flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">sync</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Diproses</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $process_orders; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="w-10 h-10 rounded-full bg-success/10 text-success flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                    </div>
                    <div>
                        <p class="text-xs text-secondary font-label-md">Selesai</p>
                        <p class="text-xl font-headline-md font-bold text-on-surface"><?php echo $complete_orders; ?></p>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="pesanan_admin.php<?php echo !empty($search_query) ? '?search=' . urlencode($search_query) : ''; ?>" 
                   class="filter-btn <?php echo empty($status_filter) ? 'active' : ''; ?>">Semua</a>
                <?php 
                $statuses = ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
                foreach ($statuses as $s): 
                    $filter_url = 'pesanan_admin.php?status=' . urlencode($s);
                    if (!empty($search_query)) $filter_url .= '&search=' . urlencode($search_query);
                ?>
                <a href="<?php echo $filter_url; ?>" 
                   class="filter-btn <?php echo $status_filter === $s ? 'active' : ''; ?>"><?php echo $s; ?></a>
                <?php endforeach; ?>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/20 flex justify-between items-center">
                    <h2 class="font-headline-md text-lg font-semibold text-on-surface">
                        Daftar Pesanan
                        <?php if (!empty($status_filter)): ?>
                        <span class="text-sm font-normal text-secondary ml-2">— <?php echo htmlspecialchars($status_filter); ?></span>
                        <?php endif; ?>
                    </h2>
                    <span class="text-sm text-secondary font-label-md"><?php echo count($orders); ?> pesanan</span>
                </div>

                <?php if (empty($orders)): ?>
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <span class="material-symbols-outlined text-[64px] text-outline-variant/50 mb-4">inbox</span>
                    <h3 class="text-lg font-semibold text-secondary mb-1">Belum ada pesanan</h3>
                    <p class="text-sm text-outline">Pesanan dari pelanggan akan muncul di sini.</p>
                </div>
                <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container text-secondary text-xs font-label-md border-b border-outline-variant/20 uppercase tracking-wider">
                                <th class="p-4 font-semibold">ID Pesanan</th>
                                <th class="p-4 font-semibold">Pelanggan</th>
                                <th class="p-4 font-semibold">Produk</th>
                                <th class="p-4 font-semibold">Total</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold">Tanggal</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($orders as $order): 
                                $items = isset($order_items_map[$order['id']]) ? $order_items_map[$order['id']] : [];
                                $item_count = count($items);
                                $first_item = $item_count > 0 ? $items[0] : null;
                                
                                // Status styling
                                $statusClass = '';
                                $statusIcon = '';
                                switch ($order['status']) {
                                    case 'Menunggu':
                                        $statusClass = 'bg-warning-container text-on-warning-container';
                                        $statusIcon = 'hourglass_top';
                                        break;
                                    case 'Diproses':
                                        $statusClass = 'bg-info-container text-on-info-container';
                                        $statusIcon = 'sync';
                                        break;
                                    case 'Dikirim':
                                        $statusClass = 'bg-primary/10 text-primary';
                                        $statusIcon = 'local_shipping';
                                        break;
                                    case 'Selesai':
                                        $statusClass = 'bg-success-container text-on-success-container';
                                        $statusIcon = 'check_circle';
                                        break;
                                    case 'Dibatalkan':
                                        $statusClass = 'bg-error-container text-on-error-container';
                                        $statusIcon = 'cancel';
                                        break;
                                }
                            ?>
                            <tr class="order-row">
                                <td class="p-4">
                                    <span class="font-semibold text-primary">#<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></span>
                                </td>
                                <td class="p-4">
                                    <div>
                                        <p class="font-semibold text-on-surface"><?php echo htmlspecialchars($order['customer_name']); ?></p>
                                        <?php if (!empty($order['customer_email'])): ?>
                                        <p class="text-xs text-secondary truncate max-w-[180px]"><?php echo htmlspecialchars($order['customer_email']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <?php if ($first_item): ?>
                                    <div class="flex items-center gap-2">
                                        <?php if (!empty($first_item['product_img'])): ?>
                                        <div class="w-9 h-9 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                            <img src="<?php echo htmlspecialchars($first_item['product_img']); ?>" class="w-full h-full object-cover" alt="">
                                        </div>
                                        <?php endif; ?>
                                        <div class="min-w-0">
                                            <p class="font-medium text-on-surface truncate max-w-[160px]"><?php echo htmlspecialchars($first_item['product_name']); ?></p>
                                            <?php if ($item_count > 1): ?>
                                            <p class="text-xs text-secondary">+<?php echo ($item_count - 1); ?> produk lainnya</p>
                                            <?php else: ?>
                                            <p class="text-xs text-secondary">Qty: <?php echo $first_item['quantity']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <span class="text-secondary text-xs">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <span class="font-semibold text-on-surface">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></span>
                                </td>
                                <td class="p-4">
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <span class="material-symbols-outlined text-[14px]"><?php echo $statusIcon; ?></span>
                                        <?php echo $order['status']; ?>
                                    </span>
                                </td>
                                <td class="p-4 text-secondary">
                                    <?php 
                                    $date = new DateTime($order['created_at']);
                                    echo $date->format('d M Y');
                                    ?>
                                    <br>
                                    <span class="text-xs"><?php echo $date->format('H:i'); ?> WIB</span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openDetailModal(<?php echo json_encode(array_merge($order, ["items" => $items])); ?>)' 
                                                class="text-secondary hover:text-primary p-1.5 rounded-lg hover:bg-primary/5 transition-colors" title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>
                                        <button onclick='openStatusModal(<?php echo $order["id"]; ?>, "<?php echo $order["status"]; ?>")' 
                                                class="text-secondary hover:text-info p-1.5 rounded-lg hover:bg-info/5 transition-colors" title="Ubah Status">
                                            <span class="material-symbols-outlined text-[20px]">edit_note</span>
                                        </button>
                                    </div>
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

    <!-- Modal Detail Pesanan -->
    <div id="modalDetail" class="modal-backdrop fixed inset-0 bg-black/50 z-50 flex justify-center items-center backdrop-blur-sm" style="opacity:0;pointer-events:none;">
        <div class="modal-content bg-white rounded-2xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto shadow-2xl mx-4">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-headline-md text-xl font-bold text-primary">Detail Pesanan</h2>
                <button onclick="closeDetailModal()" class="p-1 text-secondary hover:text-error rounded-full hover:bg-error/5 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <div class="space-y-4" id="detailContent">
                <!-- Filled dynamically -->
            </div>
        </div>
    </div>

    <!-- Modal Ubah Status -->
    <div id="modalStatus" class="modal-backdrop fixed inset-0 bg-black/50 z-50 flex justify-center items-center backdrop-blur-sm" style="opacity:0;pointer-events:none;">
        <div class="modal-content bg-white rounded-2xl w-full max-w-sm p-6 shadow-2xl mx-4">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-headline-md text-lg font-bold text-primary">Ubah Status Pesanan</h2>
                <button onclick="closeStatusModal()" class="p-1 text-secondary hover:text-error rounded-full hover:bg-error/5 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <form action="../../backend/pesanan/update_status.php" method="POST">
                <input type="hidden" name="order_id" id="statusOrderId">
                
                <p class="text-sm text-secondary mb-3">Pesanan: <strong id="statusOrderLabel" class="text-primary"></strong></p>
                
                <div class="space-y-2 mb-6">
                    <?php
                    $status_options = [
                        'Menunggu'   => ['icon' => 'hourglass_top', 'desc' => 'Pesanan baru masuk, belum diproses', 'color' => 'warning'],
                        'Diproses'   => ['icon' => 'sync',          'desc' => 'Sedang disiapkan/dikemas',          'color' => 'info'],
                        'Dikirim'    => ['icon' => 'local_shipping', 'desc' => 'Dalam perjalanan ke pelanggan',     'color' => 'primary'],
                        'Selesai'    => ['icon' => 'check_circle',   'desc' => 'Pesanan sudah diterima',            'color' => 'success'],
                        'Dibatalkan' => ['icon' => 'cancel',         'desc' => 'Pesanan dibatalkan',                'color' => 'error']
                    ];
                    foreach ($status_options as $val => $opt):
                    ?>
                    <label class="flex items-center p-3 rounded-xl border border-outline-variant/30 cursor-pointer hover:bg-<?php echo $opt['color']; ?>/5 transition-colors group">
                        <input type="radio" name="status" value="<?php echo $val; ?>" class="status-radio w-4 h-4 text-primary focus:ring-primary border-outline">
                        <div class="ml-3 flex-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px] text-<?php echo $opt['color']; ?>"><?php echo $opt['icon']; ?></span>
                                <span class="font-semibold text-sm"><?php echo $val; ?></span>
                            </div>
                            <p class="text-xs text-secondary mt-0.5"><?php echo $opt['desc']; ?></p>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
                
                <div class="flex justify-end space-x-2 pt-4 border-t border-outline-variant/30">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 rounded-lg font-semibold text-secondary hover:bg-surface-container transition-colors">Batal</button>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-5 py-2 rounded-lg font-semibold transition-colors shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Detail Modal
        function openDetailModal(order) {
            const modal = document.getElementById('modalDetail');
            const content = document.getElementById('detailContent');
            
            // Format currency
            function formatRp(n) {
                return 'Rp ' + parseInt(n).toLocaleString('id-ID');
            }
            
            // Format date
            function formatDate(d) {
                const date = new Date(d);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            }

            // Status badge
            const statusMap = {
                'Menunggu': 'bg-warning-container text-on-warning-container',
                'Diproses': 'bg-info-container text-on-info-container',
                'Dikirim': 'bg-primary/10 text-primary',
                'Selesai': 'bg-success-container text-on-success-container',
                'Dibatalkan': 'bg-error-container text-on-error-container'
            };

            // Shipping label
            const shippingLabel = order.shipping_option === 'express' ? 'Ekspres Pagi Segar' : 'Pengiriman Standar Butik';
            const paymentLabel = order.payment_method === 'credit_card' ? 'Kartu Kredit' : order.payment_method;
            
            let itemsHtml = '';
            if (order.items && order.items.length > 0) {
                order.items.forEach(function(item) {
                    const imgHtml = item.product_img 
                        ? '<div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0"><img src="' + item.product_img.replace(/"/g, '&quot;') + '" class="w-full h-full object-cover"></div>'
                        : '<div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-gray-400 text-[16px]">image</span></div>';
                    
                    itemsHtml += `
                        <div class="flex items-center gap-3 py-2">
                            ${imgHtml}
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm truncate">${item.product_name}</p>
                                <p class="text-xs text-secondary">${item.quantity}x ${formatRp(item.price)}</p>
                            </div>
                            <p class="font-semibold text-sm text-on-surface">${formatRp(item.price * item.quantity)}</p>
                        </div>
                    `;
                });
            }
            
            content.innerHTML = `
                <div class="flex items-center justify-between">
                    <span class="font-bold text-lg text-primary">#${String(order.id).padStart(4, '0')}</span>
                    <span class="status-badge ${statusMap[order.status] || ''}">${order.status}</span>
                </div>
                
                <div class="bg-surface-container/50 p-4 rounded-xl space-y-2">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px] mt-0.5">person</span>
                        <div>
                            <p class="font-semibold text-sm">${order.customer_name}</p>
                            ${order.customer_email ? '<p class="text-xs text-secondary">' + order.customer_email + '</p>' : ''}
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px] mt-0.5">location_on</span>
                        <p class="text-sm text-secondary">${order.address}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px]">local_shipping</span>
                        <p class="text-sm text-secondary">${shippingLabel}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px]">credit_card</span>
                        <p class="text-sm text-secondary">${paymentLabel}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px]">schedule</span>
                        <p class="text-sm text-secondary">${formatDate(order.created_at)}</p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-sm mb-2 text-on-surface">Produk Dipesan</h4>
                    <div class="divide-y divide-outline-variant/20">
                        ${itemsHtml}
                    </div>
                </div>
                
                <div class="bg-surface-container/50 p-4 rounded-xl space-y-2 text-sm">
                    <div class="flex justify-between text-secondary">
                        <span>Subtotal</span>
                        <span>${formatRp(order.subtotal)}</span>
                    </div>
                    <div class="flex justify-between text-secondary">
                        <span>Pengiriman</span>
                        <span>${parseInt(order.shipping_cost) === 0 ? 'GRATIS' : formatRp(order.shipping_cost)}</span>
                    </div>
                    <div class="flex justify-between text-secondary">
                        <span>Pajak (10%)</span>
                        <span>${formatRp(order.tax)}</span>
                    </div>
                    <div class="flex justify-between font-bold text-on-surface pt-2 border-t border-outline-variant/30 text-base">
                        <span>Total</span>
                        <span class="text-primary">${formatRp(order.total)}</span>
                    </div>
                </div>
            `;
            
            modal.style.opacity = '1';
            modal.style.pointerEvents = 'auto';
            modal.classList.add('show');
        }
        
        function closeDetailModal() {
            const modal = document.getElementById('modalDetail');
            modal.classList.remove('show');
            modal.style.opacity = '0';
            modal.style.pointerEvents = 'none';
        }

        // Status Modal
        function openStatusModal(orderId, currentStatus) {
            const modal = document.getElementById('modalStatus');
            document.getElementById('statusOrderId').value = orderId;
            document.getElementById('statusOrderLabel').textContent = '#' + String(orderId).padStart(4, '0');
            
            // Pre-select current status
            const radios = document.querySelectorAll('.status-radio');
            radios.forEach(function(radio) {
                radio.checked = (radio.value === currentStatus);
            });
            
            modal.style.opacity = '1';
            modal.style.pointerEvents = 'auto';
            modal.classList.add('show');
        }
        
        function closeStatusModal() {
            const modal = document.getElementById('modalStatus');
            modal.classList.remove('show');
            modal.style.opacity = '0';
            modal.style.pointerEvents = 'none';
        }

        // Close modals when clicking outside
        document.getElementById('modalDetail').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
        document.getElementById('modalStatus').addEventListener('click', function(e) {
            if (e.target === this) closeStatusModal();
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
                closeStatusModal();
            }
        });
    </script>
</body>
</html>
