<?php
session_start();

// Data Master Produk (Nama Indonesia & Harga Rupiah)
$all_products = [
    [
        'name' => 'Buket Mawar Merah Segar',
        'price' => 185000,
        'desc' => 'Rangkaian mawar merah asli yang fresh dan wangi, dipetik langsung',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5NnuNUAoGLVTQmVc3h-aK-lR05EllNdOAcWorexgwMRnjtZfLrSD8VUCA807bhBii_NyrJ4Sh7WgXFWW9vUtTkZQOiY2rBk4PlnrVM9GbSq1eHEZBnsMHNUOMhUoEEr1Dwrb_tpUahodD4uasyUPlWku6gtNtrm8AqS8BzuhpD8NTx67vzITqqsXKQNGDXgtVNtPHucKq2OwkqehLsPNdTRGnMKGA1zOBTmyENGB2hAt4PDhX3BDNcUtx6Cb-TyYi3cWKF6x9uHM',
        'tag' => 'Premium'
    ],
    [
        'name' => 'Buket Satin Rose Elegant',
        'price' => 65000,
        'desc' => 'Buket bunga mawar dari kain satin kerajinan tangan awet selamanya',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM',
        'tag' => 'Best Seller'
    ],
    [
        'name' => 'Buket Fresh Sunflower',
        'price' => 135000,
        'desc' => 'Bunga matahari asli berukuran besar dikombinasikan dengan baby breath',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTOTQK0qUlxJogYOHu_crSwfBQ_j7LP-CiTs26N81y3T_ZJtRQpUNalI4Ghcc3rIswmEDVeuWRHyaSOyQQcc31wfiTBmI3RiK8C-rdG3cH_mwKID4IYU_jkG5poRcAh5D0uLIQ7QPXPo-0TRMlO52eeoJbxTAcRe6P9osxqQlykTjPMZW7zwNXsRlbbDYNyYK_xIy9fjAH5YNnctEfL-AEFGsgTppWIvL7M3Nd-UTpMnJWvv0UosCRKYqJQrKOr5AP6O-0ArroOV8',
        'tag' => ''
    ],
    [
        'name' => 'Buket Uang Money Bloom',
        'price' => 150000,
        'desc' => 'Buket uang kertas kosong/asli rangkai rapi untuk kado wisuda mewah',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo',
        'tag' => 'Populer'
    ],
    [
        'name' => 'Buket Artificial Daisy Lily',
        'price' => 75000,
        'desc' => 'Buket kombinasi bunga palsu tiruan berbahan plastik & kain premium',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDS4bVXbZMRUnDeOD5vC4NiFEhT0R-UKhUW2HeBDeFhGuwI4XEh-vCmHx5Oy6c7BV_n0vSzGy-qaWooLrYy9ggXf_OaM665tC8kueeixh-MrJ4MTXDyXbvfBSAK59lrvvvYd01dGD06dk0-0wLbRilOopkSB5DRA8GROmFTmJ0HThtE6OYCswKtr962fyRuGbt0h-Y0e_b45UsZ-_7_AX0Drl3dJHF0MO_aDpFaLL8w8JZPBij4wPVphCI8bRsE3Ck3L3qOlHK1-LM',
        'tag' => ''
    ],
    [
        'name' => 'Buket Satin Lavender Soft',
        'price' => 55000,
        'desc' => 'Rangkaian bunga satin warna ungu lavender cantik nan estetik',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwSQvb6GE4xX9iuJHE7BMcVJMHJS7A1OqgqNjXBvD581t_DbFMiOo8Xirdg-jM6gtO_Km1bAa6DQJsPbdoCtT7rtYnrWIfK7_GlZuXlFEWV6pHdl_aZ2u9_mpVN6ngEkPDdSSMcWvbTQ1WDC36BkwxbuEP7C-tOZwSET7KGIh2HCYqf8Xz0GKkQ6fuP7FjOuE5948ablEU3ke2EnieEcmmC75c85HDfOGbJlDOPnMO2our05Xqa5_XKKZgEYDE05_jaHr1ivkKZOE',
        'tag' => ''
    ]
];
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
        <span class="material-symbols-outlined text-primary text-[24px]">notifications</span>
    </div>
</header>

<main class="max-w-[1200px] mx-auto px-md md:px-lg mt-sm md:mt-md">
<div class="py-sm md:py-md">
    <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">Koleksi Pilihan</h2>
    <p class="font-body-md text-body-md text-secondary mt-xs max-w-lg">Temukan bunga sempurna untuk setiap kesempatan, dipilih langsung untuk kesegaran dan keindahan.</p>
</div>

<div class="sticky top-[64px] z-40 bg-surface/80 backdrop-blur-md py-4 -mx-md px-md overflow-x-auto no-scrollbar flex items-center justify-end">
    <div class="flex items-center gap-2 border border-outline-variant/50 rounded-full px-4 py-2 bg-white">
        <span class="font-label-md text-label-md text-secondary">Sort by:</span>
        <select class="bg-transparent border-none focus:ring-0 font-label-md text-label-md text-primary cursor-pointer p-0">
            <option>Recommended</option>
            <option>Price: Low to High</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter mt-lg" id="product-grid">
    <?php foreach ($all_products as $product): ?>
        <div class="group product-card flex flex-col bg-white rounded-xl overflow-hidden shadow-[0px_4px_20px_rgba(244,114,182,0.08)] transition-all hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)]">
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
                <p class="font-body-md text-xs text-secondary truncate"><?php echo htmlspecialchars($product['desc']); ?></p>
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
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="login.php">
        <span class="material-symbols-outlined">person</span>
        <span class="text-[12px] mt-1">Profile</span>
    </a>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Logika Ajax untuk tombol tambah (+) ke keranjang tetap berfungsi sempurna
        const addButtons = document.querySelectorAll('.btn-add-to-cart');
        addButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
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