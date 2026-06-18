<?php
// Contoh data dinamis dari session/database (Bisa Anda sesuaikan nantinya)
$items = [
    [
        'id' => 1,
        'nama' => 'Blushing Peonies Bouquet',
        'qty' => 1,
        'harga' => 125000,
        'img' => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?q=80&w=200&auto=format&fit=crop'
    ],
    [
        'id' => 2,
        'nama' => 'Luna Ceramic Vase',
        'qty' => 1,
        'harga' => 65000,
        'img' => 'https://images.unsplash.com/photo-1612196808214-b8e1d6145a8c?q=80&w=200&auto=format&fit=crop'
    ]
];

$subtotal = 0;
foreach ($items as $item) {
    $subtotal += $item['harga'] * $item['qty'];
}

$shipping_cost = 15000; // Default awal pengiriman
$tax = $subtotal * 0.11; // Contoh Pajak 11%
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
                    colors: {
                        "primary": "#a43073",
                        "secondary": "#635c61",
                        "background": "#f8f9ff",
                        "surface": "#f8f9ff",
                        "on-background": "#121c2a",
                        "on-surface": "#121c2a",
                        "on-primary": "#ffffff",
                        "outline-variant": "#dac0c9",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#006d30",
                        "tertiary-container": "#51b269",
                        "on-tertiary-container": "#004019",
                        "on-surface-variant": "#544249"
                    }
                }
            }
        }
    </script>
    
    <link rel="stylesheet" href="../../assets/css/checkout.css">
</head>
<body class="bg-background text-on-background font-body-md min-h-screen">

    <header class="bg-surface/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-4 py-2 border-b border-outline-variant/20">
        <div class="flex items-center gap-4">
            <button class="p-2 rounded-full hover:bg-primary/5 transition-colors active:scale-95 duration-200" onclick="window.history.back()">
                <span class="material-symbols-outlined text-secondary">arrow_back</span>
            </button>
            <h1 class="text-xl md:text-2xl font-bold text-primary tracking-tight font-['Literata']">Florashop</h1>
        </div>
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary text-sm">lock</span>
            <span class="text-xs font-semibold tracking-wider text-secondary uppercase">SECURE CHECKOUT</span>
        </div>
    </header>

    <main class="max-w-[1200px] mx-auto px-4 md:px-6 py-10">
        <form action="../../backend/checkout/proses_checkout.php" method="POST" id="form-checkout">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-8 space-y-8">
                    
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <span class="bg-primary/10 text-primary w-8 h-8 rounded-full flex items-center justify-center font-bold">1</span>
                                <h2 class="text-lg font-bold font-['Literata']">Alamat Pengiriman</h2>
                            </div>
                            <button type="button" class="text-primary text-sm font-semibold hover:underline">+ Tambah Baru</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="hidden" name="alamat_pilihan" id="alamat_pilihan" value="Alamat Utama (Rumah)">

                            <div class="address-card p-4 bg-surface-container-lowest border-2 border-primary rounded-xl ambient-shadow cursor-pointer transition-all active-ring" data-address="Alamat Utama (Rumah)">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs font-bold tracking-wider text-primary">RUMAH</span>
                                    <span class="material-symbols-outlined text-primary text-icon" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                                <p class="font-bold text-on-surface text-sm">Eleanor Pemberton</p>
                                <p class="text-on-surface-variant text-xs mt-1 leading-relaxed">
                                    Jl. Raya Kunir No. 45, Kec. Kunir<br/>
                                    Kabupaten Lumajang, Jawa Timur 67381<br/>
                                    Indonesia
                                </p>
                            </div>

                            <div class="address-card p-4 bg-surface-container-lowest border border-outline-variant/40 rounded-xl hover:border-primary/50 transition-all cursor-pointer" data-address="Alamat Kantor (Kerja)">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs font-bold tracking-wider text-secondary">KANTOR</span>
                                </div>
                                <p class="font-bold text-on-surface text-sm">Eleanor Pemberton</p>
                                <p class="text-on-surface-variant text-xs mt-1 leading-relaxed">
                                    Gedung ITB Widya Gama Kampus 2<br/>
                                    Kec. Sukodono, Kab. Lumajang<br/>
                                    Indonesia
                                </p>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary/10 text-primary w-8 h-8 rounded-full flex items-center justify-center font-bold">2</span>
                            <h2 class="text-lg font-bold font-['Literata']">Opsi Pengiriman</h2>
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 bg-surface-container-lowest border border-outline-variant/40 rounded-xl cursor-pointer hover:bg-primary/5 transition-colors group">
                                <input checked class="w-5 h-5 text-primary border-outline focus:ring-primary" name="shipping_method" type="radio" value="Fresh Morning Express"/>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-bold text-on-surface">Fresh Morning Express</p>
                                    <p class="text-xs text-on-surface-variant">Garansi pengiriman segar sebelum jam 10:00 WIB</p>
                                </div>
                                <span class="text-sm font-bold text-tertiary">+Rp 15.000</span>
                            </label>
                            
                            <label class="flex items-center p-4 bg-surface-container-lowest border border-outline-variant/40 rounded-xl cursor-pointer hover:bg-primary/5 transition-colors group">
                                <input class="w-5 h-5 text-primary border-outline focus:ring-primary" name="shipping_method" type="radio" value="Standard Boutique Delivery"/>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-bold text-on-surface">Standard Boutique Delivery</p>
                                    <p class="text-xs text-on-surface-variant">Estimasi kedatangan jam 13:00 - 17:00 WIB</p>
                                </div>
                                <span class="text-sm font-bold text-on-surface-variant">GRATIS</span>
                            </label>
                        </div>
                    </section>

                    <section>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary/10 text-primary w-8 h-8 rounded-full flex items-center justify-center font-bold">3</span>
                            <h2 class="text-lg font-bold font-['Literata']">Metode Pembayaran</h2>
                        </div>
                        <div class="space-y-4">
                            <div class="flex flex-wrap gap-4">
                                <input type="hidden" name="payment_method" id="payment_method" value="Credit Card">
                                
                                <button type="button" class="btn-payment flex-1 min-w-[120px] p-4 border border-primary bg-primary/5 rounded-xl flex flex-col items-center gap-2 transition-all active-ring" data-method="Credit Card">
                                    <span class="material-symbols-outlined text-primary">credit_card</span>
                                    <span class="text-xs font-bold">Kartu Kredit</span>
                                </button>
                                <button type="button" class="btn-payment flex-1 min-w-[120px] p-4 border border-outline-variant/40 rounded-xl flex flex-col items-center gap-2 hover:border-primary/50 transition-all" data-method="PayPal">
                                    <span class="material-symbols-outlined text-secondary">payments</span>
                                    <span class="text-xs font-bold text-secondary">PayPal</span>
                                </button>
                                <button type="button" class="btn-payment flex-1 min-w-[120px] p-4 border border-outline-variant/40 rounded-xl flex flex-col items-center gap-2 hover:border-primary/50 transition-all" data-method="Apple Pay">
                                    <span class="material-symbols-outlined text-secondary">apps</span>
                                    <span class="text-xs font-bold text-secondary">E-Wallet</span>
                                </button>
                            </div>
                            
                            <div id="card-details-form" class="mt-4 space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface-variant mb-1">Nomor Kartu</label>
                                    <div class="relative">
                                        <input name="card_number" class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all bg-surface-container-lowest text-sm" placeholder="**** **** **** 4242" type="text"/>
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-secondary cursor-pointer">visibility</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Masa Berlaku</label>
                                        <input name="card_expiry" class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all bg-surface-container-lowest text-sm" placeholder="MM/YY" type="text"/>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">CVC / CVV</label>
                                        <input name="card_cvc" class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all bg-surface-container-lowest text-sm" placeholder="123" type="text"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                
                <div class="lg:col-span-4">
                    <div class="sticky top-24 bg-surface-container-lowest p-6 rounded-2xl ambient-shadow border border-outline-variant/20">
                        <h3 class="text-lg font-bold font-['Literata'] mb-4">Ringkasan Pesanan</h3>
                        <div class="space-y-4 mb-4 max-h-64 overflow-y-auto no-scrollbar">
                            
                            <?php foreach ($items as $item): ?>
                            <div class="flex gap-4">
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                    <img alt="<?php echo $item['nama']; ?>" class="w-full h-full object-cover" src="<?php echo $item['img']; ?>"/>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface leading-tight"><?php echo $item['nama']; ?></p>
                                    <p class="text-xs text-on-surface-variant mt-0.5">Jumlah: <?php echo $item['qty']; ?></p>
                                    <p class="text-sm font-bold text-tertiary mt-1">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        
                        <div class="border-t border-outline-variant/30 pt-4 space-y-3">
                            <div class="flex justify-between text-sm text-on-surface-variant">
                                <span>Subtotal</span>
                                <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                            </div>
                            <div class="flex justify-between text-sm text-on-surface-variant">
                                <span>Ongkos Kirim</span>
                                <span id="label-ongkir">Rp <?php echo number_format($shipping_cost, 0, ',', '.'); ?></span>
                            </div>
                            <div class="flex justify-between text-sm text-on-surface-variant">
                                <span>Pajak (11%)</span>
                                <span>Rp <?php echo number_format($tax, 0, ',', '.'); ?></span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-primary/20">
                                <span class="font-bold text-on-surface">Total Pembayaran</span>
                                <span class="text-xl font-bold text-primary" id="label-total">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-4">
                            <button type="submit" class="w-full py-4 bg-primary text-on-primary rounded-full font-bold text-sm uppercase tracking-widest shadow-lg hover:shadow-primary/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                                Selesaikan Pesanan
                            </button>
                            <p class="text-center text-[10px] text-on-surface-variant flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-xs">shield</span>
                                Koneksi Terenkripsi Aman 256-bit SSL
                            </p>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-outline-variant/20 flex justify-center gap-4 items-center">
                            <span class="text-[11px] uppercase tracking-wider font-bold text-secondary/60">Metode Support:</span>
                            <span class="text-xs font-bold text-secondary/80">KARTU</span>
                            <span class="text-xs font-bold text-secondary/80">OVO/DANA</span>
                            <span class="text-xs font-bold text-secondary/80">COD</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <div class="fixed inset-0 bg-surface/95 backdrop-blur-xl z-[60] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500" id="success-overlay">
        <div class="text-center max-w-sm px-6">
            <div class="w-20 h-20 bg-tertiary-container text-on-tertiary-container rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
            <h2 class="text-2xl font-bold text-primary mb-2 font-['Literata']">Pesanan Berhasil!</h2>
            <p class="text-sm text-on-surface-variant mb-6">Buket indah Anda sedang disiapkan oleh tim Florist. Detail transaksi telah dikirimkan ke email Anda.</p>
            <button class="w-full py-3 border-2 border-primary text-primary rounded-full font-bold text-sm hover:bg-primary/5 transition-colors" onclick="location.reload()">
                Kembali Belanja
            </button>
        </div>
    </div>

    <script>
        // Logika Interaksi Pengiriman Form (Submit handler asynchronous simulasi)
        document.getElementById('form-checkout').addEventListener('submit', function(e) {
            e.preventDefault(); // Menahan redirect browser langsung demi efek transisi visual sukses
            const btn = this.querySelector('button[type="submit"]');
            
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Memproses...';
            btn.disabled = true;
            
            // Mengirimkan form data via AJAX/Fetch ke backend PHP
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log("Response Backend:", data);
                // Menampilkan overlay sukses setelah respon berhasil
                setTimeout(() => {
                    document.getElementById('success-overlay').classList.remove('opacity-0', 'pointer-events-none');
                    document.getElementById('success-overlay').classList.add('opacity-100');
                }, 1000);
            })
            .catch(error => {
                alert("Terjadi gangguan pendaftaran transaksi.");
                btn.innerHTML = 'Selesaikan Pesanan';
                btn.disabled = false;
            });
        });

        // Logika Pemilihan Alamat
        const addressCards = document.querySelectorAll('.address-card');
        const inputAlamat = document.getElementById('alamat_pilihan');

        addressCards.forEach(card => {
            card.addEventListener('click', () => {
                addressCards.forEach(c => {
                    c.classList.remove('border-primary', 'active-ring', 'bg-primary/5', 'border-2');
                    c.classList.add('border-outline-variant/40');
                    const icon = c.querySelector('.text-icon');
                    if(icon) icon.remove();
                });
                
                card.classList.add('border-primary', 'active-ring', 'bg-primary/5', 'border-2');
                card.classList.remove('border-outline-variant/40');
                
                inputAlamat.value = card.getAttribute('data-address');
                
                const header = card.querySelector('div');
                const check = document.createElement('span');
                check.className = 'material-symbols-outlined text-primary text-icon';
                check.style.fontVariationSettings = "'FILL' 1";
                check.textContent = 'check_circle';
                header.appendChild(check);
            });
        });

        // Logika Pemilihan Pembayaran
        const paymentButtons = document.querySelectorAll('.btn-payment');
        const inputPayment = document.getElementById('payment_method');
        const formDetailKartu = document.getElementById('card-details-form');

        paymentButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                paymentButtons.forEach(b => {
                    b.classList.remove('border-primary', 'bg-primary/5', 'active-ring');
                    b.querySelector('span:first-child').classList.replace('text-primary', 'text-secondary');
                    b.querySelector('span:last-child').classList.replace('text-primary', 'text-secondary');
                });

                btn.classList.add('border-primary', 'bg-primary/5', 'active-ring');
                const selectedMethod = btn.getAttribute('data-method');
                inputPayment.value = selectedMethod;

                // Sembunyikan form kartu jika memilih payment alternatif
                if(selectedMethod === 'Credit Card') {
                    formDetailKartu.style.display = 'block';
                } else {
                    formDetailKartu.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>