<?php
require_once 'functions.php';

if (isset($_GET['id'])) {
    $silinecekId = (int)$_GET['id'];

    // Dizi içerisinde ilgili ID'ye sahip elemanı bulup çıkarıyoruz
    foreach ($_SESSION['urunler'] as $index => $urun) {
        if ($urun['id'] == $silinecekId) {
            unset($_SESSION['urunler'][$index]);
            // Dizinin indeks numaralarını yeniden düzenle
            $_SESSION['urunler'] = array_values($_SESSION['urunler']);
            break;
        }
    }
}

// İşlem bitince ana sayfaya yönlendir
header("Location: index.php");
exit;
?>