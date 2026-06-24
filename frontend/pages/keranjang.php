<?php
session_start();
include_once '../includes/navbar.php'; 
?>
<main class="max-w-container-max mx-auto px-md py-xxl text-center min-h-[60vh] flex flex-col items-center justify-center">
    <span class="material-symbols-outlined text-[64px] text-outline mb-4">shopping_cart</span>
    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Keranjang Anda Kosong</h2>
    <p class="font-body-md text-secondary mb-6">Sepertinya Anda belum menambahkan bunga apapun.</p>
    <a href="katalog.php" class="bg-primary text-on-primary px-xl py-3 rounded-full font-label-md text-label-md hover:scale-105 active:scale-95 transition-all">
        Mulai Belanja
    </a>
</main>
<?php include_once '../includes/footer.php'; ?>
