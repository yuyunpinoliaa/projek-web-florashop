<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Florashop - Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/auth.css">
    
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
<body class="bg-background text-on-surface font-body-md text-body-md overflow-x-hidden min-h-screen">
    <!-- Global Layout Shell -->
    <main class="relative min-h-screen flex items-center justify-center px-md py-xl overflow-hidden">
        
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-fixed opacity-20 rounded-full blur-[100px]"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-tertiary-fixed opacity-10 rounded-full blur-[100px]"></div>
            
            <div class="absolute top-10 right-10 opacity-20 flower-float">
                <img alt="Floral illustration" class="w-48 h-48 object-cover rounded-full rotate-12" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxaIRodT7bM9K2ppLDjxOnwbWtJTtnBZWcNtZpL-An6uyjW4-eVuwONlbDO15fsiUQvDcZHKJ7H-Bfj9F7lpWH1816frUsZXwZq1KLW4Y1dvGa4yGhvtq8Uglyg_3AwU6ZOjDlPKS3KffAqrlUpwYUPr5I1WmczcgP1KYybOtSh0SOAlkxcxy6mUMEPXCsFxBL7fO4nSCXeUgnnVoICsfVZM1fXAD6czkwuKuG13bqTgL_m0vB_Xfu6ixrwUSar6zRd-ACmJ8vBWg"/>
            </div>
            <div class="absolute bottom-20 left-10 opacity-15 flower-float" style="animation-delay: -2s;">
                <img alt="Floral illustration" class="w-40 h-40 object-cover rounded-full -rotate-45" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkvtkD4qxxv-7_stuy04PtIP4wYJiigoE1Ja32xEShNU007gfwRbV9Io1psjed_w8qpaRI9Uy8LxDpdZSkmXpne1o3Hs9z3oehAwxzMRdd-fEk1BVBHe8iz_JwZIhtQVgr-kvATl3S_84mGO7faEEud87wV7YC4DIYHbkiOUU-zrDGpd_yJFRz-cKXsGggUAR5DksFhDj4nEMO2wEq3nE1nx56aWgmwHVGvtUK06w7ro4oSofBPgSjokDEDw2FdViyEmKhSo7UzN4"/>
            </div>
        </div>

        <!-- Auth Card Container -->
        <div class="relative z-10 w-full max-w-[440px] fade-in">
            <div class="glass-panel rounded-[32px] p-xl shadow-[0px_4px_20px_rgba(244,114,182,0.08)] border border-white/40">
                
                <!-- Brand Header -->
                <div class="flex flex-col items-center mb-xl">
                    <div class="w-16 h-16 bg-primary-fixed rounded-full flex items-center justify-center mb-md shadow-sm">
                        <span class="material-symbols-outlined text-primary text-[32px]">local_florist</span>
                    </div>
                    <h1 class="font-headline-lg-mobile text-[28px] md:font-headline-lg md:text-[32px] font-semibold text-primary">Florashop</h1>
                    <p class="text-secondary font-label-md mt-xs">Curating moments of beauty</p>
                </div>

                <!-- Tab Toggle -->
                <div class="flex p-xs bg-secondary-fixed/30 rounded-full mb-xl">
                    <button class="flex-1 py-sm px-md rounded-full font-label-md transition-all duration-300 bg-white text-primary shadow-sm">Sign In</button>
                    <a href="register.php" class="flex-1 py-sm px-md rounded-full font-label-md transition-all duration-300 text-secondary hover:text-primary text-center">Create Account</a>
                </div>

                <!-- Login Form -->
                <form class="space-y-lg" action="../../backend/auth/proses_login.php" method="POST">
                    <div class="space-y-sm">
                        <label class="font-label-md text-secondary ml-xs" for="email">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
                            <input class="w-full pl-[48px] pr-md py-md bg-white/50 border border-outline-variant/40 rounded-xl focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all placeholder:text-outline/50" id="email" name="email" placeholder="hello@example.com" type="email" required/>
                        </div>
                    </div>

                    <div class="space-y-sm">
                        <div class="flex justify-between items-center px-xs">
                            <label class="font-label-md text-secondary" for="password">Password</label>
                            <a class="text-primary font-label-sm hover:underline" href="#">Forgot?</a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
                            <input class="w-full pl-[48px] pr-[48px] py-md bg-white/50 border border-outline-variant/40 rounded-xl focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all placeholder:text-outline/50" id="password" name="password" placeholder="••••••••" type="password" required/>
                        </div>
                    </div>

                    <div class="flex items-center space-x-sm px-xs mt-4">
                        <input class="w-4 h-4 rounded text-primary border-outline focus:ring-primary-container" id="remember" type="checkbox"/>
                        <label class="font-label-sm text-secondary" for="remember">Remember me for 30 days</label>
                    </div>

                    <button class="w-full py-md mt-6 bg-primary text-on-primary font-label-md rounded-full shadow-lg hover:bg-on-primary-fixed-variant active:scale-[0.98] transition-all transform duration-200" type="submit">
                        Sign In
                    </button>
                </form>

                <!-- Social Auth -->
                <div class="mt-xl">
                    <div class="relative flex items-center justify-center mb-lg">
                        <div class="w-full border-t border-outline-variant/30"></div>
                        <span class="bg-white/70 backdrop-blur-sm px-md text-secondary font-label-sm absolute">Or continue with</span>
                    </div>
                    <div class="grid grid-cols-2 gap-md">
                        <button class="flex items-center justify-center space-x-sm py-sm border border-outline-variant/40 rounded-full bg-white/50 hover:bg-white hover:shadow-sm transition-all duration-200">
                            <img alt="Google" class="w-4 h-4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnY4ItYU_uGljlP3uQQWFPDSFyFXN6XWH9T_5RiLyYNAmC9f7SGuAKjpbl-TweeE5gqA47Z_aWqlDYPMNiR6mN7poYzJNRe3v-sas5KoJ7H1r_i_yla8kMOg0tx9bTswmFQgleROd_6yc8qRfMg-m1Mv3uy0qwsE1IGyhiDYDd2h7dns3tyjCzh6e1KC10Fr0o_CSBPLXnc-UEs5Qugk9DvAlEwi9JD2JckPqu22ruIFF96vopnGMuLCVucmVfJKY7teU2bQzTlfI"/>
                            <span class="font-label-md text-secondary">Google</span>
                        </button>
                        <button class="flex items-center justify-center space-x-sm py-sm border border-outline-variant/40 rounded-full bg-white/50 hover:bg-white hover:shadow-sm transition-all duration-200">
                            <span class="material-symbols-outlined text-[20px] text-[#1877F2]">face_nod</span>
                            <span class="font-label-md text-secondary">Facebook</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bottom Support Text -->
            <p class="text-center mt-xl text-secondary font-label-md">
                Need help? <a class="text-primary font-semibold hover:underline" href="#">Contact Florist Support</a>
            </p>
        </div>
    </main>
</body>
</html>
