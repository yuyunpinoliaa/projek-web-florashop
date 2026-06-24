<?php
// Memulai session jika digunakan untuk keranjang atau autentikasi user
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Data dummy untuk simulasi item di keranjang belanja (Bisa diganti dengan $_SESSION['cart'])
$cart_items = [
    [
        'id' => 1,
        'name' => 'Blushing Peonies Bouquet',
        'qty' => 1,
        'price' => 84.00,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrVcyG7hD70IVB5vKHuNHntz3Pa3N-Fa2hGUykIAHMXdJktQeU5gf9zv6_P1V5y5pOlndQHmDM7yt0-5R65S8gx0RgqYWZg0zIY2VEw4n7YUT86wX2Ri-sB4g5qtHPpc1JOcKPK1tsmy01NSBNU7Xpm6d9jLNO22AGQsCyuMftVjN4FJNTdeRZwDXRm1n4GiWwFtdMTRbVqT1b5HBA-B3B0qKGtUP61hsrZm7as4W4YsbAKub26hSHSwLdbr62XeBvNZWhnbHxDPM',
        'alt' => 'A close-up photograph of soft, blushing pink peonies in a crystal vase.'
    ],
    [
        'id' => 2,
        'name' => 'Luna Ceramic Vase',
        'qty' => 1,
        'price' => 45.00,
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCqJ-zIw2zdrpjqwKs3XMmYdul5X44JdnvmTSTB-dWKExUe-Z17knUHdL2Ad9V_JJ7Cw-OibvAivSvJ2uW3aydBPUu2KR5YPB0eotG4PzSGpn282u_3efdMhMeql_BRuh8v3GhKR9PJbo6m1OkSoFnxg4SIT3YmfS2v0tH_BdkzBMxoSB7ny9hvEajvCG4kc7RXxA-eGOmEKIdxfCBNAMY_Gjhe6TcJfldlQ1ZAyGSv-VFurC7oMxcWRLV7A2XsovwAOphsLBSEuG8',
        'alt' => 'A minimalist, sculptural white ceramic vase with a matte finish.'
    ]
];

// Perhitungan Subtotal
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['qty'];
}

$shipping_cost = 12.00; // Default: Fresh Morning Express
$tax = 10.32;
$total = $subtotal + $shipping_cost + $tax;
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Checkout | Florashop</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
            },
        }
    </script>
    
    <link href="../../assets/css/checkout.css" rel="stylesheet"/>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen">

<header class="bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-md py-sm">
    <div class="flex items-center gap-md">
        <button class="p-2 rounded-full hover:bg-primary/5 transition-colors active:scale-95 duration-200" onclick="window.history.back()">
            <span class="material-symbols-outlined text-secondary">arrow_back</span>
        </button>
        <h1 class="font-headline-lg-mobile text-headline-lg-mobile text-primary">Florashop</h1>
    </div>
    <div class="flex items-center gap-sm">
        <span class="material-symbols-outlined text-secondary">lock</span>
        <span class="font-label-md text-label-md text-secondary">SECURE CHECKOUT</span>
    </div>
</header>

<main class="max-w-[1200px] mx-auto px-md md:px-lg py-xl">
    <form id="checkoutForm" action="../../backend/checkout/proses_checkout.php" method="POST">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-xl">
            
            <div class="lg:col-span-8 space-y-xl">
                
                <section>
                    <div class="flex items-center justify-between mb-lg">
                        <div class="flex items-center gap-sm">
                            <span class="bg-primary/10 text-primary w-8 h-8 rounded-full flex items-center justify-center font-bold">1</span>
                            <h2 class="font-headline-md text-headline-md">Shipping Address</h2>
                        </div>
                        <button type="button" class="text-primary font-label-md text-label-md hover:underline">+ Add New</button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md" id="addressContainer">
                        <input type="hidden" name="selected_address" id="selectedAddress" value="HOME">

                        <div data-address="HOME" class="address-card p-md bg-surface-container-lowest border border-primary rounded-xl ambient-shadow cursor-pointer transition-all active-ring">
                            <div class="flex justify-between items-start mb-sm">
                                <span class="font-label-md text-label-md text-primary">HOME</span>
                                <span class="check-icon material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </div>
                            <p class="font-label-md text-label-md font-bold text-on-surface">Eleanor Pemberton</p>
                            <p class="text-on-surface-variant text-sm mt-1 leading-relaxed">
                                4821 Petal Lane, Garden District<br/>
                                San Francisco, CA 94103<br/>
                                United States
                            </p>
                        </div>
                        
                        <div data-address="WORK" class="address-card p-md bg-surface-container-lowest border border-outline-variant/30 rounded-xl hover:border-primary/50 transition-all cursor-pointer">
                            <div class="flex justify-between items-start mb-sm">
                                <span class="font-label-md text-label-md text-secondary">WORK</span>
                                <span class="check-icon hidden material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </div>
                            <p class="font-label-md text-label-md font-bold text-on-surface">Eleanor Pemberton</p>
                            <p class="text-on-surface-variant text-sm mt-1 leading-relaxed">
                                1000 Tech Plaza, Suite 400<br/>
                                San Francisco, CA 94105<br/>
                                United States
                            </p>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-sm mb-lg">
                        <span class="bg-primary/10 text-primary w-8 h-8 rounded-full flex items-center justify-center font-bold">2</span>
                        <h2 class="font-headline-md text-headline-md">Delivery Options</h2>
                    </div>
                    <div class="space-y-md">
                        <label class="flex items-center p-md bg-surface-container-lowest border border-outline-variant/30 rounded-xl cursor-pointer hover:bg-primary/5 transition-colors group">
                            <input checked="" class="w-5 h-5 text-primary border-outline focus:ring-primary" name="shipping_option" type="radio" value="express" data-cost="12.00"/>
                            <div class="ml-md flex-1">
                                <p class="font-label-md text-label-md text-on-surface">Fresh Morning Express</p>
                                <p class="text-xs text-on-surface-variant">Guaranteed delivery before 10:00 AM</p>
                            </div>
                            <span class="font-label-md text-label-md text-tertiary">+$12.00</span>
                        </label>
                        <label class="flex items-center p-md bg-surface-container-lowest border border-outline-variant/30 rounded-xl cursor-pointer hover:bg-primary/5 transition-colors group">
                            <input class="w-5 h-5 text-primary border-outline focus:ring-primary" name="shipping_option" type="radio" value="standard" data-cost="0.00"/>
                            <div class="ml-md flex-1">
                                <p class="font-label-md text-label-md text-on-surface">Standard Boutique Delivery</p>
                                <p class="text-xs text-on-surface-variant">Arrival between 1:00 PM - 5:00 PM</p>
                            </div>
                            <span class="font-label-md text-label-md text-on-surface-variant">FREE</span>
                        </label>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-sm mb-lg">
                        <span class="bg-primary/10 text-primary w-8 h-8 rounded-full flex items-center justify-center font-bold">3</span>
                        <h2 class="font-headline-md text-headline-md">Payment Method</h2>
                    </div>
                    <div class="space-y-md">
                        <div class="flex flex-wrap gap-md">
                            <input type="hidden" name="payment_method" id="paymentMethodInput" value="credit_card">
                            
                            <button type="button" id="btn-cc" onclick="selectPayment('credit_card')" class="pay-method-btn flex-1 min-w-[140px] p-md border border-primary bg-primary/5 rounded-xl flex flex-col items-center gap-2 transition-all">
                                <span class="material-symbols-outlined text-primary">credit_card</span>
                                <span class="font-label-md text-label-md">Credit Card</span>
                            </button>
                            <button type="button" id="btn-paypal" onclick="selectPayment('paypal')" class="pay-method-btn flex-1 min-w-[140px] p-md border border-outline-variant/30 rounded-xl flex flex-col items-center gap-2 hover:border-primary/50 transition-all">
                                <span class="material-symbols-outlined text-secondary">payments</span>
                                <span class="font-label-md text-label-md text-secondary">PayPal</span>
                            </button>
                            <button type="button" id="btn-apple" onclick="selectPayment('apple_pay')" class="pay-method-btn flex-1 min-w-[140px] p-md border border-outline-variant/30 rounded-xl flex flex-col items-center gap-2 hover:border-primary/50 transition-all">
                                <span class="material-symbols-outlined text-secondary">apps</span>
                                <span class="font-label-md text-label-md text-secondary">Apple Pay</span>
                            </button>
                        </div>
                        
                        <div id="creditCardForm" class="mt-lg space-y-md">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Card Number</label>
                                <div class="relative">
                                    <input name="card_number" class="w-full px-md py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all bg-surface-container-lowest" placeholder="**** **** **** 4242" type="text"/>
                                    <span class="absolute right-md top-1/2 -translate-y-1/2 material-symbols-outlined text-secondary cursor-pointer">visibility</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-md">
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Expiry Date</label>
                                    <input name="card_expiry" class="w-full px-md py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all bg-surface-container-lowest" placeholder="MM/YY" type="text"/>
                                </div>
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface-variant mb-1">CVC</label>
                                    <input name="card_cvc" class="w-full px-md py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all bg-surface-container-lowest" placeholder="123" type="text"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            <div class="lg:col-span-4">
                <div class="sticky top-24 bg-surface-container-lowest p-lg rounded-2xl ambient-shadow border border-outline-variant/10">
                    <h3 class="font-headline-md text-headline-md mb-lg">Order Summary</h3>
                    
                    <div class="space-y-md mb-lg max-h-64 overflow-y-auto no-scrollbar">
                        <?php foreach ($cart_items as $item): ?>
                        <div class="flex gap-md">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                <img alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-full h-full object-cover" src="<?php echo $item['img']; ?>"/>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-md text-label-md text-on-surface"><?php echo htmlspecialchars($item['name']); ?></p>
                                <p class="text-sm text-on-surface-variant">Qty: <?php echo $item['qty']; ?></p>
                                <p class="font-label-md text-label-md text-tertiary mt-1">$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="border-t border-outline-variant/30 pt-lg space-y-md">
                        <div class="flex justify-between text-on-surface-variant">
                            <span class="font-body-md text-body-md">Subtotal</span>
                            <span class="font-body-md text-body-md">$<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="flex justify-between text-on-surface-variant">
                            <span class="font-body-md text-body-md">Shipping</span>
                            <span id="shippingSummary" class="font-body-md text-body-md">$<?php echo number_format($shipping_cost, 2); ?></span>
                        </div>
                        <div class="flex justify-between text-on-surface-variant">
                            <span class="font-body-md text-body-md">Tax</span>
                            <span class="font-body-md text-body-md">$<?php echo number_format($tax, 2); ?></span>
                        </div>
                        <div class="flex justify-between items-center pt-md border-t border-primary/20">
                            <span class="font-headline-md text-headline-md text-on-surface">Total</span>
                            <span id="totalSummary" class="font-headline-md text-headline-md text-primary">$<?php echo number_format($total, 2); ?></span>
                        </div>
                    </div>
                    
                    <div class="mt-xl space-y-md">
                        <button type="submit" class="w-full py-4 bg-primary text-on-primary rounded-full font-label-md text-label-md uppercase tracking-widest shadow-lg hover:shadow-primary/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                            Place Order
                        </button>
                        <p class="text-center text-[10px] text-on-surface-variant flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-xs">shield</span>
                            Encrypted 256-bit SSL Secure Payment
                        </p>
                    </div>
                    
                    <div class="mt-lg pt-lg border-t border-outline-variant/20 flex justify-center gap-lg">
                        <img alt="Visa" class="h-4 opacity-50 grayscale hover:grayscale-0 transition-all" src="https://lh3.googleusercontent.com/aida-public/AB6AXuClhNHTyRU7G1wGQdXqkHizRMH56IVd7enhREtnpAGCegPYiQGyrLJ6Tb8kq7HSFA-ooIOWvIe3UxkiqfsjYRvRAQNeVxwObXgX0L9qZmis5ebNNiHzVj-7bfmBeRl0VUgxlK_0p4UYu5l1qMoODcwuL68uAHmtzDl3gxOubTfGvVyN6at6AaW34znt5wDK5Ab-gAnmAGCbvIJj3Bb11s-7Niwqv7riszAcC4qmHAU-fN_7J5ry69h83VYiz7qgz5w1nleAQXnl-QA"/>
                        <img alt="Mastercard" class="h-4 opacity-50 grayscale hover:grayscale-0 transition-all" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQbcY8VU3AKt6e6CfXj7a-W1g4buPdUt0ZDRwsre7lyHxae466YobgE1bSzhg6wW7xqxAbiBEBzkH07UxHlccA_6QqyYjGKcfD7hukyv_SIaAOfGS_bVZw6rfinD_CtzRxjRmgnYjsIzKzS2rnVqis4HQQ1aIqbBNU18SuC8a98tdiJCIRWm-9ldTqrfeGMMlzBznsjCl5pfybhF9ebYVVikHZxNp1CUynCowTXscYOkKcsK1Iwp2BvUT-QQQL2k8JVumMPb1XpfU"/>
                        <img alt="PayPal" class="h-4 opacity-50 grayscale hover:grayscale-0 transition-all" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCxLYegsGBenstNmJ6oodPXZ1ZeO3QgxINy80lpAC9AbEpEYSLs78Q9Idem71RtjovByNSrUU-FvnebSbT07qqSpovm1KurvRu2JOGzD1JobFhRD7bNuVzbNmnvtCYd1joUFCjfcA7bbOYaqIZPXcv1H4U71KMtHwn4vxvdKRDnSwTIWZQxl8hw0dmgQX8ZACkVLjfcQil9ikMAXU2YBtGzkHjGSK6hr74UnnHvGKg8qUtqeSAkFVjxA0o8WnPaAa-pn4_bYsk_Jo"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<div class="fixed inset-0 bg-surface/95 backdrop-blur-xl z-[60] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500" id="success-overlay">
    <div class="text-center max-w-sm px-lg">
        <div class="w-20 h-20 bg-tertiary-container text-on-tertiary-container rounded-full flex items-center justify-center mx-auto mb-lg">
            <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
        <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Order Placed!</h2>
        <p class="text-on-surface-variant mb-xl">Your beautiful flowers are being prepared. We've sent a confirmation to your email.</p>
        <button class="w-full py-3 border-2 border-primary text-primary rounded-full font-label-md text-label-md hover:bg-primary/5 transition-colors" onclick="location.reload()">
            Back to Home
        </button>
    </div>
</div>

<script>
    const subtotal = <?php echo $subtotal; ?>;
    const tax = <?php echo $tax; ?>;

    // Logika pemilihan alamat pengiriman
    const addressCards = document.querySelectorAll('.address-card');
    const selectedAddressInput = document.getElementById('selectedAddress');

    addressCards.forEach(card => {
        card.addEventListener('click', () => {
            addressCards.forEach(c => {
                c.classList.remove('border-primary', 'active-ring', 'bg-primary/5');
                c.classList.add('border-outline-variant/30');
                c.querySelector('.check-icon').classList.add('hidden');
            });
            
            card.classList.add('border-primary', 'active-ring', 'bg-primary/5');
            card.classList.remove('border-outline-variant/30');
            card.querySelector('.check-icon').classList.remove('hidden');
            
            selectedAddressInput.value = card.getAttribute('data-address');
        });
    });

    // Sinkronisasi kalkulasi ongkos kirim berbasis radio button pilihan
    const shippingRadios = document.querySelectorAll('input[name="shipping_option"]');
    const shippingSummary = document.getElementById('shippingSummary');
    const totalSummary = document.getElementById('totalSummary');

    shippingRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            const cost = parseFloat(e.target.getAttribute('data-cost'));
            shippingSummary.textContent = `$${cost.toFixed(2)}`;
            const finalTotal = subtotal + cost + tax;
            totalSummary.textContent = `$${finalTotal.toFixed(2)}`;
        });
    });

    // Manajemen pemilihan metode pembayaran
    function selectPayment(method) {
        document.getElementById('paymentMethodInput').value = method;
        const buttons = document.querySelectorAll('.pay-method-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-primary', 'bg-primary/5');
            btn.classList.add('border-outline-variant/30');
            btn.querySelector('span').classList.replace('text-primary', 'text-secondary');
        });

        const activeBtn = document.getElementById(`btn-${method === 'credit_card' ? 'cc' : method === 'paypal' ? 'paypal' : 'apple'}`);
        activeBtn.classList.add('border-primary', 'bg-primary/5');
        activeBtn.querySelector('span').classList.replace('text-secondary', 'text-primary');

        const ccForm = document.getElementById('creditCardForm');
        if (method === 'credit_card') {
            ccForm.classList.remove('hidden');
        } else {
            ccForm.classList.add('hidden');
        }
    }

    // Ajax handling submit form biar overlay pop-up sukses keluar sebelum pindah halaman
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Processing...';
        btn.disabled = true;

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                document.getElementById('success-overlay').classList.remove('opacity-0', 'pointer-events-none');
                document.getElementById('success-overlay').classList.add('opacity-100');
            } else {
                alert('Terjadi kesalahan: ' + data.message);
                btn.innerHTML = 'Place Order';
                btn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memproses pesanan.');
            btn.innerHTML = 'Place Order';
            btn.disabled = false;
        });
    });
</script>
</body>
</html>