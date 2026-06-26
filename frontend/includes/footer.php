<!-- Bottom Navigation Bar -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-surface/80 backdrop-blur-md border-t border-outline-variant/30 rounded-t-xl shadow-[0px_-4px_20px_rgba(244,114,182,0.08)]">
<a class="flex flex-col items-center justify-center bg-primary-container/20 text-primary rounded-full px-4 py-1 active:scale-[0.98] transition-all" href="home.php">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-label-md text-label-md">Home</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="katalog.php">
<span class="material-symbols-outlined" data-icon="local_florist">local_florist</span>
<span class="font-label-md text-label-md">Catalog</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="keranjang.php">
<span class="material-symbols-outlined" data-icon="shopping_cart">shopping_cart</span>
<span class="font-label-md text-label-md">Cart</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="login_admin.php">
<span class="material-symbols-outlined" data-icon="admin_panel_settings">admin_panel_settings</span>
<span class="font-label-md text-label-md">Admin</span>
</a>

</nav>
<!-- Floating Action Button: Search or Add -->
<button class="fixed right-6 bottom-24 w-14 h-14 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-40">
<span class="material-symbols-outlined text-[28px]" data-icon="add">add</span>
</button>
<script>
        // Micro-interactions and subtle effects
        document.querySelectorAll('a, button').forEach(el => {
            el.addEventListener('touchstart', () => {
                el.style.opacity = '0.7';
            });
            el.addEventListener('touchend', () => {
                el.style.opacity = '1';
            });
        });

        // Sticky header opacity change on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (header) {
                if (window.scrollY > 20) {
                    header.classList.add('shadow-sm');
                    header.style.backgroundColor = 'rgba(248, 249, 255, 0.95)';
                } else {
                    header.classList.remove('shadow-sm');
                    header.style.backgroundColor = 'rgba(248, 249, 255, 0.8)';
                }
            }
        });
    </script>
</body></html>
