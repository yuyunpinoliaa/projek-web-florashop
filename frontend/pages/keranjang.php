<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Florashop</title>

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

        h2{
            text-align:center;
            color:#4A6FA5;
            margin-bottom:30px;
        }

        .container{
            max-width:1000px;
            margin:auto;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#CFE8FF;
            color:#4A6FA5;
            padding:15px;
        }

        td{
            padding:15px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }

        .hapus{
            background:#ffb6c1;
            color:white;
            padding:8px 15px;
            border-radius:8px;
            text-decoration:none;
        }

        .hapus:hover{
            opacity:0.8;
        }

        .total-row{
            font-weight:bold;
            color:#4A6FA5;
        }

        .checkout{
            margin-top:25px;
            text-align:right;
        }

        .checkout button{
            background:#6FA8DC;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:12px;
            cursor:pointer;
            font-size:16px;
        }

        .checkout button:hover{
            opacity:0.9;
        }

        .kosong{
            text-align:center;
            color:#4A6FA5;
            padding:30px;
        }

    </style>

</head>
<body>

<div class="container">

    <h2>🛒 Keranjang Belanja Florashop</h2>

    <div class="card">

        <?php if(empty($_SESSION['cart'])) { ?>

            <div class="kosong">
                🌸 Keranjang masih kosong
            </div>

        <?php } else { ?>

        <table>

            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>

            <?php
            foreach ($_SESSION['cart'] as $id => $item) {
                $subtotal = $item['harga'] * $item['qty'];
                $total += $subtotal;
            ?>

            <tr>
                <td><?= $item['nama'] ?></td>
                <td>Rp <?= number_format($item['harga']) ?></td>
                <td><?= $item['qty'] ?></td>
                <td>Rp <?= number_format($subtotal) ?></td>
                <td>
                    <a class="hapus" href="?hapus=<?= $id ?>">
                        Hapus
                    </a>
                </td>
            </tr>

            <?php } ?>

            <tr class="total-row">
                <td colspan="3">Total Belanja</td>
                <td colspan="2">
                    Rp <?= number_format($total) ?>
                </td>
            </tr>

        </table>

        <div class="checkout">
            <a href="checkout.php">
                <button>
                    💙 Checkout
                </button>
            </a>
        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>