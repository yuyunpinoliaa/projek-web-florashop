<!DOCTYPE html>
<html class="light" lang="id">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Florashop - Keindahan di Setiap Kelopak</title>
  <meta name="description" content="Koleksi kurasi terbaik dari kelopak bunga segar pilihan untuk setiap momen berharga Anda."/>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "error-container": "#ffdad6",
            "surface": "#fcf8f9",
            "surface-container-lowest": "#ffffff",
            "on-tertiary-fixed-variant": "#274f2c",
            "primary-container": "#ffc0cb",
            "on-secondary": "#ffffff",
            "on-secondary-fixed-variant": "#8a005d",
            "on-primary-fixed": "#330f19",
            "on-tertiary-fixed": "#002107",
            "tertiary": "#3e6842",
            "on-primary-fixed-variant": "#663a43",
            "secondary-fixed-dim": "#ffafd4",
            "surface-tint": "#81515a",
            "on-primary": "#ffffff",
            "background": "#fcf8f9",
            "on-secondary-fixed": "#3d0027",
            "on-error-container": "#93000a",
            "inverse-on-surface": "#f3f0f1",
            "surface-container-low": "#f6f3f4",
            "tertiary-fixed-dim": "#a4d2a4",
            "on-tertiary-container": "#39623d",
            "on-surface-variant": "#514345",
            "outline-variant": "#d5c2c4",
            "inverse-primary": "#f4b6c1",
            "secondary-fixed": "#ffd8e7",
            "on-background": "#1b1b1c",
            "surface-container": "#f0edee",
            "on-primary-container": "#7b4b55",
            "surface-container-highest": "#e4e2e3",
            "on-error": "#ffffff",
            "primary": "#81515a",
            "outline": "#837375",
            "tertiary-container": "#aedcad",
            "tertiary-fixed": "#bfefbe",
            "on-secondary-container": "#5b003c",
            "on-surface": "#1b1b1c",
            "secondary-container": "#fd4bb4",
            "error": "#ba1a1a",
            "surface-variant": "#e4e2e3",
            "surface-container-high": "#eae7e8",
            "on-tertiary": "#ffffff",
            "surface-bright": "#fcf8f9",
            "primary-fixed-dim": "#f4b6c1",
            "secondary": "#b5007b",
            "primary-fixed": "#ffd9df",
            "surface-dim": "#dcd9da",
            "inverse-surface": "#303031"
          },
          "borderRadius": {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
          "spacing": {
            "margin-desktop": "64px",
            "unit": "8px",
            "container-max": "1280px",
            "gutter": "24px",
            "margin-mobile": "20px"
          },
          "fontFamily": {
            "headline-md-mobile": ["Playfair Display"],
            "title-lg": ["Playfair Display"],
            "label-md": ["Inter"],
            "display-lg-mobile": ["Playfair Display"],
            "display-lg": ["Playfair Display"],
            "headline-md": ["Playfair Display"],
            "body-lg": ["Inter"],
            "label-sm": ["Inter"],
            "body-md": ["Inter"]
          },
          "fontSize": {
            "headline-md-mobile": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
            "title-lg": ["20px", {"lineHeight": "1.4", "fontWeight": "600"}],
            "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "500"}],
            "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
            "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
            "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
            "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
            "label-sm": ["12px", {"lineHeight": "1.4", "fontWeight": "500"}],
            "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
          }
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .ambient-shadow {
      box-shadow: 0px 4px 20px rgba(208, 32, 144, 0.05);
    }
    .high-elevation {
      box-shadow: 0px 12px 40px rgba(0, 0, 0, 0.08);
    }
    .glass-modal {
      backdrop-filter: blur(8px);
      background: rgba(255, 255, 255, 0.7);
    }
    body {
      background-color: #fcf8f9;
      scroll-behavior: smooth;
    }
    .zoom-hover:hover img {
      transform: scale(1.05);
    }
  </style>
</head>
<body class="font-body-md text-on-surface">

<!-- TopNavBar -->
<header class="bg-surface dark:bg-surface-container-low shadow-sm sticky top-0 z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4 w-full transition-all duration-300">
  <div class="font-display-lg-mobile text-display-lg-mobile text-secondary dark:text-secondary-fixed-dim">
    Florashop
  </div>
  <nav class="hidden md:flex gap-8 items-center">
    <a class="text-primary font-bold border-b-2 border-primary pb-1 font-label-md text-label-md hover:text-secondary transition-colors duration-200" href="#">Bouquet</a>
    <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors duration-200" href="#">Bunga Meja</a>
    <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors duration-200" href="#">Papan Bunga</a>
  </nav>
  <div class="flex items-center gap-4">
    <button class="scale-105 transition-transform text-primary dark:text-primary-fixed-dim" aria-label="Riwayat">
      <span class="material-symbols-outlined">history</span>
    </button>
    <button class="scale-105 transition-transform text-primary dark:text-primary-fixed-dim" aria-label="Keranjang">
      <span class="material-symbols-outlined">shopping_cart</span>
    </button>
    <a href="login.php" class="scale-105 transition-transform text-primary dark:text-primary-fixed-dim inline-block" aria-label="Profil">
      <span class="material-symbols-outlined">person</span>
    </a>
  </div>
</header>

<main>
  <!-- Hero Section / Promo Banner -->
  <section class="relative w-full h-[500px] md:h-[700px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img
        alt="Promo Banner: Rangkaian bunga mewah dengan mawar merah muda dan ranunculus krem"
        class="w-full h-full object-cover"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkGoIYhauC9G0NfGyRT0eSp2K4Bd0OagZ4zlh9VAEga1LMYmDeL-tU12iFolc7ooQaMHq9OHDWj1pjG5tZSREx-NIYH2N5Ye1pUyg_e9hAhwqz0NDdOoY5K0He3f-b4-Z91YcKdCmig3jbgA0-B0VuNRHXdAhUrE_UHsnIjSuw1NivjwRMe3WQul09SDt3K2jlrS9hNht7PDM1xOLQ0nhVQjwXzF7N2aBhTImvm388eQrhRMB5yTlwcAhc1ZiZapHLgkwLk-IdW63h"
      />
      <div class="absolute inset-0 bg-gradient-to-r from-surface/80 to-transparent"></div>
    </div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-2xl">
      <span class="inline-block px-3 py-1 bg-tertiary-container text-on-tertiary-container rounded-full font-label-sm text-label-sm mb-4">EDISI MUSIM SEMI</span>
      <h1 class="font-display-lg text-display-lg mb-6 text-on-surface">Ekspresikan Perasaan Melalui Keindahan Bunga</h1>
      <p class="font-body-lg text-body-lg text-on-surface-variant mb-8">Koleksi kurasi terbaik dari kelopak bunga segar pilihan untuk setiap momen berharga Anda.</p>
      <div class="flex gap-4 flex-wrap">
        <button class="bg-secondary text-on-secondary px-8 py-3 rounded-full font-label-md text-label-md hover:scale-105 transition-transform shadow-md">
          Belanja Sekarang
        </button>
        <button class="border border-secondary text-secondary px-8 py-3 rounded-full font-label-md text-label-md hover:bg-secondary-fixed hover:scale-105 transition-transform">
          Lihat Katalog
        </button>
      </div>
    </div>
  </section>

  <!-- Categories Section (Bento Inspired) -->
  <section class="py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="text-center mb-16">
      <h2 class="font-headline-md text-headline-md mb-2">Pilih Kategori Favorit</h2>
      <div class="w-16 h-1 bg-primary mx-auto rounded-full"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter h-auto md:h-[600px]">

      <!-- Bouquet -->
      <div class="md:col-span-8 group relative overflow-hidden rounded-2xl ambient-shadow zoom-hover">
        <img
          alt="Bouquet: Rangkaian bunga hand-tied dengan mawar dusty rose dan eucalyptus"
          class="w-full h-full object-cover transition-transform duration-700"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuCj8c-xfU6PWAoBPL4OkL4MPiusnMn31_6EC-rNXkBb3TSbEC1u6Ys9grV780cpc77o8QHZnCtH5GZQl1mrhe67PbI8uLizWrf5XRIenwRk0KHPQoXF3r4ZEA1n6YkFmz21BeXWzidIPE8UsrS_YZbUeHt27RQ92y8ggPkRFcPJV3prGfZrXP4OHdVQF3o134pts2YM47gxexD6mNVoNYKEc-5eyie2DYWBhOZ3plx8nvBfkBLNMVkLqeM8ozyHF670xFOxx6sP919j"
        />
        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
        <div class="absolute bottom-8 left-8 text-white">
          <h3 class="font-headline-md text-headline-md">Bouquet</h3>
          <p class="font-label-md text-label-md opacity-90">Simbol Kasih Sayang yang Klasik</p>
        </div>
      </div>

      <!-- Bunga Meja -->
      <div class="md:col-span-4 group relative overflow-hidden rounded-2xl ambient-shadow zoom-hover">
        <img
          alt="Bunga Meja: Tulip kuning dan daisy putih dalam vas keramik minimalis"
          class="w-full h-full object-cover transition-transform duration-700"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0zICDoyQVB05QuPTrE3JWBWdqF0GbuIrIRyKSEkaQTMV8Hf3C1zOHLAA64up3WQd00X4RQ8634USAYofFJQiNgvekxWEd0OKGrRamQ1y4GA_4SBvbOeMZQPeJnHw8ZMctG_kzd6wqqPsfwvUnVB4WZGIS4OpLY1ud2lUgSRcNfj7ckex69Ki4b1GseY5fLxquAOVxuWA3QGuz2jplHxDGdEK88z6CTCTQ_x9coYGCziBOVkdVVHI_6105Gcx4ZYYeFngAy4MlDyeD"
        />
        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
        <div class="absolute bottom-8 left-8 text-white">
          <h3 class="font-headline-md text-headline-md">Bunga Meja</h3>
          <p class="font-label-md text-label-md opacity-90">Hiasi Ruang dengan Segar</p>
        </div>
      </div>

      <!-- Papan Bunga -->
      <div class="md:col-span-12 group relative overflow-hidden rounded-2xl ambient-shadow zoom-hover h-64">
        <img
          alt="Papan Bunga: Papan bunga modern dengan anggrek dan lily putih"
          class="w-full h-full object-cover transition-transform duration-700"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0YAgY9b0EBFQnkv8w3nvYcwC7u62nhHojkBGWhxhEcjqRzjzpnHMA7MJLRbaMDsrP7x3hqLRGhJcDwXfSeNLKXic-hruiqkDzXBDUQZeOI-AGbPi2VLQ_cfCqgY3s_GI6v-wftmRQE1l41HOdpbWmUk2_1vKF7PZmrvPSFvgv7k_7PkO273OezW-BPGVIRDJoZtxOzn7IbCTNZaFfJ1ASlPNjqyc8oY40yiYPvIovq5rxVQjgSD4ys0tMmwkz-bWwk0ve68NLGku3"
        />
        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
        <div class="absolute bottom-8 left-8 text-white">
          <h3 class="font-headline-md text-headline-md">Papan Bunga</h3>
          <p class="font-label-md text-label-md opacity-90">Ucapan yang Berkesan &amp; Megah</p>
        </div>
      </div>

    </div>
  </section>

  <!-- Featured Products -->
  <section class="py-24 bg-surface-container-low">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
      <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
        <div>
          <span class="text-primary font-label-md text-label-md tracking-widest uppercase">TERLARIS</span>
          <h2 class="font-headline-md text-headline-md text-on-surface">Produk Unggulan Kami</h2>
        </div>
        <a class="text-secondary font-label-md text-label-md flex items-center gap-2 hover:underline" href="#">
          Lihat Semua Produk
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">

        <!-- Product Card 1 -->
        <div class="group">
          <div class="relative aspect-[3/4] rounded-2xl overflow-hidden ambient-shadow mb-4 bg-white">
            <img
              alt="Rose Amour: Bouquet Mawar Merah"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuAVxJNZzk_S4nr5x7XbztVLP-8lUv236Mv46_zcDao-FOUHEhiy7iZWrPNf18mXvt746p1074IfIi9szfvLPgamISKrUV4asblhSodEmVkq2phmB6ADPHVeAPn84N3mhN70tK88_mAxYo6GGuSeM1C1E5HN8IbgHcq9VG1cQOka2lN41nMlci0tKCDKWXmFNN-8B33RX6esZN3ir1DYa2VCIwQW0Mswg5uJfg67v_na8FhtVdgFikeCHm7Wt601UxI_0eL6CHAp8QvG"
            />
            <button class="absolute top-4 right-4 w-10 h-10 bg-white/80 glass-modal rounded-full flex items-center justify-center text-primary hover:bg-white transition-colors" aria-label="Tambah ke wishlist">
              <span class="material-symbols-outlined">favorite</span>
            </button>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
              <button class="w-full bg-secondary text-white py-3 rounded-xl font-label-md text-label-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                Tambah
              </button>
            </div>
          </div>
          <h4 class="font-title-lg text-title-lg text-on-surface mb-1">Rose Amour</h4>
          <p class="font-label-md text-label-md text-on-surface-variant mb-2">Bouquet Mawar Merah</p>
          <p class="font-title-lg text-title-lg text-secondary">Rp 450.000</p>
        </div>

        <!-- Product Card 2 -->
        <div class="group">
          <div class="relative aspect-[3/4] rounded-2xl overflow-hidden ambient-shadow mb-4 bg-white">
            <img
              alt="White Serenity: Bunga Meja Lily"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuCnHpe3eZ1Qt1TLpxuoc1DzFnL-CvL7GkTzj7VYNDBc1jYfk0r_PvbDPbnEmKuNYb2wVaDDCXTFpfLjnV2SlWLSmG6pKzK1o9SBM81nvaduzEQYCYjhzi6S9BIW2kztoXGfOGWTLxEqkPVssOqZk3M2l-jpzssWJKOQMN3LD_P_HgFjxXNeJP6RAN2gsKXMofyXApxz5RTrIq7u35MAmY6eIQGWU5XS_k7dWUBYcZS5aW19WTl0L8xKwMXEyAAoirddruWKuS1VXXSE"
            />
            <button class="absolute top-4 right-4 w-10 h-10 bg-white/80 glass-modal rounded-full flex items-center justify-center text-primary hover:bg-white transition-colors" aria-label="Tambah ke wishlist">
              <span class="material-symbols-outlined">favorite</span>
            </button>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
              <button class="w-full bg-secondary text-white py-3 rounded-xl font-label-md text-label-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                Tambah
              </button>
            </div>
          </div>
          <h4 class="font-title-lg text-title-lg text-on-surface mb-1">White Serenity</h4>
          <p class="font-label-md text-label-md text-on-surface-variant mb-2">Bunga Meja Lily</p>
          <p class="font-title-lg text-title-lg text-secondary">Rp 525.000</p>
        </div>

        <!-- Product Card 3 -->
        <div class="group">
          <div class="relative aspect-[3/4] rounded-2xl overflow-hidden ambient-shadow mb-4 bg-white">
            <img
              alt="Pastel Dream: Bouquet Mix Pastel"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuALWJ06-juW7PGPeIWbr-OmJyaTE8Mp3OnjF3AL562Ux5BmXZrxP9VWxANTQ_Ng9rrb3-7GC82of4mehl1vUFAWw9AYCRKPv3mf8YE25ahrZw84WOnrBaqocKd1mPfA-hAVJUFbvSAhD7wj68jPFPqlpPsSA3T4dmXi-uYrlasStb3EGlD5FkOkNsz7XSL9tBglA2Lc_yZlW_NyBBWJ8wUV6sLGbl5zN71EbDmKpXJNKIwDoa_rNPy8w2rwDgF6HKywNMFP51O38m1g"
            />
            <div class="absolute top-4 left-4 bg-tertiary text-white px-3 py-1 rounded-full font-label-sm text-label-sm">Bunga Segar</div>
            <button class="absolute top-4 right-4 w-10 h-10 bg-white/80 glass-modal rounded-full flex items-center justify-center text-primary hover:bg-white transition-colors" aria-label="Tambah ke wishlist">
              <span class="material-symbols-outlined">favorite</span>
            </button>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
              <button class="w-full bg-secondary text-white py-3 rounded-xl font-label-md text-label-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                Tambah
              </button>
            </div>
          </div>
          <h4 class="font-title-lg text-title-lg text-on-surface mb-1">Pastel Dream</h4>
          <p class="font-label-md text-label-md text-on-surface-variant mb-2">Bouquet Mix Pastel</p>
          <p class="font-title-lg text-title-lg text-secondary">Rp 380.000</p>
        </div>

        <!-- Product Card 4 -->
        <div class="group">
          <div class="relative aspect-[3/4] rounded-2xl overflow-hidden ambient-shadow mb-4 bg-white">
            <img
              alt="Golden Celebration: Papan Bunga Modern"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoHHVwZ7X2pr8Q_4YIbGVV4roUYcPQ8qFojUGkDRMkXPKpz6NpEuipDmzKGCcKFWNnvz230TyCqVUoVZEEHQokx-HnCvZ3EJvKmu7tAua6jcN9f7l3IzNBX4jsXywjpDplmIrcgZ6mryyWB4OvPDGeHvkIO9jiVqh4Afb2WWbgwaG_IANl-qzX0bGE00W7T_mrgWYFNkNFuTdyTVeVDMEwNJlVQ7VgxkUsRaRbBiRQz3jP5fsgRw_0yglekYULISTokNwPpE-j4aYA"
            />
            <div class="absolute top-4 left-4 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full font-label-sm text-label-sm">Best Seller</div>
            <button class="absolute top-4 right-4 w-10 h-10 bg-white/80 glass-modal rounded-full flex items-center justify-center text-primary hover:bg-white transition-colors" aria-label="Tambah ke wishlist">
              <span class="material-symbols-outlined">favorite</span>
            </button>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
              <button class="w-full bg-secondary text-white py-3 rounded-xl font-label-md text-label-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                Tambah
              </button>
            </div>
          </div>
          <h4 class="font-title-lg text-title-lg text-on-surface mb-1">Golden Celebration</h4>
          <p class="font-label-md text-label-md text-on-surface-variant mb-2">Papan Bunga Modern</p>
          <p class="font-title-lg text-title-lg text-secondary">Rp 850.000</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Newsletter / CTA -->
  <section class="py-24 px-margin-mobile md:px-margin-desktop">
    <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden relative p-12 text-center bg-primary-container/30">
      <div class="relative z-10">
        <h2 class="font-display-lg-mobile text-display-lg-mobile md:text-headline-md text-on-primary-container mb-4">Dapatkan Penawaran Spesial</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mb-8 max-w-lg mx-auto">Berlangganan newsletter kami untuk mendapatkan diskon 10% pada pesanan pertama dan update koleksi terbaru.</p>
        <form id="newsletter-form" class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
          <input
            class="flex-1 px-6 py-3 rounded-full border border-pink-200 focus:border-primary focus:ring-primary focus:ring-1 bg-white outline-none"
            placeholder="Alamat email Anda"
            type="email"
            required
          />
          <button class="bg-secondary text-on-secondary px-8 py-3 rounded-full font-label-md text-label-md hover:scale-105 transition-transform" type="submit">
            Langganan
          </button>
        </form>
      </div>
    </div>
  </section>
</main>

<!-- Footer -->
<footer class="bg-surface-container-highest dark:bg-inverse-surface flex flex-col items-center py-12 px-margin-mobile gap-6">
  <div class="font-title-lg text-title-lg text-primary">Florashop</div>
  <div class="flex gap-8 flex-wrap justify-center">
    <a class="text-on-surface-variant font-label-sm text-label-sm hover:text-primary transition-opacity opacity-80 hover:opacity-100" href="#">Tentang Kami</a>
    <a class="text-on-surface-variant font-label-sm text-label-sm hover:text-primary transition-opacity opacity-80 hover:opacity-100" href="#">Kebijakan Privasi</a>
    <a class="text-on-surface-variant font-label-sm text-label-sm hover:text-primary transition-opacity opacity-80 hover:opacity-100" href="#">Hubungi Kami</a>
  </div>
  <div class="flex gap-4">
    <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-on-surface-variant hover:text-secondary hover:border-secondary transition-all" aria-label="Share">
      <span class="material-symbols-outlined text-[20px]">share</span>
    </button>
    <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-on-surface-variant hover:text-secondary hover:border-secondary transition-all" aria-label="Website">
      <span class="material-symbols-outlined text-[20px]">public</span>
    </button>
    <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-on-surface-variant hover:text-secondary hover:border-secondary transition-all" aria-label="Email">
      <span class="material-symbols-outlined text-[20px]">mail</span>
    </button>
  </div>
  <div class="text-on-surface-variant font-label-sm text-label-sm mt-4">
    © 2024 Florashop. Keindahan di Setiap Kelopak.
  </div>
</footer>

<script>
  // Micro-interactions untuk semua tombol
  document.querySelectorAll('button').forEach(button => {
    button.addEventListener('mousedown', () => {
      button.classList.add('scale-95');
    });
    button.addEventListener('mouseup', () => {
      button.classList.remove('scale-95');
    });
  });

  // Sticky header efek blur saat scroll
  window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 20) {
      header.classList.add('shadow-md');
      header.style.backgroundColor = 'rgba(252, 248, 249, 0.95)';
      header.style.backdropFilter = 'blur(10px)';
    } else {
      header.classList.remove('shadow-md');
      header.style.backgroundColor = '';
      header.style.backdropFilter = '';
    }
  });

  // Newsletter form
  document.getElementById('newsletter-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    const original = btn.textContent;
    btn.textContent = 'Berhasil! ✓';
    btn.disabled = true;
    setTimeout(() => {
      btn.textContent = original;
      btn.disabled = false;
      e.target.reset();
    }, 2000);
  });
</script>

</body>
</html>