<?php
session_start();

$error = "";

if (isset($_GET['error'])) {
    $error = "Email atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Florashop</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fcf8f9;
        }

        .title {
            font-family: 'Playfair Display', serif;
        }

        .login-card {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>

<!-- Header -->
<header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center">
    <h1 class="title text-3xl text-pink-700">
        Florashop
    </h1>
    <a href="home.php" class="text-pink-700 hover:text-pink-500 transition-colors">
        Beranda
    </a>
</header>

<!-- Login Section -->
<section class="min-h-screen flex items-center justify-center px-6 py-10">

    <div class="max-w-5xl w-full bg-white rounded-3xl overflow-hidden login-card grid md:grid-cols-2">

        <!-- Gambar -->
        <div class="hidden md:block">
            <img
                src="../assets/images/login-flower.png"
                alt="Florashop - Keindahan di Setiap Kelopak"
                class="w-full h-full object-cover"
            />
        </div>

        <!-- Form Login -->
        <div class="p-10">

            <span class="text-pink-500 uppercase tracking-widest text-sm">
                Selamat Datang
            </span>

            <h2 class="title text-4xl text-gray-800 mt-2 mb-8">
                Masuk ke Akun Anda
            </h2>

            <!-- Pesan Error -->
            <?php if ($error != "") : ?>
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="../backend/auth/proses_login.php" method="POST">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        placeholder="contoh@email.com"
                        class="w-full border border-pink-200 rounded-full px-4 py-3 mt-1 focus:outline-none focus:ring-2 focus:ring-pink-300 transition"
                    />
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-1" for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full border border-pink-200 rounded-full px-4 py-3 mt-1 focus:outline-none focus:ring-2 focus:ring-pink-300 transition"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-pink-600 text-white py-3 rounded-full hover:bg-pink-700 active:scale-95 transition-all duration-200 font-medium">
                    Login
                </button>

            </form>

            <p class="mt-6 text-center text-gray-600">
                Belum punya akun?
                <a href="register.php" class="text-pink-600 font-semibold hover:underline">
                    Daftar Sekarang
                </a>
            </p>

        </div>

    </div>

</section>

</body>
</html>
