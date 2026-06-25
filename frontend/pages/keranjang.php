<?php
session_start();

// Proses jika ada request hapus barang dari keranjang via URL (Optional)
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['name'])) {
    $target_name = $_GET['name'];
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['name'] === $target_name) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        // Reset susunan index array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: keranjang.php");
    exit;
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#a43073",
                        "on-primary": "#ffffff",
                        "background": "#f8f9ff",
                        "surface": "#ffffff",
                        "secondary": "#635c61",
                        "on-surface": "#121c2a",
                        "tertiary": "#006d30",
                        "outline-variant": "#dac0c9"
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background min-h-screen pb-32 font-['Plus_Jakarta_Sans']">

<header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-6 py-4 border-b border-gray-100">
    <div class="flex items-center gap-2">
        <a href="katalog.php" class="material-symbols-outlined text-primary text-[24px]">arrow_back</a>
    </div>
    <h1 class="text-xl font-bold text-primary mx-auto">Keranjang Belanja</h1>
    <div class="w-6"></div>
</header>

<main class="max-w-[800px] mx-auto px-4 mt-6">
    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <span class="material-symbols-outlined text-[80px] text-gray-300 mb-4">shopping_cart</span>
            <h2 class="text-2xl font-bold text-on-surface mb-2">Keranjang Anda Kosong</h2>
            <p class="text-secondary mb-8 max-w-sm">Sepertinya Anda belum menambahkan bunga apapun ke keranjang.</p>
            <a href="katalog.php" class="bg-primary text-on-primary px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-primary/90 transition-all">
                Mulai Belanja
            </a>
        </div>
    <?php else: ?>
        <form action="checkout.php" method="POST" id="cart-form">
            <div class="flex flex-col gap-4">
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-[0px_4px_20px_rgba(244,114,182,0.04)] border border-gray-100">
                        
                        <input type="checkbox" name="selected_items[]" value="<?php echo $index; ?>" checked
                               class="item-checkbox rounded text-primary focus:ring-primary w-5 h-5 border-outline-variant cursor-pointer"
                               data-price="<?php echo $item['price']; ?>" data-index="<?php echo $index; ?>">
                        
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-50 flex-shrink-0">
                            <img src="<?php echo htmlspecialchars($item['img']); ?>" class="w-full h-full object-cover" alt="Product Image">
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-on-surface text-base truncate"><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p class="text-tertiary font-semibold text-sm mt-1">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                            
                            <div class="flex items-center gap-2 mt-2">
                                <button type="button" class="btn-qty-minus w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 active:bg-gray-100" data-index="<?php echo $index; ?>">-</button>
                                <input type="number" name="quantity[<?php echo $index; ?>]" value="<?php echo $item['quantity']; ?>" min="1" readonly
                                       class="input-qty w-10 text-center border-none p-0 focus:ring-0 font-medium text-on-surface">
                                <button type="button" class="btn-qty-plus w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 active:bg-gray-100" data-index="<?php echo $index; ?>">+</button>
                            </div>
                        </div>

                        <a href="keranjang.php?action=delete&name=<?php echo urlencode($item['name']); ?>" 
                           class="text-gray-400 hover:text-red-500 transition-colors p-1" onclick="return confirm('Hapus produk ini dari keranjang?')">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="fixed bottom-16 left-0 w-full bg-white border-t border-gray-100 p-4 shadow-[0px_-4px_20px_rgba(0,0,0,0.05)] z-40">
                <div class="max-w-[800px] mx-auto flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs text-secondary font-medium">Total Pembayaran</p>
                        <p class="text-xl font-bold text-primary" id="grand-total">Rp 0</p>
                    </div>
                    <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-bold shadow-md hover:bg-primary/90 transition-all">
                        Checkout (<span id="checked-count">0</span>)
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</main>

<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-white/90 backdrop-blur-md border-t border-outline-variant/30 rounded-t-xl shadow-[0px_-4px_20px_rgba(244,114,182,0.08)]">
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all" href="home.php">
        <span class="material-symbols-outlined">home</span>
        <span class="text-xs mt-1">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all" href="katalog.php">
        <span class="material-symbols-outlined">local_florist</span>
        <span class="text-xs mt-1">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center bg-primary-container/20 text-primary rounded-full px-4 py-1" href="keranjang.php">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">shopping_cart</span>
        <span class="text-xs mt-1">Cart</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all" href="login.php">
        <span class="material-symbols-outlined">person</span>
        <span class="text-xs mt-1">Profile</span>
    </a>
</nav>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const grandTotalEl = document.getElementById('grand-total');
    const checkedCountEl = document.getElementById('checked-count');

    function calculateTotal() {
        let total = 0;
        let checkedCount = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseInt(checkbox.getAttribute('data-price'));
                const index = checkbox.getAttribute('data-index');
                const qtyInput = document.querySelector(`.input-qty[name="quantity[${index}]"]`);
                const qty = parseInt(qtyInput.value);

                total += price * qty;
                checkedCount += qty;
            }
        });

        grandTotalEl.textContent = "Rp " + total.toLocaleString('id-ID');
        checkedCountEl.textContent = checkedCount;
    }

    // Aksi tombol tambah kuantitas (+)
    document.querySelectorAll('.btn-qty-plus').forEach(button => {
        button.addEventListener('click', () => {
            const index = button.getAttribute('data-index');
            const qtyInput = document.querySelector(`.input-qty[name="quantity[${index}]"]`);
            qtyInput.value = parseInt(qtyInput.value) + 1;
            calculateTotal();
        });
    });

    // Aksi tombol kurang kuantitas (-)
    document.querySelectorAll('.btn-qty-minus').forEach(button => {
        button.addEventListener('click', () => {
            const index = button.getAttribute('data-index');
            const qtyInput = document.querySelector(`.input-qty[name="quantity[${index}]"]`);
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
                calculateTotal();
            }
        });
    });

    // Perubahan checkbox pelatuk hitung ulang
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotal);
    });

    // Hitung di awal muat halaman
    if(checkboxes.length > 0) {
        calculateTotal();
    }
});
</script>
</body>
</html>