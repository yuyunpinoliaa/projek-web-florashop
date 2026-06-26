<?php 
session_start();
include_once '../includes/navbar.php'; 

require_once '../../backend/config/db.php';
$stmt = $conn->query("SELECT * FROM products WHERE status != 'Habis' ORDER BY id DESC LIMIT 4");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="max-w-container-max mx-auto pb-xxl animate-fade-in">
    <section class="px-md mt-md">
        <div class="relative overflow-hidden rounded-xl bg-primary-container/10 aspect-[16/9] md:aspect-[21/9] flex items-center">
            <img alt="Special Bouquet" class="absolute inset-0 w-full h-full object-cover mix-blend-multiply opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHcu9O2__0chVKJTiV2nFzo6jQ1CDlCPwg5HBCD_qT9GfaZK93W5r1X53YVG_k1H2EB4t1Fu9A-ULgsZfWhY_yCeUWP1eBMtfme46DX7NHl0csysM5BpVj5msi_6x_4NK0a4tkCxo-D61GRcJPsfQP4yMUYl1NdRXNVU8Ji253A6MyhkyOdVlwXh1xeft6lohijXnj8DQQ72rkOKNBQMOUS7tCrKIXDchXfm4bEBLjjlqvmvRa_inIEfbXFHp07mv1vuCJTPhSIRc"/>
            <div class="relative z-10 px-lg md:px-xl py-lg max-w-lg">
                <span class="font-label-md text-label-md text-on-primary-container bg-primary-fixed/50 px-3 py-1 rounded-full mb-4 inline-block">EDISI TERBATAS</span>
                <h2 class="font-display-lg text-display-lg text-on-primary-container mb-4">Inspirasi Pagi</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-6">Rasakan kesegaran bunga musim ini yang dipetik langsung dan diantar ke pintu Anda.</p>
                <a href="katalog.php" class="inline-block bg-primary text-on-primary font-label-md text-label-md px-xl py-md rounded-full shadow-lg hover:shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                    Beli Buket Spesial
                </a>
            </div>
        </div>
    </section>

    <section class="mt-xl px-md">
        <div class="flex justify-between items-center mb-lg">
            <h3 class="font-headline-md text-headline-md text-on-surface">Featured Products</h3>
            <div class="flex gap-2">
                <button class="material-symbols-outlined p-2 border border-outline-variant/30 rounded-full text-secondary hover:bg-primary/5" data-icon="chevron_left">chevron_left</button>
                <button class="material-symbols-outlined p-2 border border-outline-variant/30 rounded-full text-secondary hover:bg-primary/5" data-icon="chevron_right">chevron_right</button>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-md md:gap-lg">
            <?php foreach ($products as $product): ?>
                <div class="bg-surface group cursor-pointer relative" onclick="window.location.href='detail_produk.php?name=<?php echo urlencode($product['name']); ?>'">
                    <div class="aspect-square rounded-xl overflow-hidden mb-md shadow-[0px_4px_20px_rgba(244,114,182,0.08)] group-hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)] transition-all">
                        <img alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo $product['img']; ?>"/>
                        <button class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all scale-0 group-hover:scale-100 duration-300">
                            <span class="material-symbols-outlined text-[20px]" data-icon="favorite">favorite</span>
                        </button>
                    </div>
                    <h4 class="font-headline-md text-[18px] text-on-surface mb-1"><?php echo htmlspecialchars($product['name']); ?></h4>
                    <p class="font-body-lg text-tertiary">Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php 
include_once '../includes/footer.php'; 
?>