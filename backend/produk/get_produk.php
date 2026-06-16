<?php
// backend/produk/get_detail_produk.php

// Simulasi data produk dari database berdasarkan ID tertentu
$id_produk = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Mock data (Nantinya bagian ini bisa diganti dengan query SELECT ke MySQL)
$product_data = [
    'id' => 1,
    'name' => 'Pink Rose Bouquet',
    'price' => 59.00,
    'rating' => 4.9,
    'reviews_count' => 128,
    'tag' => 'Bestseller',
    'description' => 'Embrace elegance with our signature "Blushing Grace" bouquet. Hand-selected premium pink roses arranged with seasonal greenery to convey appreciation, grace, and joy. Perfect for anniversaries, birthdays, or just because.',
    'images' => [
        'https://lh3.googleusercontent.com/aida-public/AB6AXuBZAkcB9wd-RHw80dBqPyaW5F0Dp0-psftmF9Mv8ceGkAqGdIMCQ6LJ3vhHAepa5RkTcVSfNO43bIoraPHSOim--A34rfJf3-qMqMz3qdfJ2iqfo6T5jNK_oSWyqOmRCphcpyrd5QhPGuiz-UOnk1U4evJ9OlXZpqc2cN-cgU0ulOQBtcgLXC3H3TogIbo46QxvohBr_gVFqFmeLw0aH41PyO8aSU8HjpmV01ETFIYvgBeBeKWBVgUqu0tmiMdc7YeygWY175lAKUU',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuCdZoqfXGjVR2bQ6-LMRZCgXC4KC6imM9FJcQygwdoFWO55PmFIb478EjBxIlh2mfs1DX1DBJwdlLrpYysnPxvle4gAKnqzHj-R1KobTF5nDmOzvIDuIidDLQXTWxq23xhxIWDwjR-sWkMAT8gNsGSfNGgSU8WOl0f7aY8u22ZP8JPCzAsvIcsVEqie8yDyPjxRakKRE7CpMBq6PpDCeeoUa-KSExBvPqsywHDQDrzlSaYGRx9YZTq2VKYQ09aiB4dc3WjiTBDygtY',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuBLjPHqipRtjKLOcQwEOf_tcg5KAbp-WYN2UxXxB1JLM5jZe2C_KUs0Gsuwn_hkwz2X_8f6FbL-nSEFuaIe5B6dSl2ei2ui18Azjt0ra9lWs254L1ycvh8bCYkM3At5V41hEyJnh2uXwNoddOcXhVgYYAsO8AbxPgJPyJGPgP4x6jVsAv0ngAlybEM6dBJXPL1JvnXPUHPnJIFSnIisbBkUu5qoPh_kFApRemJXrr41azv13AtuVf_O4Nz-eNz6O1C1zDnOaqob1RE',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuCHG76xUq5B76VS3G0-dOC5g6nI46-G0kXz7CQfmaw0tVd-ivlBcBKaTzoKXR6W7_vlW9r5M35Iulvd3GYpBKQZ7W52wTd7dSYaC9QPqNnUU7S2nCD953HxdyJtF7TKhKCczfOHfK-LRXl9ff5kdb25vnRPiDkEmfsIPKNN2HoC_b-FRdjvbyIAl_36u5SN-MeazNGOWrq1joEaq_51GQLtrEiP3C83gcvBmI_6-lKe41ObXWi_sy1ys6Ii9uWwCclg13ohgLJ0H4M'
    ],
    'reviews' => [
        [
            'initial' => 'ES',
            'name' => 'Eleanor S.',
            'stars' => 5,
            'comment' => '"The most beautiful roses I\'ve ever ordered. They arrived in perfect condition and stayed fresh for nearly two weeks!"'
        ],
        [
            'initial' => 'JM',
            'name' => 'James M.',
            'stars' => 5,
            'comment' => '"My wife was stunned by the arrangement. The scent is heavenly and filled the whole room. Highly recommended."'
        ],
        [
            'initial' => 'CL',
            'name' => 'Clara L.',
            'stars' => 4,
            'comment' => '"Very easy checkout process and quick delivery. The bouquet was exactly as pictured on the website."'
        ]
    ]
];