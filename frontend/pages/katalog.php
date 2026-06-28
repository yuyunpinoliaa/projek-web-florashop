<?php
session_start();

require_once '../../backend/config/db.php';
$stmt = $conn->query("SELECT * FROM products WHERE status != 'Habis' ORDER BY id DESC");
$all_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$unread_count = 0;
$my_orders = isset($_SESSION['my_orders']) ? $_SESSION['my_orders'] : [];

if (isset($_SESSION['user_id']) || !empty($my_orders)) {
    try {
        if (isset($_SESSION['user_id']) && !empty($my_orders)) {
            $in_query = implode(',', array_fill(0, count($my_orders), '?'));
            $unread_stmt = $conn->prepare("SELECT COUNT(*) FROM notifications WHERE (user_id = ? OR order_id IN ($in_query)) AND is_read = 0");
            $params = array_merge([$_SESSION['user_id']], $my_orders);
            $unread_stmt->execute($params);
            $unread_count = $unread_stmt->fetchColumn();
        } elseif (isset($_SESSION['user_id'])) {
            $unread_stmt = $conn->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
            $unread_stmt->execute([$_SESSION['user_id']]);
            $unread_count = $unread_stmt->fetchColumn();
        } else {
            $in_query = implode(',', array_fill(0, count($my_orders), '?'));
            $unread_stmt = $conn->prepare("SELECT COUNT(*) FROM notifications WHERE order_id IN ($in_query) AND is_read = 0");
            $unread_stmt->execute($my_orders);
            $unread_count = $unread_stmt->fetchColumn();
        }
    } catch (PDOException $e) {
        $unread_count = 0;
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Catalog</title>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="../assets/css/katalog.css">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#a43073",
                        "on-primary": "#ffffff",
                        "secondary-container": "#e7dde3",
                        "on-secondary-container": "#686066",
                        "primary-container": "#f472b6",
                        "on-primary-container": "#6d0047",
                        "tertiary": "#006d30",
                        "surface": "#f8f9ff",
                        "on-surface": "#121c2a",
                        "secondary": "#635c61",
                        "outline-variant": "#dac0c9"
                    },
                    "fontFamily": {
                        "headline-md": ["Literata"],
                        "headline-lg": ["Literata"],
                        "headline-lg-mobile": ["Literata"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    "spacing": {
                        "lg": "24px", "md": "16px", "gutter": "24px", "sm": "8px", "xs": "4px"
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f8f9ff] min-h-screen pb-32">
<header class="bg-surface/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-md py-sm transition-colors">
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-[24px]">search</span>
    </div>
    <h1 class="font-headline-lg-mobile text-headline-lg-mobile text-primary">Florashop</h1>
    <div class="flex items-center gap-2">
        <a href="notifikasi.php" class="relative text-primary hover:bg-primary/5 p-1 rounded-full active:scale-95 duration-200 flex items-center justify-center" title="Notifications" style="text-decoration: none;">
            <span class="material-symbols-outlined text-[24px]">notifications</span>
            <?php if ($unread_count > 0): ?>
                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full ring-2 ring-[#f8f9ff] animate-pulse"></span>
            <?php endif; ?>
        </a>
        <?php if(isset($_SESSION['user_id'])): ?>
        <a href="profile.php" class="material-symbols-outlined text-primary text-[24px] hover:opacity-80 transition-opacity" title="Profile">person</a>
        <?php else: ?>
        <a href="login.php" class="material-symbols-outlined text-primary text-[24px] hover:opacity-80 transition-opacity" title="Login">person</a>
        <?php endif; ?>
    </div>
</header>

<main class="max-w-[1200px] mx-auto px-md md:px-lg mt-sm md:mt-md">
<div class="py-sm md:py-md">
    <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">Koleksi Pilihan</h2>
    <p class="font-body-md text-body-md text-secondary mt-xs max-w-lg">Temukan bunga sempurna untuk setiap kesempatan, dipilih langsung untuk kesegaran dan keindahan.</p>
</div>



<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter mt-lg" id="product-grid">
    <?php foreach ($all_products as $product): ?>
        <div class="group product-card flex flex-col bg-white rounded-xl overflow-hidden shadow-[0px_4px_20px_rgba(244,114,182,0.08)] transition-all hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)] cursor-pointer" onclick="window.location.href='detail_produk.php?name=<?php echo urlencode($product['name']); ?>'">
            <div class="relative aspect-square overflow-hidden bg-gray-50">
                <img class="product-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo $product['img']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"/>
                <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 backdrop-blur-md text-secondary hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px]">favorite</span>
                </button>
                <?php if (!empty($product['tag'])): ?>
                    <div class="absolute bottom-3 left-3">
                        <span class="bg-primary-container/90 text-on-primary-container px-3 py-1 rounded-full font-label-sm text-[12px] backdrop-blur-sm"><?php echo $product['tag']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="p-4 flex flex-col gap-1">
                <h3 class="font-headline-md text-base text-on-surface group-hover:text-primary transition-colors truncate"><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="font-body-md text-xs text-secondary truncate"><?php echo htmlspecialchars($product['description']); ?></p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="font-body-lg text-tertiary font-semibold">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                    <button class="btn-add-to-cart h-8 w-8 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all active:scale-90"
                            data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                            data-price="<?php echo $product['price']; ?>" 
                            data-img="<?php echo $product['img']; ?>">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</main>

<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-surface/80 backdrop-blur-md border-t border-outline-variant/30 rounded-t-xl">
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="home.php">
        <span class="material-symbols-outlined">home</span>
        <span class="text-[12px] mt-1">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center bg-primary-container/20 text-primary rounded-full px-4 py-1" href="katalog.php">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_florist</span>
        <span class="text-[12px] mt-1">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="keranjang.php">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="text-[12px] mt-1">Cart</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="login_admin.php">
        <span class="material-symbols-outlined">admin_panel_settings</span>
        <span class="text-[12px] mt-1">Admin</span>
    </a>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Logika Ajax untuk tombol tambah (+) ke keranjang tetap berfungsi sempurna
        const addButtons = document.querySelectorAll('.btn-add-to-cart');
        addButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const productData = {
                    name: button.getAttribute('data-name'),
                    price: parseInt(button.getAttribute('data-price')),
                    img: button.getAttribute('data-img')
                };

                fetch('../../backend/keranjang/tambah_keranjang.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(productData)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        alert(result.message);
                    } else {
                        alert('Gagal: ' + result.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
</body>
</html>