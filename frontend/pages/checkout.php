<?php
session_start();

$total = 0;

if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['harga'] * $item['qty'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $metode = $_POST['metode'];

    unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Poppins,sans-serif;
        }

        body{
            background:#EAF4FF;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .success-card{
            background:white;
            padding:40px;
            width:500px;
            border-radius:20px;
            text-align:center;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        h2{
            color:#4A6FA5;
            margin-bottom:20px;
        }

        p{
            margin:10px 0;
            color:#555;
        }

        .btn-home{
            display:inline-block;
            margin-top:20px;
            background:#6FA8DC;
            color:white;
            padding:12px 25px;
            border-radius:12px;
            text-decoration:none;
        }

    </style>

</head>
<body>

<div class="success-card">

    <h2>🎉 Pesanan Berhasil!</h2>

    <p><b>Nama:</b> <?= $nama ?></p>
    <p><b>Alamat:</b> <?= $alamat ?></p>
    <p><b>Metode Pembayaran:</b> <?= $metode ?></p>
    <p><b>Total Bayar:</b> Rp <?= number_format($total) ?></p>

    <a href="home.php" class="btn-home">
        Kembali ke Home
    </a>

</div>

</body>
</html>

<?php
exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Florashop</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Poppins,sans-serif;
        }

        body{
            background:#EAF4FF;
            padding:40px;
        }

        .container{
            max-width:700px;
            margin:auto;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            color:#4A6FA5;
            margin-bottom:25px;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:8px;
            color:#4A6FA5;
            font-weight:600;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:12px;
            border:2px solid #CFE8FF;
            border-radius:10px;
            outline:none;
        }

        textarea{
            resize:none;
            height:100px;
        }

        .total{
            margin-top:25px;
            text-align:center;
            color:#4A6FA5;
        }

        button{
            width:100%;
            margin-top:20px;
            background:#6FA8DC;
            color:white;
            border:none;
            padding:14px;
            border-radius:12px;
            cursor:pointer;
            font-size:16px;
        }

        button:hover{
            opacity:0.9;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <h2>💐 Checkout Florashop</h2>

        <form method="POST">

            <label>Nama Penerima</label>
            <input type="text" name="nama" required>

            <label>Alamat Pengiriman</label>
            <textarea name="alamat" required></textarea>

            <label>Metode Pembayaran</label>
            <select name="metode">
                <option>Transfer Bank</option>
                <option>E-Wallet</option>
                <option>COD</option>
            </select>

            <div class="total">
                <h3>Total Bayar</h3>
                <h2>Rp <?= number_format($total) ?></h2>
            </div>

            <button type="submit">
                💙 Buat Pesanan
            </button>

        </form>

    </div>

</div>

</body>
</html>