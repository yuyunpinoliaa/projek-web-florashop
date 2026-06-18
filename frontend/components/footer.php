<?php
// frontend/includes/footer.php
?>
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
            if (window.scrollY > 20) {
                header.classList.add('shadow-sm');
                header.style.backgroundColor = 'rgba(248, 249, 255, 0.95)';
            } else {
                header.classList.remove('shadow-sm');
                header.style.backgroundColor = 'rgba(248, 249, 255, 0.8)';
            }
        });
    </script>
</body>
</html>