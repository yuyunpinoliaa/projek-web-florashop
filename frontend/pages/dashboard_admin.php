<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login_admin.php');
    exit();
}

$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'Admin';

// Mock data for catalog
$catalog_items = [
    ['id' => 1, 'name' => 'Buket Mawar Merah Segar', 'price' => 185000, 'stock' => 15, 'status' => 'Active'],
    ['id' => 2, 'name' => 'Buket Satin Rose Elegant', 'price' => 65000, 'stock' => 50, 'status' => 'Active'],
    ['id' => 3, 'name' => 'Buket Fresh Sunflower', 'price' => 135000, 'stock' => 8, 'status' => 'Low Stock'],
    ['id' => 4, 'name' => 'Buket Uang Money Bloom', 'price' => 150000, 'stock' => 20, 'status' => 'Active'],
    ['id' => 5, 'name' => 'Buket Artificial Daisy Lily', 'price' => 75000, 'stock' => 0, 'status' => 'Out of Stock'],
];
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Admin Dashboard</title>
    
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
            <span class="font-headline-md font-semibold text-primary">Florashop Admin</span>
        </div>
        
        <div class="p-4 flex-1 overflow-y-auto">
            <p class="text-xs font-label-md text-outline mb-4 uppercase tracking-wider px-4">Menu</p>
            <nav class="space-y-1">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-colors">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md font-semibold">Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-label-md font-semibold">Catalog Management</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="font-label-md font-semibold">Orders</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">people</span>
                    <span class="font-label-md font-semibold">Customers</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-secondary hover:bg-surface-container rounded-xl transition-colors">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-label-md font-semibold">Settings</span>
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
                <span class="font-label-md font-semibold">Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-surface-container">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-outline-variant/30 flex items-center justify-between px-6 z-10 shadow-sm">
            <div class="flex items-center">
                <button class="md:hidden mr-4 text-secondary hover:text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="font-headline-md text-lg font-semibold">Catalog Overview</h1>
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
            
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined">inventory_2</span>
                    </div>
                    <div>
                        <p class="text-sm text-secondary font-label-md">Total Products</p>
                        <p class="text-2xl font-headline-md font-bold text-on-surface">24</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-success/10 text-success flex items-center justify-center">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </div>
                    <div>
                        <p class="text-sm text-secondary font-label-md">Active Orders</p>
                        <p class="text-2xl font-headline-md font-bold text-on-surface">12</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-warning/10 text-warning flex items-center justify-center">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <div>
                        <p class="text-sm text-secondary font-label-md">Revenue (Today)</p>
                        <p class="text-2xl font-headline-md font-bold text-on-surface">Rp 1.45M</p>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/20 flex justify-between items-center">
                    <h2 class="font-headline-md text-lg font-semibold text-on-surface">Product Catalog</h2>
                    <button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-label-md font-semibold flex items-center space-x-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        <span>Add Product</span>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container text-secondary text-sm font-label-md border-b border-outline-variant/20">
                                <th class="p-4 font-semibold">ID</th>
                                <th class="p-4 font-semibold">Product Name</th>
                                <th class="p-4 font-semibold">Price</th>
                                <th class="p-4 font-semibold">Stock</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($catalog_items as $item): ?>
                            <tr class="border-b border-outline-variant/10 hover:bg-surface-container/50 transition-colors">
                                <td class="p-4 text-secondary">#<?php echo str_pad($item['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td class="p-4 font-semibold text-on-surface"><?php echo htmlspecialchars($item['name']); ?></td>
                                <td class="p-4 text-secondary">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                <td class="p-4 text-secondary"><?php echo $item['stock']; ?></td>
                                <td class="p-4">
                                    <?php 
                                        $statusClass = '';
                                        if ($item['status'] === 'Active') $statusClass = 'bg-success-container text-on-success-container';
                                        elseif ($item['status'] === 'Low Stock') $statusClass = 'bg-warning-container text-on-warning-container';
                                        else $statusClass = 'bg-error-container text-on-error-container';
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?php echo $statusClass; ?>">
                                        <?php echo $item['status']; ?>
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <button class="text-secondary hover:text-primary p-1 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button class="text-secondary hover:text-error p-1 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-outline-variant/20 flex justify-between items-center text-sm text-secondary">
                    <span>Showing 1 to 5 of 24 products</span>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-outline-variant/50 rounded-md hover:bg-surface-container transition-colors disabled:opacity-50" disabled>Previous</button>
                        <button class="px-3 py-1 border border-outline-variant/50 rounded-md bg-primary text-white">1</button>
                        <button class="px-3 py-1 border border-outline-variant/50 rounded-md hover:bg-surface-container transition-colors">2</button>
                        <button class="px-3 py-1 border border-outline-variant/50 rounded-md hover:bg-surface-container transition-colors">3</button>
                        <button class="px-3 py-1 border border-outline-variant/50 rounded-md hover:bg-surface-container transition-colors">Next</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
