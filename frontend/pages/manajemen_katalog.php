<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login_admin.php');
    exit();
}

$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'Admin';

// Fetch data from database
require_once '../../backend/config/db.php';
$stmt = $conn->query("SELECT * FROM products ORDER BY id DESC");
$catalog_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_products = count($catalog_items);

// Pending orders count for sidebar badge
try {
    $pending_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'")->fetchColumn();
} catch (PDOException $e) {
    $pending_orders = 0;
}
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Manajemen Katalog</title>
    
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
                <a href="manajemen_katalog.php" class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-colors">
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
                <h1 class="font-headline-md text-lg font-semibold">Manajemen Katalog</h1>
            </div>
            <div class="flex items-center space-x-4">

            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-auto p-6">
            
            <?php if(isset($_GET['success'])): ?>
                <div class="bg-success-container text-on-success-container p-4 rounded-xl mb-4 font-semibold shadow-sm">
                    <?php echo htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['error'])): ?>
                <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-4 font-semibold shadow-sm">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Table Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/20 flex justify-between items-center">
                    <h2 class="font-headline-md text-lg font-semibold text-on-surface">Daftar Produk</h2>
                    <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-label-md font-semibold flex items-center space-x-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        <span>Tambah Produk</span>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container text-secondary text-sm font-label-md border-b border-outline-variant/20">
                                <th class="p-4 font-semibold">ID</th>
                                <th class="p-4 font-semibold w-12">Gambar</th>
                                <th class="p-4 font-semibold">Nama Produk</th>
                                <th class="p-4 font-semibold">Harga</th>
                                <th class="p-4 font-semibold">Stok</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($catalog_items as $item): ?>
                            <tr class="border-b border-outline-variant/10 hover:bg-surface-container/50 transition-colors">
                                <td class="p-4 text-secondary">#<?php echo str_pad($item['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td class="p-4">
                                    <div class="w-10 h-10 rounded overflow-hidden bg-gray-100">
                                        <img src="<?php echo htmlspecialchars($item['img']); ?>" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4 font-semibold text-on-surface"><?php echo htmlspecialchars($item['name']); ?></td>
                                <td class="p-4 text-secondary">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                <td class="p-4 text-secondary"><?php echo $item['stock']; ?></td>
                                <td class="p-4">
                                    <?php 
                                        $statusClass = '';
                                        if ($item['status'] === 'Aktif') $statusClass = 'bg-success-container text-on-success-container';
                                        elseif ($item['status'] === 'Stok Rendah') $statusClass = 'bg-warning-container text-on-warning-container';
                                        else $statusClass = 'bg-error-container text-on-error-container';
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?php echo $statusClass; ?>">
                                        <?php echo $item['status']; ?>
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-1 flex items-center justify-end">
                                    <button onclick='openEditModal(<?php echo json_encode($item); ?>)' class="text-secondary hover:text-primary p-1 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <a href="../../backend/produk/hapus_produk.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')" class="text-secondary hover:text-error p-1 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center hidden backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto shadow-2xl">
            <h2 class="font-headline-md text-xl font-bold mb-4 text-primary">Tambah Produk</h2>
            <form action="../../backend/produk/tambah_produk.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-1">Nama Produk</label>
                    <input type="text" name="name" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Harga (Rp)</label>
                        <input type="number" name="price" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Stok</label>
                        <input type="number" name="stock" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Status</label>
                        <select name="status" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                            <option value="Aktif">Aktif</option>
                            <option value="Stok Rendah">Stok Rendah</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Tag (opsional)</label>
                        <input type="text" name="tag" placeholder="Misal: Premium" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-1">URL Gambar</label>
                    <input type="text" name="img" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary"></textarea>
                </div>
                <div class="flex justify-end space-x-2 pt-4 border-t border-outline-variant/30 mt-4">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 rounded-lg font-semibold text-secondary hover:bg-surface-container">Batal</button>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center hidden backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto shadow-2xl">
            <h2 class="font-headline-md text-xl font-bold mb-4 text-primary">Edit Produk</h2>
            <form action="../../backend/produk/edit_produk.php" method="POST" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-1">Nama Produk</label>
                    <input type="text" name="name" id="edit_name" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Harga (Rp)</label>
                        <input type="number" name="price" id="edit_price" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Stok</label>
                        <input type="number" name="stock" id="edit_stock" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Status</label>
                        <select name="status" id="edit_status" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                            <option value="Aktif">Aktif</option>
                            <option value="Stok Rendah">Stok Rendah</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-secondary mb-1">Tag (opsional)</label>
                        <input type="text" name="tag" id="edit_tag" placeholder="Misal: Premium" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-1">URL Gambar</label>
                    <input type="text" name="img" id="edit_img" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-1">Deskripsi</label>
                    <textarea name="description" id="edit_description" rows="3" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary"></textarea>
                </div>
                <div class="flex justify-end space-x-2 pt-4 border-t border-outline-variant/30 mt-4">
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="px-4 py-2 rounded-lg font-semibold text-secondary hover:bg-surface-container">Batal</button>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-semibold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(item) {
            document.getElementById('edit_id').value = item.id;
            document.getElementById('edit_name').value = item.name;
            document.getElementById('edit_price').value = item.price;
            document.getElementById('edit_stock').value = item.stock;
            document.getElementById('edit_status').value = item.status;
            document.getElementById('edit_tag').value = item.tag;
            document.getElementById('edit_img').value = item.img;
            document.getElementById('edit_description').value = item.description;
            
            document.getElementById('modalEdit').classList.remove('hidden');
        }
    </script>
</body>
</html>
