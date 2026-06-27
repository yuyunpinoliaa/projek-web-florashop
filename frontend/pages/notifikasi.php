<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../../backend/config/db.php';

// Fetch notifications before marking them as read (so we can highlight new ones in this load)
try {
    $notif_stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = :uid ORDER BY created_at DESC");
    $notif_stmt->execute([':uid' => $_SESSION['user_id']]);
    $notifications = $notif_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mark them as read for future visits
    $update_stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = :uid AND is_read = 0");
    $update_stmt->execute([':uid' => $_SESSION['user_id']]);
} catch (PDOException $e) {
    $notifications = [];
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Notifikasi | Florashop</title>
    
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
                        "primary": "#a43073",
                        "on-primary": "#ffffff",
                        "primary-container": "#f472b6",
                        "on-primary-container": "#6d0047",
                        "secondary": "#635c61",
                        "secondary-container": "#e7dde3",
                        "surface": "#f8f9ff",
                        "on-surface": "#121c2a",
                        "outline-variant": "#dac0c9",
                        "tertiary": "#006d30",
                        "tertiary-container": "#79db8d",
                        "on-tertiary-container": "#00210a",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "warning": "#eab308",
                        "warning-container": "#fef08a",
                        "on-warning-container": "#713f12"
                    },
                    "fontFamily": {
                        "headline-md": ["Literata"],
                        "headline-lg": ["Literata"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    }
                }
            }
        }
    </script>
    
    <style>
        .notif-card {
            transition: all 0.3s ease;
        }
        .notif-card.unread {
            background-color: rgba(164, 48, 115, 0.03);
            border-left: 4px solid #a43073;
        }
        .notif-card.read {
            border-left: 4px solid transparent;
        }
    </style>
</head>
<body class="bg-[#f8f9ff] text-on-surface font-body-md min-h-screen pb-32">

<!-- Header -->
<header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-6 py-4 border-b border-gray-100 shadow-sm">
    <div class="flex items-center gap-2">
        <a href="home.php" class="material-symbols-outlined text-primary text-[24px] p-1.5 hover:bg-primary/5 rounded-full transition-all">arrow_back</a>
    </div>
    <h1 class="text-xl font-bold text-primary mx-auto">Notifikasi Saya</h1>
    <div class="w-9 h-9"></div> <!-- Spacer to center title -->
</header>

<!-- Main Container -->
<main class="max-w-[800px] mx-auto px-4 mt-6">
    
    <?php if (empty($notifications)): ?>
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center py-20 text-center bg-white rounded-2xl p-8 border border-outline-variant/10 shadow-sm">
            <span class="material-symbols-outlined text-[80px] text-gray-300 mb-4">notifications_off</span>
            <h2 class="text-xl font-bold text-on-surface mb-2">Belum Ada Notifikasi</h2>
            <p class="text-secondary max-w-sm mb-6 text-sm">Setiap kali ada pembaruan status pada pesanan bunga Anda, notifikasi akan muncul di sini.</p>
            <a href="katalog.php" class="bg-primary text-on-primary px-8 py-3 rounded-full font-bold shadow-md hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Cari Bunga Segar
            </a>
        </div>
    <?php else: ?>
        <!-- Notifications List -->
        <div class="flex flex-col gap-4">
            <?php foreach ($notifications as $notif): 
                // Determine icon and color based on notification content
                $icon = 'notifications';
                $iconClass = 'bg-primary/10 text-primary';
                
                $message_lower = strtolower($notif['message']);
                $title_lower = strtolower($notif['title']);
                
                if (strpos($message_lower, 'dibuat') !== false) {
                    $icon = 'shopping_cart';
                    $iconClass = 'bg-primary/10 text-primary';
                } elseif (strpos($message_lower, 'proses') !== false) {
                    $icon = 'hourglass_top';
                    $iconClass = 'bg-warning-container/40 text-warning';
                } elseif (strpos($message_lower, 'kirim') !== false) {
                    $icon = 'local_shipping';
                    $iconClass = 'bg-sky-100 text-sky-600';
                } elseif (strpos($message_lower, 'selesai') !== false) {
                    $icon = 'check_circle';
                    $iconClass = 'bg-green-100 text-tertiary';
                } elseif (strpos($message_lower, 'batal') !== false) {
                    $icon = 'cancel';
                    $iconClass = 'bg-error-container/60 text-error';
                }
                
                $is_unread = ($notif['is_read'] == 0);
            ?>
                <div class="notif-card <?php echo $is_unread ? 'unread' : 'read'; ?> bg-white p-4 rounded-xl shadow-sm border border-outline-variant/10 hover:shadow-md flex gap-4 items-start relative overflow-hidden">
                    <!-- Dynamic Notification Type Icon -->
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 <?php echo $iconClass; ?>">
                        <span class="material-symbols-outlined text-[22px]"><?php echo $icon; ?></span>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 class="font-bold text-on-surface text-sm sm:text-base flex items-center gap-1.5">
                                <?php echo htmlspecialchars($notif['title']); ?>
                                <?php if ($is_unread): ?>
                                    <span class="w-2 h-2 bg-primary rounded-full inline-block" title="Baru"></span>
                                <?php endif; ?>
                            </h3>
                            <span class="text-[11px] text-secondary flex-shrink-0">
                                <?php 
                                    $date = new DateTime($notif['created_at']);
                                    echo $date->format('d M H:i');
                                ?>
                            </span>
                        </div>
                        <p class="text-secondary text-xs sm:text-sm leading-relaxed mb-2"><?php echo htmlspecialchars($notif['message']); ?></p>
                        
                        <!-- Link to order detail -->
                        <a href="order_success.php?order_id=<?php echo $notif['order_id']; ?>" class="inline-flex items-center text-xs text-primary font-semibold hover:underline gap-0.5">
                            Lihat Detail Pesanan
                            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
</main>

<!-- Navigation Bottom Bar (Matches other customer pages) -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-white/95 backdrop-blur-md border-t border-outline-variant/30 rounded-t-xl shadow-[0px_-4px_20px_rgba(244,114,182,0.08)]">
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="home.php">
        <span class="material-symbols-outlined">home</span>
        <span class="font-label-md text-label-md mt-1">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="katalog.php">
        <span class="material-symbols-outlined">local_florist</span>
        <span class="font-label-md text-label-md mt-1">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="keranjang.php">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="font-label-md text-label-md mt-1">Cart</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="login_admin.php">
        <span class="material-symbols-outlined">admin_panel_settings</span>
        <span class="font-label-md text-label-md mt-1">Admin</span>
    </a>
</nav>

</body>
</html>
