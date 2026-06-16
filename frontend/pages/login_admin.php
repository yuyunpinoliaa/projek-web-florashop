<?php
// frontend/pages/login_admin.php
session_start();

// Jika admin sudah login, alihkan langsung ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard_admin.php');
    exit();
}

// Ambil pesan error jika ada proses login yang gagal sebelumnya
$error_message = '';
if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Hapus dari session setelah diambil
}

// Cek cookie remember me untuk mengisi email otomatis
$remembered_email = isset($_COOKIE['admin_email']) ? htmlspecialchars($_COOKIE['admin_email']) : '';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Admin Login</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Literata:opsz,wght@7..72,400..700&family=Plus_Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link rel="stylesheet" href="../../assets/css/admin.css">

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
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col font-body-md overflow-x-hidden">

    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-[10%] -left-[5%] w-[400px] h-[400px] rounded-full bg-primary-fixed/20 blur-3xl animate-float" style="animation-delay: 0s;"></div>
        <div class="absolute top-[40%] -right-[10%] w-[500px] h-[500px] rounded-full bg-surface-container/30 blur-3xl animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute -bottom-[5%] left-[20%] w-[300px] h-[300px] rounded-full bg-secondary-container/20 blur-3xl animate-float" style="animation-delay: -4s;"></div>
    </div>

    <main class="flex-grow flex items-center justify-center px-gutter py-xl">
        <div class="w-full max-w-[440px]">
            
            <header class="text-center mb-xl">
                <div class="inline-flex items-center justify-center p-sm bg-primary-fixed rounded-full mb-md">
                    <span class="material-symbols-outlined text-primary text-[32px]">local_florist</span>
                </div>
                <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Florashop</h1>
                <p class="font-label-md text-label-md text-secondary tracking-widest uppercase">Admin Access Only</p>
            </header>

            <div class="glass-panel border border-outline-variant/30 rounded-xl shadow-[0px_10px_30px_rgba(0,0,0,0.05)] p-xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-primary-container"></div>
                
                <?php if (!empty($error_message)): ?>
                    <div class="mb-4 p-md bg-error-container text-on-error-container text-sm rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                        <span><?php echo htmlspecialchars($error_message); ?></span>
                    </div>
                <?php endif; ?>

                <form action="../../backend/auth/proses_login_admin.php" method="POST" class="space-y-lg">
                    
                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface-variant block px-xs" for="email">Admin Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">mail</span>
                            <input class="w-full pl-[48px] pr-md py-md bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-on-surface transition-all duration-200 hover:border-primary/50 focus:border-primary" id="email" name="email" placeholder="admin@florashop.com" type="email" value="<?php echo $remembered_email; ?>" required/>
                        </div>
                    </div>

                    <div class="space-y-xs">
                        <div class="flex justify-between items-end px-xs">
                            <label class="font-label-md text-label-md text-on-surface-variant block" for="password">Password</label>
                            <a class="font-label-sm text-label-sm text-primary hover:underline transition-all" href="#">Forgot?</a>
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock</span>
                            <input class="w-full pl-[48px] pr-md py-md bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-on-surface transition-all duration-200 hover:border-primary/50 focus:border-primary" id="password" name="password" placeholder="••••••••" type="password" required/>
                            <button class="absolute right-md top-1/2 -translate-y-1/2 text-outline hover:text-secondary transition-colors" onclick="togglePassword()" type="button">
                                <span class="material-symbols-outlined" id="eye-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center space-x-sm px-xs">
                        <input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary/20 transition-all cursor-pointer" id="remember" name="remember" type="checkbox" <?php echo !empty($remembered_email) ? 'checked' : ''; ?>/>
                        <label class="font-label-md text-label-md text-secondary cursor-pointer" for="remember">Stay signed in on this device</label>
                    </div>

                    <button class="w-full bg-primary text-on-primary py-md px-lg rounded-full font-label-md text-label-md shadow-md hover:bg-primary/90 active:scale-95 transition-all duration-200 flex items-center justify-center space-x-sm group" type="submit">
                        <span>Authorize Access</span>
                        <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <div class="mt-xl pt-lg border-t border-outline-variant/30 flex items-center justify-center space-x-md text-outline">
                    <div class="flex items-center space-x-xs">
                        <span class="material-symbols-outlined text-[16px]">verified_user</span>
                        <span class="text-[11px] font-label-sm uppercase tracking-tighter">Secure 256-bit AES</span>
                    </div>
                    <div class="w-1 h-1 bg-outline-variant rounded-full"></div>
                    <div class="flex items-center space-x-xs">
                        <span class="material-symbols-outlined text-[16px]">history</span>
                        <span class="text-[11px] font-label-sm uppercase tracking-tighter">Log Monitored</span>
                    </div>
                </div>
            </div>

            <footer class="mt-lg text-center">
                <p class="font-label-sm text-label-sm text-secondary">
                    © 2024 Florashop Boutique Floral Services. <br class="md:hidden"/>
                    <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a> • 
                    <a class="hover:text-primary transition-colors" href="#">Security Standards</a>
                </p>
            </footer>
        </div>
    </main>

    <div class="hidden lg:block fixed right-0 top-0 bottom-0 w-1/3 p-lg">
        <div class="relative h-full w-full rounded-2xl overflow-hidden shadow-2xl group">
            <img alt="Florashop Admin Environment" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFrps3dN3fbTi6cVDqn6dc-AYgAQdiMLt99LybqEKSxtmvnRFBCbeYsNtYIl3bCDBnuF2KS-BHNzimucNarI-lX-bmkNaHcL3HqtgIVYd-9lX1axukzdhfxZ4HpEyC7SVA31RMW43KJaYfMhDre-haEFExwrZvUBHxwhBGPKHpIM2fyA-sGbeqDLgAYLBsuWek3C8-jg4hCQS1-aBp7sKw14ofT9Otyc603GC9I38xkp6-P7FXluQCd_NtmfBxadGkWAgsu9EBgBs"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
            <div class="absolute bottom-xl left-xl right-xl text-white">
                <blockquote class="font-headline-md text-headline-md mb-sm drop-shadow-md">
                    "Cultivating beauty through organized growth."
                </blockquote>
                <p class="font-label-md text-label-md opacity-90 tracking-wider uppercase">Administrative Portal</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }

        // Focus interaction feedback to wrapper glass-panel
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.closest('.glass-panel').classList.add('shadow-xl');
            });
            input.addEventListener('blur', () => {
                input.closest('.glass-panel').classList.remove('shadow-xl');
            });
        });
    </script>
</body>
</html>