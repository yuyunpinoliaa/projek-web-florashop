<?php
session_start();
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
                        "on-primary-fixed-variant": "#85145a",
                        "secondary-container": "#e7dde3",
                        "surface-container": "#e6eeff",
                        "tertiary-container": "#51b269",
                        "on-primary": "#ffffff",
                        "outline-variant": "#dac0c9",
                        "outline": "#87717a",
                        "on-secondary-fixed-variant": "#4b454a",
                        "inverse-surface": "#27313f",
                        "on-tertiary-fixed-variant": "#005323",
                        "surface-container-low": "#eff4ff",
                        "inverse-on-surface": "#eaf1ff",
                        "on-primary-container": "#6d0047",
                        "secondary-fixed-dim": "#cec4ca",
                        "secondary-fixed": "#eae0e6",
                        "surface": "#f8f9ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-tint": "#a43073",
                        "surface-dim": "#d0dbed",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#004019",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#ffd8e7",
                        "surface-container-high": "#dee9fc",
                        "on-tertiary-fixed": "#00210a",
                        "on-surface": "#121c2a",
                        "primary-fixed-dim": "#ffafd3",
                        "primary": "#a43073",
                        "error": "#ba1a1a",
                        "inverse-primary": "#ffafd3",
                        "background": "#f8f9ff",
                        "on-secondary": "#ffffff",
                        "tertiary": "#006d30",
                        "surface-variant": "#d9e3f6",
                        "on-background": "#121c2a",
                        "secondary": "#635c61",
                        "primary-container": "#f472b6",
                        "on-secondary-fixed": "#1f1a1e",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#544249",
                        "on-primary-fixed": "#3d0026",
                        "on-error-container": "#93000a",
                        "surface-container-highest": "#d9e3f6",
                        "tertiary-fixed-dim": "#79db8d",
                        "on-secondary-container": "#686066",
                        "surface-bright": "#f8f9ff",
                        "tertiary-fixed": "#95f8a7"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "lg": "24px",
                        "md": "16px",
                        "xxl": "64px",
                        "unit": "4px",
                        "gutter": "24px",
                        "container-max": "1200px",
                        "xs": "4px",
                        "xl": "40px",
                        "sm": "8px"
                    },
                    "fontFamily": {
                        "headline-md": ["Literata"],
                        "headline-lg": ["Literata"],
                        "headline-lg-mobile": ["Literata"],
                        "display-lg": ["Literata"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "500"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                        "label-sm": ["12px", {"lineHeight": "1", "fontWeight": "500"}],
                        "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen pb-32">
<header class="bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-md py-sm transition-colors">
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
<div class="sticky top-[64px] z-40 bg-surface/80 backdrop-blur-md py-4 -mx-md px-md overflow-x-auto no-scrollbar flex items-center gap-sm md:gap-md">
    <button class="flex items-center gap-1 bg-primary text-on-primary rounded-full px-4 py-2 font-label-md text-label-md whitespace-nowrap">
        <span class="material-symbols-outlined text-[18px]">filter_list</span>
        Filters
    </button>
    <div class="ml-auto hidden md:flex items-center gap-2 border border-outline-variant/50 rounded-full px-4 py-2">
        <span class="font-label-md text-label-md text-secondary">Sort by:</span>
        <select class="bg-transparent border-none focus:ring-0 font-label-md text-label-md text-primary cursor-pointer p-0">
            <option>Recommended</option>
            <option>Price: Low to High</option>
            <option>Newest Arrival</option>
        </select>
    </div>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter mt-lg" id="product-grid">
    <div class="group product-card flex flex-col bg-white rounded-xl overflow-hidden shadow-[0px_4px_20px_rgba(244,114,182,0.08)] transition-all hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)]">
        <div class="relative aspect-square overflow-hidden bg-surface-container-low">
            <img class="product-image w-full h-full object-cover" data-alt="Blushing Peonies" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM"/>
            <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 backdrop-blur-md text-secondary hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">favorite</span>
            </button>
            <div class="absolute bottom-3 left-3">
                <span class="bg-primary-container/90 text-on-primary-container px-3 py-1 rounded-full font-label-sm text-label-sm backdrop-blur-sm">New</span>
            </div>
        </div>
        <div class="p-4 flex flex-col gap-1">
            <h3 class="font-headline-md text-label-md md:text-headline-md text-on-surface group-hover:text-primary transition-colors">Peony Merah Muda</h3>
            <p class="font-body-md text-label-sm text-secondary truncate">Rangkaian elegan untuk momen spesial</p>
            <div class="mt-2 flex items-center justify-between">
                <span class="font-body-lg text-tertiary font-semibold">Rp. 45.000</span>
                <button class="btn-add-to-cart h-8 w-8 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all active:scale-90"
                        data-name="Peony Merah Muda" data-price="45000" data-img="https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                </button>
            </div>
        </div>
    </div>
    <div class="group product-card flex flex-col bg-white rounded-xl overflow-hidden shadow-[0px_4px_20px_rgba(244,114,182,0.08)] transition-all hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)]">
        <div class="relative aspect-square overflow-hidden bg-surface-container-low">
            <img class="product-image w-full h-full object-cover" data-alt="Crimson Romance" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo"/>
            <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 backdrop-blur-md text-secondary hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">favorite</span>
            </button>
        </div>
        <div class="p-4 flex flex-col gap-1">
            <h3 class="font-headline-md text-label-md md:text-headline-md text-on-surface group-hover:text-primary transition-colors">Romansa Merah Tua</h3>
            <p class="font-body-md text-label-sm text-secondary truncate">Mawar merah klasik bertangkai panjang</p>
            <div class="mt-2 flex items-center justify-between">
                <span class="font-body-lg text-tertiary font-semibold">Rp. 59.000</span>
                <button class="btn-add-to-cart h-8 w-8 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all active:scale-90"
                        data-name="Romansa Merah Tua" data-price="59000" data-img="https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                </button>
            </div>
        </div>
    </div>
    <div class="group product-card flex flex-col bg-white rounded-xl overflow-hidden shadow-[0px_4px_20px_rgba(244,114,182,0.08)] transition-all hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)]">
        <div class="relative aspect-square overflow-hidden bg-surface-container-low">
            <img class="product-image w-full h-full object-cover" data-alt="Starlight Lily" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCAj0XJtAkTco3Vz-bCkJiwtdQkv2u-TNR1emY7hCKTDsdik3dx8DCjhcZkF5J6k7VatG2yr9GuYPxpFB1nn4HMhicyOk3DRKPv3o7K9W9JQhoiItyMK6KuCivIXdV6JJ1Vg_uslqAo4cxpSRjgOZvoQTAeKPlRTFU9muCyu9y2fEhmtSAHPuV68er9Z4D8YJZaYQ7XAqnur-nTuEDZNG2ffLPodQ4SO9VI-arceovVZzYaQt7A5n_nOeglm_Q0S29kUqcXrWQgkgc"/>
            <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 backdrop-blur-md text-secondary hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">favorite</span>
            </button>
        </div>
        <div class="p-4 flex flex-col gap-1">
            <h3 class="font-headline-md text-label-md md:text-headline-md text-on-surface group-hover:text-primary transition-colors">Lily Cahaya Bintang</h3>
            <p class="font-body-md text-label-sm text-secondary truncate">Lily putih murni untuk rumah yang tenang</p>
            <div class="mt-2 flex items-center justify-between">
                <span class="font-body-lg text-tertiary font-semibold">Rp. 38.000</span>
                <button class="btn-add-to-cart h-8 w-8 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all active:scale-90"
                        data-name="Lily Cahaya Bintang" data-price="38000" data-img="https://lh3.googleusercontent.com/aida-public/AB6AXuCAj0XJtAkTco3Vz-bCkJiwtdQkv2u-TNR1emY7hCKTDsdik3dx8DCjhcZkF5J6k7VatG2yr9GuYPxpFB1nn4HMhicyOk3DRKPv3o7K9W9JQhoiItyMK6KuCivIXdV6JJ1Vg_uslqAo4cxpSRjgOZvoQTAeKPlRTFU9muCyu9y2fEhmtSAHPuV68er9Z4D8YJZaYQ7XAqnur-nTuEDZNG2ffLPodQ4SO9VI-arceovVZzYaQt7A5n_nOeglm_Q0S29kUqcXrWQgkgc">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                </button>
            </div>
        </div>
    </div>
    <div class="group product-card flex flex-col bg-white rounded-xl overflow-hidden shadow-[0px_4px_20px_rgba(244,114,182,0.08)] transition-all hover:shadow-[0px_10px_30px_rgba(244,114,182,0.15)]">
        <div class="relative aspect-square overflow-hidden bg-surface-container-low">
            <img class="product-image w-full h-full object-cover" data-alt="Golden Sun" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC5NnuNUAoGLVTQmVc3h-aK-lR05EllNdOAcWorexgwMRnjtZfLrSD8VUCA807bhBii_NyrJ4Sh7WgXFWW9vUtTkZQOiY2rBk4PlnrVM9GbSq1eHEZBnsMHNUOMhUoEEr1Dwrb_tpUahodD4uasyUPlWku6gtNtrm8AqS8BzuhpD8NTx67vzITqqsXKQNGDXgtVNtPHucKq2OwkqehLsPNdTRGnMKGA1zOBTmyENGB2hAt4PDhX3BDNcUtx6Cb-TyYi3cWKF6x9uHM"/>
            <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 backdrop-blur-md text-secondary hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">favorite</span>
            </button>
        </div>
        <div class="p-4 flex flex-col gap-1">
            <h3 class="font-headline-md text-label-md md:text-headline-md text-on-surface group-hover:text-primary transition-colors">Matahari Keemasan</h3>
            <p class="font-body-md text-label-sm text-secondary truncate">Bawa kehangatan matahari ke dalam ruangan</p>
            <div class="mt-2 flex items-center justify-between">
                <span class="font-body-lg text-tertiary font-semibold">Rp. 32.000</span>
                <button class="btn-add-to-cart h-8 w-8 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all active:scale-90"
                        data-name="Matahari Keemasan" data-price="32000" data-img="https://lh3.googleusercontent.com/aida-public/AB6AXuC5NnuNUAoGLVTQmVc3h-aK-lR05EllNdOAcWorexgwMRnjtZfLrSD8VUCA807bhBii_NyrJ4Sh7WgXFWW9vUtTkZQOiY2rBk4PlnrVM9GbSq1eHEZBnsMHNUOMhUoEEr1Dwrb_tpUahodD4uasyUPlWku6gtNtrm8AqS8BzuhpD8NTx67vzITqqsXKQNGDXgtVNtPHucKq2OwkqehLsPNdTRGnMKGA1zOBTmyENGB2hAt4PDhX3BDNcUtx6Cb-TyYi3cWKF6x9uHM">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                </button>
            </div>
        </div>
    </div>
</div>
</main>
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md border-t border-outline-variant/30 shadow-[0px_-4px_20px_rgba(244,114,182,0.08)] rounded-t-xl">
    <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim px-4 py-1 hover:text-primary transition-all" href="home.php">
        <span class="material-symbols-outlined">home</span>
        <span class="font-label-md text-label-md mt-1">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center bg-primary-container/20 dark:bg-primary-container/10 text-primary dark:text-primary-fixed-dim rounded-full px-4 py-1" href="katalog.php">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_florist</span>
        <span class="font-label-md text-label-md mt-1">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim px-4 py-1 hover:text-primary transition-all" href="keranjang.php">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="font-label-md text-label-md mt-1">Cart</span>
    </a>
    <?php if(isset($_SESSION['user_id'])): ?>
    <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim px-4 py-1 hover:text-primary transition-all" href="profile.php">
        <span class="material-symbols-outlined">person</span>
        <span class="font-label-md text-label-md mt-1"><?= htmlspecialchars(explode(' ', trim($_SESSION['user_name'] ?? 'User'))[0]) ?></span>
    </a>
    <?php else: ?>
    <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim px-4 py-1 hover:text-primary transition-all" href="login.php">
        <span class="material-symbols-outlined">person</span>
        <span class="font-label-md text-label-md mt-1">Profile</span>
    </a>
    <?php endif; ?>
</nav>

<script>
    // Fetch products dynamically from backend
    document.addEventListener("DOMContentLoaded", () => {
        fetch("../../backend/produk/get_produk.php")
            .then(response => response.json())
            .then(result => {
                if(result.status === 'success' && result.data.length > 0) {
                    // Could replace the static product grid here
                }
            })
            .catch(error => console.error('Error fetching products:', error));

        // Logika untuk Tombol Tambah Keranjang (+)
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
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(productData)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        alert(result.message);
                    } else {
                        alert('Gagal menambahkan produk: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan.');
                });
            });
        });
    });

    // Micro-interactions for product buttons
    document.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('mousedown', () => {
            btn.style.transform = 'scale(0.95)';
        });
        btn.addEventListener('mouseup', () => {
            btn.style.transform = 'scale(1)';
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'scale(1)';
        });
    });

    // Toggle Favorite heart state
    document.querySelectorAll('.material-symbols-outlined').forEach(icon => {
        if (icon.textContent === 'favorite') {
            icon.parentElement.addEventListener('click', (e) => {
                e.preventDefault();
                const isFilled = icon.style.fontVariationSettings.includes("'FILL' 1");
                if (isFilled) {
                    icon.style.fontVariationSettings = "'FILL' 0";
                    icon.classList.remove('text-primary');
                    icon.classList.add('text-secondary');
                } else {
                    icon.style.fontVariationSettings = "'FILL' 1";
                    icon.classList.remove('text-secondary');
                    icon.classList.add('text-primary');
                }
            });
        }
    });
</script>
</body>
</html>