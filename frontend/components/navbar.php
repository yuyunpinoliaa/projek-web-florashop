<?php
// frontend/includes/navbar.php
?>
<header class="bg-surface/80 backdrop-blur-md sticky top-0 z-50 flex justify-between items-center w-full px-md py-sm transition-all duration-300">
    <div class="flex items-center gap-4">
        <button class="material-symbols-outlined text-primary hover:bg-primary/5 transition-colors p-2 rounded-full active:scale-95 duration-200" data-icon="search">search</button>
    </div>
    <h1 class="font-headline-lg-mobile text-headline-lg-mobile text-primary tracking-tight">Florashop</h1>
    <div class="flex items-center gap-4">
        <button class="material-symbols-outlined text-primary hover:bg-primary/5 transition-colors p-2 rounded-full active:scale-95 duration-200" data-icon="notifications">notifications</button>
    </div>
</header>

<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe pt-2 bg-surface/80 backdrop-blur-md border-t border-outline-variant/30 rounded-t-xl shadow-[0px_-4px_20px_rgba(244,114,182,0.08)]">
    <a class="flex flex-col items-center justify-center bg-primary-container/20 text-primary rounded-full px-4 py-1 active:scale-[0.98] transition-all" href="#">
        <span class="material-symbols-outlined" data-icon="home">home</span>
        <span class="font-label-md text-label-md">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="#">
        <span class="material-symbols-outlined" data-icon="local_florist">local_florist</span>
        <span class="font-label-md text-label-md">Catalog</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="#">
        <span class="material-symbols-outlined" data-icon="shopping_cart">shopping_cart</span>
        <span class="font-label-md text-label-md">Cart</span>
    </a>
    <a class="flex flex-col items-center justify-center text-secondary px-4 py-1 hover:text-primary transition-all active:scale-[0.98]" href="#">
        <span class="material-symbols-outlined" data-icon="person">person</span>
        <span class="font-label-md text-label-md">Profile</span>
    </a>
</nav>

<button class="fixed right-6 bottom-24 w-14 h-14 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-40">
    <span class="material-symbols-outlined text-[28px]" data-icon="add">add</span>
</button>