<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil order_id dari query string atau session
$order_id = null;
if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
} elseif (isset($_SESSION['last_order_id'])) {
    $order_id = intval($_SESSION['last_order_id']);
}

// Ambil data pesanan dari database
$order      = null;
$order_items = [];

if ($order_id) {
    require_once '../../backend/config/db.php';

    try {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $order_id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $order = null;
    }

    if ($order) {
        try {
            $items_stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = :oid ORDER BY id ASC");
            $items_stmt->execute([':oid' => $order_id]);
            $order_items = $items_stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $order_items = [];
        }
    }
}

// Tanggal estimasi pengiriman
$estimated_date = date('d F Y', strtotime('+1 day'));

// Format order ID tampilan
$order_display = $order_id ? sprintf('FLR-%05d', $order_id) : 'FLR-XXXXX';

// Ambil data dari order jika ada
$customer_name  = $order ? htmlspecialchars($order['customer_name'])  : 'Pelanggan';
$total_amount   = $order ? floatval($order['total'])                  : 0;
$shipping_opt   = $order ? $order['shipping_option']                  : 'express';
$address        = $order ? htmlspecialchars($order['address'])        : '-';
$payment_method = $order ? $order['payment_method']                   : 'credit_card';
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pesanan Berhasil | Florashop</title>
    <meta name="description" content="Pesanan Anda telah berhasil dibuat di Florashop. Terima kasih telah berbelanja bunga segar bersama kami."/>

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

    <link href="../../assets/css/order_success.css" rel="stylesheet"/>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen overflow-x-hidden">

<!-- Animated background petals -->
<div class="petal-container" aria-hidden="true">
    <div class="petal petal-1">&#127800;</div>
    <div class="petal petal-2">&#127826;</div>
    <div class="petal petal-3">&#127799;</div>
    <div class="petal petal-4">&#127800;</div>
    <div class="petal petal-5">&#127804;</div>
    <div class="petal petal-6">&#127826;</div>
    <div class="petal petal-7">&#127800;</div>
    <div class="petal petal-8">&#127799;</div>
</div>

<!-- Header -->
<header class="bg-surface/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-6 py-3 border-b border-outline-variant/20">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">local_florist</span>
        <h1 class="font-headline-lg-mobile text-headline-lg-mobile text-primary">Florashop</h1>
    </div>
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-tertiary text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
        <span class="font-label-md text-label-md text-secondary hidden sm:inline">PESANAN DIKONFIRMASI</span>
    </div>
</header>

<main class="max-w-3xl mx-auto px-4 md:px-6 py-10 relative z-10">

    <!-- SUCCESS HERO CARD -->
    <div class="success-card bg-surface-container-lowest rounded-3xl overflow-hidden mb-6 shadow-2xl">

        <!-- Gradient top banner -->
        <div class="success-banner relative flex flex-col items-center justify-center py-10 px-6 text-center overflow-hidden">
            <div class="confetti-ring ring-1" aria-hidden="true"></div>
            <div class="confetti-ring ring-2" aria-hidden="true"></div>
            <div class="confetti-ring ring-3" aria-hidden="true"></div>

            <!-- Checkmark icon -->
            <div class="check-wrapper relative z-10 mb-5">
                <div class="check-circle w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg mx-auto">
                    <span class="material-symbols-outlined text-tertiary check-icon-anim" style="font-size: 48px; font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>
            </div>

            <h2 class="relative z-10 font-headline-lg text-headline-lg text-white mb-2 drop-shadow">
                Pesanan Berhasil Dibuat!
            </h2>
            <p class="relative z-10 text-white/80 text-sm max-w-xs">
                Bunga segar pilihan Anda sedang disiapkan dengan penuh cinta oleh tim Florashop.
            </p>
        </div>

        <!-- Order ID + Status Badge -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-6 py-4 bg-surface-container-low border-b border-outline-variant/20">
            <div>
                <p class="text-xs text-on-surface-variant font-label-md uppercase tracking-widest">Nomor Pesanan</p>
                <p class="font-headline-md text-headline-md text-primary mt-0.5"><?php echo $order_display; ?></p>
            </div>
            <div class="flex items-center gap-2 bg-tertiary/10 text-tertiary px-4 py-2 rounded-full border border-tertiary/30">
                <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">schedule</span>
                <span class="font-label-md text-label-md">Menunggu Konfirmasi</span>
            </div>
        </div>

        <!-- Order detail grid -->
        <div class="px-6 py-6">
            <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest mb-4">Detail Pesanan</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div class="detail-item flex items-start gap-3">
                    <div class="icon-box bg-primary/10 rounded-xl p-2 flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-base">person</span>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant font-label-md">Penerima</p>
                        <p class="text-on-surface font-semibold text-sm mt-0.5"><?php echo $customer_name; ?></p>
                    </div>
                </div>

                <div class="detail-item flex items-start gap-3">
                    <div class="icon-box bg-tertiary/10 rounded-xl p-2 flex-shrink-0">
                        <span class="material-symbols-outlined text-tertiary text-base">payments</span>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant font-label-md">Total Pembayaran</p>
                        <p class="text-primary font-semibold text-sm mt-0.5">
                            Rp <?php echo $total_amount > 0 ? number_format($total_amount, 0, ',', '.') : '0'; ?>
                        </p>
                    </div>
                </div>

                <div class="detail-item flex items-start gap-3">
                    <div class="icon-box bg-primary/10 rounded-xl p-2 flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-base">local_shipping</span>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant font-label-md">Metode Pengiriman</p>
                        <p class="text-on-surface font-semibold text-sm mt-0.5">
                            <?php echo ($shipping_opt === 'express') ? 'Ekspres Pagi Segar' : 'Pengiriman Standar Butik'; ?>
                        </p>
                    </div>
                </div>

                <div class="detail-item flex items-start gap-3">
                    <div class="icon-box bg-tertiary/10 rounded-xl p-2 flex-shrink-0">
                        <span class="material-symbols-outlined text-tertiary text-base">event</span>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant font-label-md">Estimasi Tiba</p>
                        <p class="text-on-surface font-semibold text-sm mt-0.5"><?php echo $estimated_date; ?></p>
                    </div>
                </div>

                <div class="detail-item flex items-start gap-3 sm:col-span-2">
                    <div class="icon-box bg-primary/10 rounded-xl p-2 flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-base">location_on</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-on-surface-variant font-label-md">Alamat Pengiriman</p>
                        <p class="text-on-surface font-semibold text-sm mt-0.5"><?php echo $address; ?></p>
                    </div>
                </div>
            </div>

            <!-- Item pesanan -->
            <?php if (!empty($order_items)): ?>
            <div class="border-t border-outline-variant/20 pt-5">
                <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest mb-4">Item yang Dipesan</h3>
                <div class="space-y-3">
                    <?php foreach ($order_items as $item): ?>
                    <div class="flex items-center gap-3 p-3 bg-surface-container rounded-xl border border-outline-variant/20 hover:border-primary/30 transition-colors">
                        <?php if (!empty($item['product_img'])): ?>
                        <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-surface-container-high">
                            <img src="<?php echo htmlspecialchars($item['product_img']); ?>"
                                 alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                                 class="w-full h-full object-cover"/>
                        </div>
                        <?php else: ?>
                        <div class="w-14 h-14 rounded-lg flex-shrink-0 bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">local_florist</span>
                        </div>
                        <?php endif; ?>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-on-surface text-sm truncate"><?php echo htmlspecialchars($item['product_name']); ?></p>
                            <p class="text-xs text-on-surface-variant mt-0.5">Qty: <?php echo intval($item['quantity']); ?></p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-semibold text-tertiary text-sm">Rp <?php echo number_format(floatval($item['price']), 0, ',', '.'); ?></p>
                            <p class="text-xs text-on-surface-variant">per item</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TRACKING TIMELINE -->
    <div class="bg-surface-container-lowest rounded-2xl p-6 mb-6 shadow-md border border-outline-variant/20">
        <h3 class="font-headline-md text-headline-md mb-5">Status Pengiriman</h3>
        <div class="timeline">
            <div class="timeline-item timeline-done">
                <div class="timeline-icon bg-tertiary text-on-tertiary">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check</span>
                </div>
                <div class="timeline-content">
                    <p class="font-semibold text-on-surface text-sm">Pesanan Dikonfirmasi</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">Pesanan Anda telah berhasil kami terima.</p>
                </div>
            </div>

            <div class="timeline-item timeline-active">
                <div class="timeline-icon bg-primary text-on-primary pulse-dot">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">local_florist</span>
                </div>
                <div class="timeline-content">
                    <p class="font-semibold text-on-surface text-sm">Sedang Disiapkan</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">Tim florist kami sedang merangkai bunga pilihan Anda.</p>
                </div>
            </div>

            <div class="timeline-item timeline-pending">
                <div class="timeline-icon bg-outline-variant text-on-surface-variant">
                    <span class="material-symbols-outlined text-sm">local_shipping</span>
                </div>
                <div class="timeline-content">
                    <p class="font-semibold text-on-surface-variant text-sm">Dalam Pengiriman</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">Estimasi: <?php echo $estimated_date; ?></p>
                </div>
            </div>

            <div class="timeline-item timeline-pending timeline-last">
                <div class="timeline-icon bg-outline-variant text-on-surface-variant">
                    <span class="material-symbols-outlined text-sm">home</span>
                </div>
                <div class="timeline-content">
                    <p class="font-semibold text-on-surface-variant text-sm">Pesanan Tiba</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">Bunga segar sampai di tangan Anda!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- INFO CARD -->
    <div class="bg-primary/5 border border-primary/20 rounded-2xl p-5 mb-6 flex gap-4 items-start">
        <div class="bg-primary/10 rounded-xl p-2 flex-shrink-0">
            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">mark_email_read</span>
        </div>
        <div>
            <p class="font-semibold text-on-surface text-sm">Konfirmasi Email Dikirim</p>
            <p class="text-xs text-on-surface-variant mt-1 leading-relaxed">
                Detail pesanan dan informasi pengiriman telah kami kirimkan ke email yang terdaftar. Mohon periksa kotak masuk atau folder spam Anda.
            </p>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="flex flex-col sm:flex-row gap-3">
        <a href="home.php"
           id="btn-beranda"
           class="flex-1 flex items-center justify-center gap-2 py-4 bg-primary text-on-primary rounded-full font-label-md text-label-md uppercase tracking-widest shadow-lg hover:shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <span class="material-symbols-outlined text-base">home</span>
            Kembali ke Beranda
        </a>
        <a href="katalog.php"
           id="btn-katalog"
           class="flex-1 flex items-center justify-center gap-2 py-4 border-2 border-primary text-primary rounded-full font-label-md text-label-md uppercase tracking-widest hover:bg-primary/5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <span class="material-symbols-outlined text-base">local_florist</span>
            Belanja Lagi
        </a>
    </div>

    <p class="text-center text-xs text-on-surface-variant mt-6 flex items-center justify-center gap-1">
        <span class="material-symbols-outlined text-xs text-primary" style="font-variation-settings: 'FILL' 1;">favorite</span>
        Terima kasih telah mempercayai Florashop untuk momen spesial Anda
        <span class="material-symbols-outlined text-xs text-primary" style="font-variation-settings: 'FILL' 1;">favorite</span>
    </p>

</main>

<!-- Toast Notification -->
<div id="toast-success"
     class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-inverse-surface text-inverse-on-surface px-5 py-3 rounded-2xl shadow-2xl opacity-0 translate-y-8 transition-all duration-500"
     role="alert" aria-live="polite">
    <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1; color: #79db8d;">check_circle</span>
    <span class="font-label-md text-label-md">Pesanan berhasil dibuat!</span>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('toast-success');
        setTimeout(() => {
            toast.classList.remove('opacity-0', 'translate-y-8');
            toast.classList.add('opacity-100', 'translate-y-0');
        }, 600);
        setTimeout(() => {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', 'translate-y-8');
        }, 4000);
    });
</script>
</body>
</html>
