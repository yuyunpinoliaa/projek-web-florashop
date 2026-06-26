<?php
session_start();

// 1. Ambil nama produk dari URL (jika tidak ada, berikan default produk pertama)
$product_name_get = isset($_GET['name']) ? $_GET['name'] : 'Buket Mawar Merah Segar';

// 2. Data Master Detail Produk Lengkap (Bahasa Indonesia & Harga Rp)
$product_details = [
    'Buket Mawar Merah Segar' => [
        'name' => 'Buket Mawar Merah Segar',
        'price' => 185000,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5NnuNUAoGLVTQmVc3h-aK-lR05EllNdOAcWorexgwMRnjtZfLrSD8VUCA807bhBii_NyrJ4Sh7WgXFWW9vUtTkZQOiY2rBk4PlnrVM9GbSq1eHEZBnsMHNUOMhUoEEr1Dwrb_tpUahodD4uasyUPlWku6gtNtrm8AqS8BzuhpD8NTx67vzITqqsXKQNGDXgtVNtPHucKq2OwkqehLsPNdTRGnMKGA1zOBTmyENGB2hAt4PDhX3BDNcUtx6Cb-TyYi3cWKF6x9uHM',
        'desc' => 'Rangkaian bunga mawar merah asli pilihan yang segar, merekah indah, dan memiliki aroma wangi alami. Sangat cocok sebagai hadiah ungkapan cinta, momen ulang tahun, maupun anniversary spesial Anda.',
        'care_1' => 'Ganti air di dalam wadah/vas setiap 2 hari sekali agar tetap segar maksimal.',
        'care_2' => 'Letakkan di tempat yang sejuk, hindari embusan angin kencang langsung dan paparan sinar matahari terik.'
    ],
    'Buket Satin Rose Elegant' => [
        'name' => 'Buket Satin Rose Elegant',
        'price' => 65000,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM',
        'desc' => 'Buket kerajinan tangan premium yang terbuat dari jalinan pita kain satin berkualitas tinggi. Kelopak mawar dibuat sangat detail, rapi, awet, anti layu, dan dapat disimpan selamanya sebagai kenangan manis.',
        'care_1' => 'Bersihkan dari debu secara berkala menggunakan kemoceng kecil atau tisu kering.',
        'care_2' => 'Simpan di dalam ruangan dengan suhu kamar dan hindari tempat yang terlalu lembap.'
    ],
    'Buket Fresh Sunflower' => [
        'name' => 'Buket Fresh Sunflower',
        'price' => 135000,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTOTQK0qUlxJogYOHu_crSwfBQ_j7LP-CiTs26N81y3T_ZJtRQpUNalI4Ghcc3rIswmEDVeuWRHyaSOyQQcc31wfiTBmI3RiK8C-rdG3cH_mwKID4IYU_jkG5poRcAh5D0uLIQ7QPXPo-0TRMlO52eeoJbxTAcRe6P9osxqQlykTjPMZW7zwNXsRlbbDYNyYK_xIy9fjAH5YNnctEfL-AEFGsgTppWIvL7M3Nd-UTpMnJWvv0UosCRKYqJQrKOr5AP6O-0ArroOV8',
        'desc' => 'Kombinasi menawan dari bunga matahari asli yang mekar sempurna berukuran besar, dipadukan dengan pemanis baby breath segar. Memancarkan energi keceriaan, kehangatan, dan semangat positif.',
        'care_1' => 'Potong sedikit ujung tangkai secara miring sebelum dimasukkan kembali ke dalam air bersih.',
        'care_2' => 'Pastikan air di vas cukup melimpah karena bunga matahari menyerap air cukup banyak.'
    ],
    'Buket Uang Money Bloom' => [
        'name' => 'Buket Uang Money Bloom',
        'price' => 150000,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo',
        'desc' => 'Kado kekinian super mewah yang merangkai lembaran uang kertas pelindung plastik tebal tanpa merusak uangnya sedikitpun. Sangat dicari untuk hadiah wisuda, pesta kelulusan, ataupun hadiah ulang tahun.',
        'care_1' => 'Hindari melipat buket terlalu keras agar bentuk rangka luar tetap tegak simetris.',
        'care_2' => 'Jauhkan dari jangkauan anak kecil atau percikan air langsung demi keamanan lembaran uang.'
    ],
    'Buket Artificial Daisy Lily' => [
        'name' => 'Buket Artificial Daisy Lily',
        'price' => 75000,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDS4bVXbZMRUnDeOD5vC4NiFEhT0R-UKhUW2HeBDeFhGuwI4XEh-vCmHx5Oy6c7BV_n0vSzGy-qaWooLrYy9ggXf_OaM665tC8kueeixh-MrJ4MTXDyXbvfBSAK59lrvvvYd01dGD06dk0-0wLbRilOopkSB5DRA8GROmFTmJ0HThtE6OYCswKtr962fyRuGbt0h-Y0e_b45UsZ-_7_AX0Drl3dJHF0MO_aDpFaLL8w8JZPBij4wPVphCI8bRsE3Ck3L3qOlHK1-LM',
        'desc' => 'Perpaduan estetis antara bunga daisy dan lily tiruan (palsu) berbahan lateks dan plastik premium look. Terlihat sangat nyata menyerupai bunga asli dan sangat pas sebagai pajangan interior jangka panjang.',
        'care_1' => 'Jika terkena kotoran, lap perlahan kelopak bunga menggunakan kain setengah basah.',
        'care_2' => 'Jangan dijemur di bawah sinar matahari langsung terlalu lama agar warna tidak pudar.'
    ],
    'Buket Satin Lavender Soft' => [
        'name' => 'Buket Satin Lavender Soft',
        'price' => 55000,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwSQvb6GE4xX9iuJHE7BMcVJMHJS7A1OqgqNjXBvD581t_DbFMiOo8Xirdg-jM6gtO_Km1bAa6DQJsPbdoCtT7rtYnrWIfK7_GlZuXlFEWV6pHdl_aZ2u9_mpVN6ngEkPDdSSMcWvbTQ1WDC36BkwxbuEP7C-tOZwSET7KGIh2HCYqf8Xz0GKkQ6fuP7FjOuE5948ablEU3ke2EnieEcmmC75c85HDfOGbJlDOPnMO2our05Xqa5_XKKZgEYDE05_jaHr1ivkKZOE',
        'desc' => 'Buket handmade bunga lavender berbahan kain satin dengan balutan warna ungu pastel yang lembut dan menenangkan. Cocok sebagai hadiah wisuda maupun pelengkap dekorasi kamar estetis.',
        'care_1' => 'Cukup bersihkan debu dengan meniupnya perlahan atau memakai kuas halus.',
        'care_2' => 'Simpan di tempat yang kering dan sejuk.'
    ]
];

// 3. Ambil data spesifik produk berdasarkan kecocokan nama, jika tidak terdaftar arahkan ke default
$product = isset($product_details[$product_name_get]) ? $product_details[$product_name_get] : $product_details['Buket Mawar Merah Segar'];
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Detail Produk</title>
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
        <button onclick="history.back()" class="material-symbols-outlined text-primary text-[24px] focus:outline-none">arrow_back</button>
    </div>
    <h1 class="text-lg font-bold text-primary">Detail Buket</h1>
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-[24px] cursor-pointer" onclick="window.location.href='keranjang.php'">shopping_cart</span>
    </div>
</header>

<main class="max-w-[1000px] mx-auto px-4 mt-6">
    <div class="flex flex-col md:flex-row gap-8 bg-white p-6 rounded-3xl shadow-[0px_4px_20px_rgba(244,114,182,0.04)] border border-gray-50">
        
        <div class="w-full md:w-1/2 flex flex-col gap-4">
            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 shadow-sm">
                <img id="main-image" src="<?php echo $product['img']; ?>" class="w-full h-full object-cover transition-all duration-300" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
        </div>

        <div class="w-full md:w-1/2 flex flex-col justify-between gap-6">
            <div>
                <h2 class="text-2xl font-bold text-on-surface mb-2"><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="text-2xl font-extrabold text-primary mb-4">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                
                <hr class="border-gray-100 mb-4" />
                
                <h3 class="text-sm font-bold text-on-surface mb-2">Deskripsi Produk</h3>
                <p class="text-secondary text-sm leading-relaxed mb-6"><?php echo htmlspecialchars($product['desc']); ?></p>
                
                <div class="bg-gray-50 p-4 rounded-xl flex flex-col gap-3 border border-gray-100">
                    <h4 class="text-xs font-bold text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">local_florist</span> Tips Perawatan Bunga
                    </h4>
                    <div class="flex gap-2 items-start text-xs text-secondary">
                        <span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
                        <p><?php echo htmlspecialchars($product['care_1']); ?></p>
                    </div>
                    <div class="flex gap-2 items-start text-xs text-secondary">
                        <span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
                        <p><?php echo htmlspecialchars($product['care_2']); ?></p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3 mt-4">
                <div class="flex items-center justify-between border border-gray-200 rounded-full px-4 py-2 bg-white">
                    <span class="text-sm font-medium text-secondary">Jumlah</span>
                    <div class="flex items-center gap-4">
                        <button id="btn-minus" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-gray-500 hover:bg-gray-100 text-lg">-</button>
                        <span id="qty-display" class="font-bold text-on-surface text-base">1</span>
                        <button id="btn-plus" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-gray-500 hover:bg-gray-100 text-lg">+</button>
                    </div>
                </div>

                <button id="btn-add-cart" class="w-full bg-primary text-on-primary font-bold py-3.5 rounded-full shadow-md hover:bg-primary/95 transition-all flex items-center justify-center gap-2 active:scale-[0.99]"
                        data-name="<?php echo htmlspecialchars($product['name']); ?>"
                        data-price="<?php echo $product['price']; ?>"
                        data-img="<?php echo $product['img']; ?>">
                    <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
                    TAMBAH KE KERANJANG
                </button>

                <button id="btn-buy-now" class="w-full bg-white border-2 border-primary text-primary font-bold py-3.5 rounded-full hover:bg-primary/5 transition-all flex items-center justify-center gap-2 active:scale-[0.99]">
                    BELI SEKARANG
                </button>
            </div>
        </div>
    </div>
</main>

<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-white/90 backdrop-blur-md border-t border-gray-100 rounded-t-xl shadow-md">
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="home.php">
        <span class="material-symbols-outlined">home</span>
        <span class="text-[11px] mt-0.5">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="katalog.php">
        <span class="material-symbols-outlined">local_florist</span>
        <span class="text-[11px] mt-0.5">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="keranjang.php">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="text-[11px] mt-0.5">Cart</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary" href="login.php">
        <span class="material-symbols-outlined">person</span>
        <span class="text-[11px] mt-0.5">Profile</span>
    </a>
</nav>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let currentQty = 1;
    const qtyDisplay = document.getElementById('qty-display');
    const btnPlus = document.getElementById('btn-plus');
    const btnMinus = document.getElementById('btn-minus');
    const btnAddCart = document.getElementById('btn-add-cart');
    const btnBuyNow = document.getElementById('btn-buy-now');

    // Mengatur kuantitas (+) dan (-)
    btnPlus.addEventListener('click', () => {
        currentQty++;
        qtyDisplay.textContent = currentQty;
    });

    btnMinus.addEventListener('click', () => {
        if (currentQty > 1) {
            currentQty--;
            qtyDisplay.textContent = currentQty;
        }
    });

    // Fungsi Pengiriman AJAX Tambah Ke Keranjang
    function sendToCart(callback = null) {
        const productData = {
            name: btnAddCart.getAttribute('data-name'),
            price: parseInt(btnAddCart.getAttribute('data-price')),
            img: btnAddCart.getAttribute('data-img'),
            quantity: currentQty
        };

        // Menggunakan fetch ke backend keranjang yang sudah kita buat sebelumnya
        fetch('../../backend/keranjang/tambah_keranjang.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(productData)
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                if (callback) {
                    callback();
                } else {
                    alert('Produk berhasil ditambahkan ke keranjang belanja!');
                }
            } else {
                alert('Gagal menambahkan produk: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan koneksi sistem.');
        });
    }

    // Eksekusi klik Tambah Ke Keranjang
    btnAddCart.addEventListener('click', () => {
        sendToCart();
    });

    // Eksekusi klik Beli Sekarang (Simpan ke keranjang lalu alihkan halaman otomatis)
    btnBuyNow.addEventListener('click', () => {
        sendToCart(() => {
            window.location.href = 'keranjang.php';
        });
    });
});
</script>
</body>
</html>