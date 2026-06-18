<?php
// backend/produk/get_detail_produk.php

// Untuk sementara (karena belum ada tabel database untuk produk),
// kita gunakan data statis (dummy) agar halaman UI bisa dirender dan dilihat hasilnya.
$product_data = [
    'id' => 1,
    'name' => 'Blushing Peonies',
    'tag' => 'New',
    'rating' => '4.8',
    'reviews_count' => 124,
    'price' => 45.00,
    'description' => 'Elegant arrangement for special moments. A lush bouquet of soft pink peonies and white ranunculus arranged in a minimalist ceramic vase.',
    'images' => [
        'https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuCAj0XJtAkTco3Vz-bCkJiwtdQkv2u-TNR1emY7hCKTDsdik3dx8DCjhcZkF5J6k7VatG2yr9GuYPxpFB1nn4HMhicyOk3DRKPv3o7K9W9JQhoiItyMK6KuCivIXdV6JJ1Vg_uslqAo4cxpSRjgOZvoQTAeKPlRTFU9muCyu9y2fEhmtSAHPuV68er9Z4D8YJZaYQ7XAqnur-nTuEDZNG2ffLPodQ4SO9VI-arceovVZzYaQt7A5n_nOeglm_Q0S29kUqcXrWQgkgc'
    ],
    'reviews' => [
        [
            'stars' => 5,
            'comment' => 'Absolutely beautiful arrangement! The peonies were so fresh.',
            'initial' => 'SJ',
            'name' => 'Sarah J.'
        ],
        [
            'stars' => 4,
            'comment' => 'Very nice, but the vase was slightly different than pictured.',
            'initial' => 'MK',
            'name' => 'Mike K.'
        ]
    ]
];
?>
