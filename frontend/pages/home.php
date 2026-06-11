<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Florist Bloom | Artisan Botanical Gifting</title>
  <meta name="description" content="Meticulously curated blooms that speak the language of the heart. Artisan floristry delivered from boutique ateliers to your doorstep."/>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "surface-container": "#e7f1e5",
            "surface-variant": "#dbe5d9",
            "on-surface": "#151e16",
            "on-tertiary": "#ffffff",
            "tertiary": "#5f5e5a",
            "inverse-on-surface": "#eaf4e7",
            "tertiary-container": "#b5b3ae",
            "on-surface-variant": "#504444",
            "secondary-fixed": "#d5e8cb",
            "inverse-primary": "#eebaba",
            "tertiary-fixed": "#e5e2dc",
            "surface-tint": "#7c5454",
            "on-primary-fixed-variant": "#623d3d",
            "surface-container-high": "#e1ebdf",
            "on-secondary": "#ffffff",
            "secondary": "#52634c",
            "surface-container-lowest": "#ffffff",
            "on-primary-fixed": "#301314",
            "on-tertiary-container": "#464541",
            "on-secondary-container": "#566750",
            "secondary-container": "#d2e5c8",
            "primary-fixed-dim": "#eebaba",
            "outline": "#837473",
            "primary-container": "#d9a7a7",
            "surface-container-low": "#ecf6ea",
            "surface-container-highest": "#dbe5d9",
            "error": "#ba1a1a",
            "tertiary-fixed-dim": "#c9c6c1",
            "on-primary": "#ffffff",
            "outline-variant": "#d4c2c2",
            "on-secondary-fixed": "#101f0d",
            "on-tertiary-fixed": "#1c1c18",
            "surface": "#f2fcf0",
            "inverse-surface": "#2a332b",
            "primary-fixed": "#ffdad9",
            "on-tertiary-fixed-variant": "#474743",
            "surface-dim": "#d3ddd1",
            "error-container": "#ffdad6",
            "on-secondary-fixed-variant": "#3b4b36",
            "primary": "#7c5454",
            "on-primary-container": "#603b3c",
            "on-error-container": "#93000a",
            "on-error": "#ffffff",
            "background": "#f2fcf0",
            "surface-bright": "#f2fcf0",
            "on-background": "#151e16",
            "secondary-fixed-dim": "#b9ccb0"
          },
          "borderRadius": {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
          "spacing": {
            "margin-mobile": "20px",
            "stack-md": "32px",
            "margin-desktop": "64px",
            "base": "8px",
            "container-max": "1280px",
            "stack-sm": "16px",
            "stack-lg": "64px",
            "gutter": "24px"
          },
          "fontFamily": {
            "display-lg-mobile": ["EB Garamond"],
            "body-md": ["Plus Jakarta Sans"],
            "label-sm": ["Plus Jakarta Sans"],
            "headline-lg": ["EB Garamond"],
            "body-lg": ["Plus Jakarta Sans"],
            "label-lg": ["Plus Jakarta Sans"],
            "headline-md": ["EB Garamond"],
            "display-lg": ["EB Garamond"]
          },
          "fontSize": {
            "display-lg-mobile": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.01em", "fontWeight": "500"}],
            "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
            "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
            "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "500"}],
            "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
            "label-lg": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
            "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "500"}],
            "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "500"}]
          }
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .hero-gradient {
      background: linear-gradient(to bottom, rgba(242, 252, 240, 0.4), rgba(242, 252, 240, 0.9));
    }
    .card-hover-shadow {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover-shadow:hover {
      box-shadow: 0 20px 40px -10px rgba(139, 157, 131, 0.15);
      transform: translateY(-4px);
    }
  </style>
</head>
<body class="bg-surface font-body-md text-on-surface">

<!-- TopNavBar -->
<header class="bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md sticky top-0 z-50 transition-all duration-300">
  <nav class="flex justify-between items-center px-margin-mobile md:px-margin-desktop h-20 max-w-container-max mx-auto">
    <div class="flex items-center gap-stack-md">
      <span class="font-headline-md text-headline-md font-medium text-primary dark:text-primary-fixed-dim">Florist Bloom</span>
      <div class="hidden md:flex gap-base">
        <a class="font-label-lg text-label-lg text-secondary dark:text-secondary-fixed hover:text-primary transition-colors duration-300" href="katalog.php">Shop All</a>
        <a class="font-label-lg text-label-lg text-secondary dark:text-secondary-fixed hover:text-primary transition-colors duration-300" href="katalog.php">Occasions</a>
        <a class="font-label-lg text-label-lg text-secondary dark:text-secondary-fixed hover:text-primary transition-colors duration-300" href="#">Subscription</a>
        <a class="font-label-lg text-label-lg text-secondary dark:text-secondary-fixed hover:text-primary transition-colors duration-300" href="#">About</a>
      </div>
    </div>
    <div class="flex items-center gap-stack-sm">
      <div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/30">
        <span class="material-symbols-outlined text-secondary text-[20px]">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-label-sm font-label-sm text-on-surface-variant w-40" placeholder="Search bouquets..." type="text"/>
      </div>
      <button class="material-symbols-outlined text-primary hover:opacity-80 transition-opacity p-2" aria-label="Wishlist">favorite</button>
      <a href="keranjang.php" class="material-symbols-outlined text-primary hover:opacity-80 transition-opacity p-2" aria-label="Shopping Cart">shopping_cart</a>
      <button id="mobile-menu-btn" class="md:hidden material-symbols-outlined text-primary p-2" aria-label="Open Menu">menu</button>
    </div>
  </nav>
  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-surface border-t border-outline-variant/20 px-margin-mobile py-4 space-y-3">
    <a class="block font-label-lg text-label-lg text-secondary hover:text-primary transition-colors" href="katalog.php">Shop All</a>
    <a class="block font-label-lg text-label-lg text-secondary hover:text-primary transition-colors" href="katalog.php">Occasions</a>
    <a class="block font-label-lg text-label-lg text-secondary hover:text-primary transition-colors" href="#">Subscription</a>
    <a class="block font-label-lg text-label-lg text-secondary hover:text-primary transition-colors" href="#">About</a>
  </div>
</header>

<main>
  <!-- Hero Section -->
  <section class="relative min-h-[870px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img
        class="w-full h-full object-cover"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuALjsnV7wGPqznWR-hWRhGb_pc3skFoE11V4ieK2lFAFFXQX-szy83eBuEL78pmzU1dJNXyvjQ1MHNmP0aHV4jD-eO_ZNLWQGOzHDzFT2oyy3leaJ4MkpJgIVrjibPkXOqsF6sH4-K6pTltVXTMmItDE5OLsCqb0fJFSnyQZILg0v8AB6u6cAURdWylaADgHsikFyLo95VChU-7GGjGNZmlhvxp1YDvlHR2iKBXq6_ut-NPl5sKscvr5E698bPA_-EIvU-eb5tS2E4"
        alt="A sprawling, romantic floral arrangement featuring dusty pink roses, white ranunculus, and delicate eucalyptus leaves."
      />
      <div class="absolute inset-0 hero-gradient"></div>
    </div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto w-full">
      <div class="max-w-2xl space-y-stack-md">
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary leading-tight">
          Artisan Floristry for <br/><i class="italic font-serif">Poetic Moments</i>
        </h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-lg">
          Meticulously curated blooms that speak the language of the heart. From boutique ateliers to your doorstep, we craft emotions in petals.
        </p>
        <div class="flex flex-wrap gap-base pt-stack-sm">
          <a href="katalog.php" class="bg-secondary text-surface px-8 py-4 rounded-full font-label-lg text-label-lg hover:opacity-90 active:scale-95 transition-all duration-200">Shop The Collection</a>
          <button class="border border-primary text-primary px-8 py-4 rounded-full font-label-lg text-label-lg hover:bg-primary/5 active:scale-95 transition-all duration-200">Our Story</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Bouquets Section -->
  <section class="py-stack-lg px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-end mb-stack-lg gap-base">
      <div class="space-y-base">
        <span class="font-label-lg text-label-lg text-primary tracking-[0.2em] uppercase">The Seasonal Edit</span>
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Curated Collections</h2>
      </div>
      <a class="text-primary font-label-lg text-label-lg border-b border-primary/30 hover:border-primary transition-colors pb-1" href="katalog.php">View All Bouquets</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">

      <!-- Product Card 1 -->
      <div class="card-hover-shadow group cursor-pointer flex flex-col bg-surface rounded-xl overflow-hidden">
        <div class="aspect-[4/5] overflow-hidden">
          <img
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpNzfIOxLrPWNEKMl2S0l6ys4Y5Lz_0mUds_jzSbsrd3jR9sRAvNzpKukGNfX_q11ulGq0iraZ_gxxY4_9QgNIrwNla30hwa3kOwBDzObstRyi_-1jGxouSzGeDKXRXn2AeuQk9fzsaRjuA-7-cBYs4NRCpl7c5BlCSMUlGr0k7gsn5gtw05wIdQ1MB09wESM6BZ6vNbTTfCoLAVOTc9Q5ZJVygGVFL6j4gaplmkSRAZM_irAR9BO53I4HwCDnc2ic2oZx4D0HRF0"
            alt="A premium boutique bouquet featuring creamy white peonies and delicate sage green foliage."
          />
        </div>
        <div class="p-6 text-center space-y-2">
          <h3 class="font-headline-md text-headline-md text-on-surface">Ethereal Grace</h3>
          <p class="font-label-lg text-label-lg text-secondary">Peonies &amp; Eucalyptus</p>
          <p class="font-body-md text-body-md text-primary font-bold pt-2">$85.00</p>
        </div>
      </div>

      <!-- Product Card 2 -->
      <div class="card-hover-shadow group cursor-pointer flex flex-col bg-surface rounded-xl overflow-hidden">
        <div class="aspect-[4/5] overflow-hidden">
          <img
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDn_vpyMc60fWD6ZOPAg7_V_YK2-YcJn20gDL_5jrMpP7ugdLwfrHEMUqp5bE_4nE0ydK58sKVzx_QzevdDmcvTRf5HdLUsRsHeHI-WyEuZ9DYtS8kVhL7OQfPUVROF4t45QR3osIcML0ZF7iCGa3GFGyGrkChpxBMK0NyKAv5t_KjU95F6zjhLszpeWYn9UrkQ0-UAAFK-09AnkJBhWBT8ygOUJVyEkAN_y6PsVElohfyZgL4WyVOgmsAkyfL17VdPBr8OM-Sf5Lk"
            alt="An elegant arrangement of blush pink roses and wild garden flowers in a simple ceramic vase."
          />
        </div>
        <div class="p-6 text-center space-y-2">
          <h3 class="font-headline-md text-headline-md text-on-surface">Midnight Blush</h3>
          <p class="font-label-lg text-label-lg text-secondary">Garden Roses &amp; Ferns</p>
          <p class="font-body-md text-body-md text-primary font-bold pt-2">$92.00</p>
        </div>
      </div>

      <!-- Product Card 3 -->
      <div class="card-hover-shadow group cursor-pointer flex flex-col bg-surface rounded-xl overflow-hidden">
        <div class="aspect-[4/5] overflow-hidden">
          <img
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCK3DgvUzW0DowTMYISVfbYVTAZJn-gPsKpWri_2wDmoN1jXeNMe9OKrVcH8Okeiqn1qyuiDdJEDEMWGmmKlqLohQs1F8gqWThXbKRs0JHne8RgUO3HjBWZ789QE-n2GxRkhjeehp02hPyxlUejUY1kn6dLt9D2-jz_wtYMi4Or3dK8livWN6_pNhesDj9NzMpyx9YrScS4aoXCbokqn19Zx9BjV1xIzg-saWPHJZpoc5WgTsVpqfKajvRZRDe-rORevdmHWuGePc4"
            alt="A sophisticated floral arrangement of deep burgundy and cream blooms, including anemones and hellebores."
          />
        </div>
        <div class="p-6 text-center space-y-2">
          <h3 class="font-headline-md text-headline-md text-on-surface">Antique Velvet</h3>
          <p class="font-label-lg text-label-lg text-secondary">Anemones &amp; Berries</p>
          <p class="font-body-md text-body-md text-primary font-bold pt-2">$78.00</p>
        </div>
      </div>

    </div>
  </section>

  <!-- Shop by Occasion - Bento Style -->
  <section class="bg-surface-container py-stack-lg overflow-hidden">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
      <div class="text-center mb-stack-lg space-y-base">
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Occasions to Celebrate</h2>
        <p class="font-body-md text-body-md text-secondary max-w-lg mx-auto">Thoughtful designs tailored for life's most meaningful chapters.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter h-auto md:h-[600px]">

        <div class="md:col-span-2 group relative overflow-hidden rounded-xl cursor-pointer">
          <img
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjh0VQ0ow1WthvABcZNQw-N-yZrXy-e2ieAES-hE5NjkP0W74prL3Svu5U1XAGCT7bcogyn1Ql-owxw83UyI_x5GnfBzaxgWr0D1rBAtZ1-4gIkg5YQoUNs85B65kQw7hVx5vBBPdYRL9ArIfQeFXLHhaXOn5lkUaMIHeCmi-RVNAZyL09kYxcf2DeJYS63VdvPpP3dhnrdkaMSbqTgsrkrTyZcTqvypcMvy7xNiGAC9Ian-weqEW8-0r-x-SCHNhcdVFRUO6pQ28"
            alt="A celebratory, bright floral arrangement designed for a birthday."
          />
          <div class="absolute inset-0 bg-on-surface/20 flex flex-col justify-end p-8">
            <h4 class="font-headline-md text-headline-md text-surface">Birthday</h4>
            <p class="text-surface-variant font-label-lg">Celebrate their vibrant life</p>
          </div>
        </div>

        <div class="group relative overflow-hidden rounded-xl cursor-pointer">
          <img
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuhq6DPPDZfW5p7G2wxSK81Fe1L8Vm_rOd3zigcsKgC8KbMf_QXyQpl3hbGndWtXlwf-MkzBtMQkytTZpgLu4aecd2NpeBV7oNIGcQjXLsS-AbQ-Sw3reyJTCBiaUL9i3pX7SzqHeoi6SxFmoXombWDoC0Gbcb4u5Dj27weii7y4nF-WmLRIjTpM87Ej75XBz0zqnP22xETgtBe6xKe4ayjotXohmK4Hys20VZfnVkG9jfqkIAC9KvRXDHpfqedkoXAb96dViCWZk"
            alt="Two hands holding a delicate bouquet symbolizing an anniversary."
          />
          <div class="absolute inset-0 bg-on-surface/20 flex flex-col justify-end p-8">
            <h4 class="font-headline-md text-headline-md text-surface">Anniversary</h4>
          </div>
        </div>

        <div class="group relative overflow-hidden rounded-xl cursor-pointer">
          <img
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaLS3P2lpApJq8BLq3HTfawELm-huq9xLBaGTWc3F6TZWq-1XhtQoGllYBKyp0RyvWJMwQs3g8JY-u-AeKzanph2PlO-E2G1hIufZVUgOGBrDoXb4HdIj-smW2wsoD2I7mQ7OZGZmgNo_QA2W29Nrt4WM7jXRb1Mz3zzaXHVBRscdlC-_xVQywhAzGsoAMzxxB39KkC5Xsim8PX451Tch7LJk9cvnyiEOqaFvKEMcsLqhLLf-L3oYhdg9n273bHFak6BLAdVzLtlQ"
            alt="An ethereal wedding bouquet of pure white roses and cascading greenery."
          />
          <div class="absolute inset-0 bg-on-surface/20 flex flex-col justify-end p-8">
            <h4 class="font-headline-md text-headline-md text-surface">Wedding</h4>
          </div>
        </div>

        <div class="md:col-span-4 flex justify-center mt-stack-md">
          <button class="bg-surface-container-highest text-primary border border-primary/20 px-10 py-3 rounded-full font-label-lg hover:bg-surface-container transition-colors">See All Occasions</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us -->
  <section class="py-stack-lg px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
      <div class="space-y-base p-stack-sm">
        <div class="w-16 h-16 bg-surface-container mx-auto rounded-full flex items-center justify-center mb-base">
          <span class="material-symbols-outlined text-primary text-3xl">eco</span>
        </div>
        <h4 class="font-headline-md text-headline-md text-on-surface">Sustainable Roots</h4>
        <p class="font-body-md text-body-md text-secondary">We partner with ethical growers who prioritize the earth as much as the bloom.</p>
      </div>
      <div class="space-y-base p-stack-sm">
        <div class="w-16 h-16 bg-surface-container mx-auto rounded-full flex items-center justify-center mb-base">
          <span class="material-symbols-outlined text-primary text-3xl">brush</span>
        </div>
        <h4 class="font-headline-md text-headline-md text-on-surface">Artisan Design</h4>
        <p class="font-body-md text-body-md text-secondary">Every bouquet is a unique masterpiece, hand-tied by our master florists.</p>
      </div>
      <div class="space-y-base p-stack-sm">
        <div class="w-16 h-16 bg-surface-container mx-auto rounded-full flex items-center justify-center mb-base">
          <span class="material-symbols-outlined text-primary text-3xl">local_shipping</span>
        </div>
        <h4 class="font-headline-md text-headline-md text-on-surface">Same-Day Love</h4>
        <p class="font-body-md text-body-md text-secondary">Express delivery in chilled packaging ensures freshness from barn to bedside.</p>
      </div>
    </div>
  </section>

  <!-- Newsletter Subscription Block -->
  <section class="py-stack-lg">
    <div class="bg-primary/5 mx-margin-mobile md:mx-margin-desktop rounded-3xl p-stack-lg text-center space-y-stack-md border border-primary/10">
      <div class="max-w-2xl mx-auto space-y-base">
        <h2 class="font-headline-lg text-headline-lg text-primary">Join Our Botanical Circle</h2>
        <p class="font-body-md text-body-md text-secondary">Receive seasonal inspiration, flower care tips, and exclusive early access to our limited-run collections.</p>
      </div>
      <form id="newsletter-form" class="max-w-md mx-auto flex flex-col md:flex-row gap-base">
        <input class="flex-grow bg-surface border-none rounded-full px-6 py-4 focus:ring-1 focus:ring-primary text-body-md" placeholder="Enter your email address" type="email" required/>
        <button id="subscribe-btn" class="bg-primary text-on-primary px-8 py-4 rounded-full font-label-lg transition-all hover:bg-primary/90 active:scale-95" type="submit">Subscribe</button>
      </form>
      <p class="font-label-sm text-label-sm text-tertiary">Respecting your privacy is part of our bloom promise.</p>
    </div>
  </section>
</main>

<!-- Footer -->
<footer class="bg-surface-container dark:bg-surface-container-highest py-stack-lg border-t border-outline-variant/10">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="space-y-base col-span-1 md:col-span-1">
      <span class="font-headline-md text-headline-md text-primary">Florist Bloom</span>
      <p class="font-body-md text-body-md text-secondary mt-stack-sm leading-relaxed">
        Elevating the art of gifting through conscious curation and botanical mastery.
      </p>
      <div class="flex gap-4 pt-base">
        <span class="material-symbols-outlined text-secondary cursor-pointer hover:text-primary transition-colors">public</span>
        <span class="material-symbols-outlined text-secondary cursor-pointer hover:text-primary transition-colors">alternate_email</span>
        <span class="material-symbols-outlined text-secondary cursor-pointer hover:text-primary transition-colors">share</span>
      </div>
    </div>
    <div class="space-y-base">
      <h5 class="font-label-lg text-label-lg text-on-surface uppercase tracking-wider">Navigation</h5>
      <ul class="space-y-2">
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="katalog.php">Shop All</a></li>
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Subscription</a></li>
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Care Guide</a></li>
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Journal</a></li>
      </ul>
    </div>
    <div class="space-y-base">
      <h5 class="font-label-lg text-label-lg text-on-surface uppercase tracking-wider">Help</h5>
      <ul class="space-y-2">
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Contact Us</a></li>
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Shipping Info</a></li>
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Returns</a></li>
        <li><a class="text-secondary hover:text-primary transition-all duration-200 hover:underline" href="#">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="space-y-base">
      <h5 class="font-label-lg text-label-lg text-on-surface uppercase tracking-wider">Visit Us</h5>
      <p class="text-secondary">42 Botanical Row<br/>Greenwich, London SE10</p>
      <p class="text-secondary mt-2">Mon - Sat: 9am - 6pm</p>
    </div>
  </div>
  <div class="mt-stack-lg pt-stack-sm border-t border-outline-variant/20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center md:text-left">
    <span class="font-body-md text-body-md text-on-surface dark:text-on-surface-variant opacity-70">© 2024 Florist Bloom. Crafted with love.</span>
  </div>
</footer>

<script>
  // Scroll micro-interaction for sticky header
  window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
      header.classList.add('shadow-sm', 'h-16');
      header.classList.remove('h-20');
    } else {
      header.classList.remove('shadow-sm', 'h-16');
      header.classList.add('h-20');
    }
  });

  // Mobile menu toggle
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    const isOpen = !mobileMenu.classList.contains('hidden');
    mobileMenuBtn.textContent = isOpen ? 'close' : 'menu';
  });

  // Newsletter form submission
  document.getElementById('newsletter-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = document.getElementById('subscribe-btn');
    const originalText = btn.innerText;
    btn.innerText = 'Subscribed! ✓';
    btn.classList.add('bg-secondary');
    btn.disabled = true;
    setTimeout(() => {
      btn.innerText = originalText;
      btn.classList.remove('bg-secondary');
      btn.disabled = false;
      e.target.reset();
    }, 2000);
  });
</script>

</body>
</html>