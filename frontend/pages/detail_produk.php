<?php
// frontend/pages/detail_produk.php

// Hubungkan ke backend untuk mendapatkan data produk
require_once '../../backend/produk/get_detail_produk.php';
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - <?php echo htmlspecialchars($product_data['name']); ?></title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="../../assets/css/detail_produk.css">

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
                },
            }
        }
    </script>
</head>
<body class="bg-background text-on-surface font-body-md text-body-md overflow-x-hidden">

    <?php include_once '../components/navbar.php'; ?>

    <main class="max-w-[1200px] mx-auto px-md md:px-lg py-md mb-xxl">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-lg items-start">
            
            <div class="md:col-span-7 lg:col-span-8 space-y-md">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-surface-container shadow-[0px_4px_20px_rgba(244,114,182,0.08)]">
                    <img alt="<?php echo htmlspecialchars($product_data['name']); ?>" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" src="<?php echo $product_data['images'][0]; ?>"/>
                    <button class="absolute top-4 right-4 bg-white/90 backdrop-blur shadow-sm p-3 rounded-full hover:bg-white transition-all active:scale-90 group" data-active="false" onclick="toggleFavorite(this)">
                        <span class="material-symbols-outlined text-primary transition-all group-data-[active=true]:fill-current" id="fav-icon">favorite</span>
                    </button>
                </div>
                
                <div class="hidden md:flex gap-sm">
                    <?php foreach($product_data['images'] as $index => $img_url): ?>
                        <?php if($index > 0): // Menampilkan gambar pendukung selain gambar utama ?>
                            <div class="w-24 h-24 rounded-lg overflow-hidden hover:border-2 hover:border-outline-variant cursor-pointer transition-all">
                                <img class="w-full h-full object-cover" src="<?php echo $img_url; ?>" alt="Thumbnail <?php echo $index; ?>"/>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="md:col-span-5 lg:col-span-4 space-y-lg">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full font-label-sm text-label-sm"><?php echo htmlspecialchars($product_data['tag']); ?></span>
                        <div class="flex items-center gap-1 text-tertiary">
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-label-md text-label-md"><?php echo $product_data['rating']; ?> (<?php echo $product_data['reviews_count']; ?> reviews)</span>
                        </div>
                    </div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-2"><?php echo htmlspecialchars($product_data['name']); ?></h1>
                    <p class="font-headline-md text-headline-md text-tertiary">$<?php echo number_format($product_data['price'], 2); ?></p>
                </div>

                <div class="space-y-sm">
                    <h3 class="font-label-md text-label-md uppercase tracking-wider text-outline">Description</h3>
                    <p class="text-on-surface-variant leading-relaxed">
                        <?php echo htmlspecialchars($product_data['description']); ?>
                    </p>
                </div>

                <div class="bg-surface-container-low p-md rounded-xl space-y-md">
                    <div class="flex items-center gap-md">
                        <span class="material-symbols-outlined text-primary">eco</span>
                        <div>
                            <h4 class="font-label-md text-label-md">Freshness Guarantee</h4>
                            <p class="text-sm text-on-surface-variant">Stays fresh for 7+ days with proper care.</p>
                        </div>
                    </div>
                    <hr class="border-outline-variant/30"/>
                    <div class="space-y-sm">
                        <h4 class="font-label-md text-label-md">Care Instructions</h4>
                        <ul class="text-sm text-on-surface-variant space-y-2">
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                Trim stems at a 45-degree angle upon arrival.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                Change water every 2 days for maximum longevity.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                Keep in a cool, draft-free spot away from direct sun.
                            </li>
                        </ul>
                    </div>
                </div>

                <form action="proses_keranjang.php" method="POST" class="space-y-md pt-md">
                    <input type="hidden" name="product_id" value="<?php echo $product_data['id']; ?>">
                    <div class="flex items-center justify-between bg-white border border-outline-variant p-2 rounded-full w-full">
                        <button type="button" class="w-10 h-10 flex items-center justify-center hover:bg-surface-variant/20 rounded-full transition-all" onclick="updateQty(-1)">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                        <input type="number" id="quantity-input" name="quantity" value="1" min="1" class="w-12 text-center border-none focus:ring-0 font-label-md text-label-md p-0">
                        <button type="button" class="w-10 h-10 flex items-center justify-center hover:bg-surface-variant/20 rounded-full transition-all" onclick="updateQty(1)">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                    <div class="flex flex-col gap-sm">
                        <button type="submit" name="add_to_cart" class="w-full bg-primary text-on-primary font-label-md text-label-md py-4 rounded-full shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">
                            ADD TO CART
                        </button>
                        <button type="submit" name="buy_now" class="w-full border border-primary text-primary font-label-md text-label-md py-4 rounded-full hover:bg-primary/5 active:scale-95 transition-all">
                            BUY IT NOW
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <section class="mt-xxl border-t border-outline-variant/30 pt-xxl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-lg gap-md">
                <h2 class="font-headline-lg text-headline-lg">Customer Love</h2>
                <button class="font-label-md text-label-md text-primary flex items-center gap-2 hover:underline">
                    Write a Review
                    <span class="material-symbols-outlined">edit</span>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
                <?php foreach($product_data['reviews'] as $review): ?>
                    <div class="bg-white p-md rounded-xl shadow-[0px_4px_20px_rgba(244,114,182,0.08)] border border-fdf2f8 transition-all hover:-translate-y-1">
                        <div class="flex gap-1 text-primary mb-sm">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' <?php echo ($i <= $review['stars']) ? '1' : '0'; ?>;">star</span>
                            <?php endfor; ?>
                        </div>
                        <p class="font-body-md text-body-md italic text-on-surface-variant mb-md"><?php echo htmlspecialchars($review['comment']); ?></p>
                        <div class="flex items-center gap-sm">
                            <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-label-md"><?php echo htmlspecialchars($review['initial']); ?></div>
                            <div>
                                <p class="font-label-md text-label-md"><?php echo htmlspecialchars($review['name']); ?></p>
                                <p class="text-xs text-outline">Verified Buyer</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="flex justify-center mt-lg">
                <button class="bg-surface-container-low text-primary px-lg py-md rounded-full font-label-md hover:bg-surface-container transition-colors">
                    Load More Reviews
                </button>
            </div>
        </section>
    </main>

    <?php include_once '../components/footer.php'; ?>

    <script>
        // Mengubah nilai kuantitas via input angka langsung/tombol increment
        function updateQty(delta) {
            const qtyInput = document.getElementById('quantity-input');
            let currentQty = parseInt(qtyInput.value);
            if (isNaN(currentQty)) currentQty = 1;
            currentQty = Math.max(1, currentQty + delta);
            qtyInput.value = currentQty;
        }

        // Toggle state tombol wishlist favorit
        function toggleFavorite(btn) {
            const icon = btn.querySelector('#fav-icon');
            const isActive = btn.getAttribute('data-active') === 'true';
            
            if (isActive) {
                btn.setAttribute('data-active', 'false');
                icon.style.fontVariationSettings = "'FILL' 0";
            } else {
                btn.setAttribute('data-active', 'true');
                icon.style.fontVariationSettings = "'FILL' 1";
            }
        }
    </script>
</body>
</html>