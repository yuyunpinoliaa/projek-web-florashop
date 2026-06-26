<?php 
session_start();
include_once '../includes/navbar.php'; 

// Data dummy Produk Unggulan (Nama Indonesia & Harga Rupiah)
$products = [
    ['name' => 'Buket Mawar Merah Segar', 'price' => 185000, 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5NnuNUAoGLVTQmVc3h-aK-lR05EllNdOAcWorexgwMRnjtZfLrSD8VUCA807bhBii_NyrJ4Sh7WgXFWW9vUtTkZQOiY2rBk4PlnrVM9GbSq1eHEZBnsMHNUOMhUoEEr1Dwrb_tpUahodD4uasyUPlWku6gtNtrm8AqS8BzuhpD8NTx67vzITqqsXKQNGDXgtVNtPHucKq2OwkqehLsPNdTRGnMKGA1zOBTmyENGB2hAt4PDhX3BDNcUtx6Cb-TyYi3cWKF6x9uHM'],
    ['name' => 'Buket Satin Rose Elegant', 'price' => 65000, 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM'],
    ['name' => 'Buket Fresh Sunflower', 'price' => 135000, 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTOTQK0qUlxJogYOHu_crSwfBQ_j7LP-CiTs26N81y3T_ZJtRQpUNalI4Ghcc3rIswmEDVeuWRHyaSOyQQcc31wfiTBmI3RiK8C-rdG3cH_mwKID4IYU_jkG5poRcAh5D0uLIQ7QPXPo-0TRMlO52eeoJbxTAcRe6P9osxqQlykTjPMZW7zwNXsRlbbDYNyYK_xIy9fjAH5YNnctEfL-AEFGsgTppWIvL7M3Nd-UTpMnJWvv0UosCRKYqJQrKOr5AP6O-0ArroOV8'],
    ['name' => 'Buket Uang Money Bloom', 'price' => 150000, 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo']
];
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

    <section class="mt-xxl mx-md py-xl bg-white rounded-3xl shadow-[0px_4px_20px_rgba(244,114,182,0.04)] text-center border border-pink-50">
        <h3 class="font-headline-lg text-headline-lg text-on-surface mb-4">Bergabung dengan Komunitas Kami</h3>
        <p class="font-body-md text-secondary mb-8 max-w-md mx-auto">Berlangganan untuk penawaran eksklusif, tips perawatan bunga, dan akses lebih awal untuk koleksi musiman kami.</p>
        <form action="" method="POST" class="flex flex-col md:flex-row justify-center items-center gap-4 max-w-lg mx-auto">
            <input class="w-full md:flex-1 rounded-full border border-pink-100 bg-white px-6 py-3 focus:ring-primary focus:border-primary transition-all" placeholder="Alamat email Anda" type="email" name="email" required/>
            <button type="submit" class="w-full md:w-auto bg-primary text-on-primary px-xl py-3 rounded-full font-label-md text-label-md hover:scale-105 active:scale-95 transition-all">Berlangganan</button>
        </form>
    </section>
</main>

<?php 
include_once '../includes/footer.php'; 
?>