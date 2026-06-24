<?php
session_start();
if (isset($_POST['id']) && isset($_POST['delta'])) {
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $_POST['id']) {
            $item['qty'] += (int)$_POST['delta'];
            if ($item['qty'] < 1) $item['qty'] = 1;
            break;
        }
    }
}
// Kirim respon sukses untuk fetch
http_response_code(200);
