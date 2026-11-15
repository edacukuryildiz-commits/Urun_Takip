<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kamp ve Doğa Konseptine Uygun Başlangıç Verileri
if (!isset($_SESSION['urunler'])) {
    $_SESSION['urunler'] = [
        ["id" => 1, "ad" => "2 Kişilik Kamp Çadırı", "kategori" => "Kamp Eşyaları", "stok" => 15, "durum" => "Normal", "resim" => "https://via.placeholder.com/60?text=Cadir"],
        ["id" => 2, "ad" => "Uyku Tulumu (Kışlık)", "kategori" => "Kamp Eşyaları", "stok" => 3, "durum" => "Kritik Stok", "resim" => "https://via.placeholder.com/60?text=Tulum"],
        ["id" => 3, "ad" => "Katlanabilir Kamp Sandalyesi", "kategori" => "Etkinlik Eşyaları", "stok" => 25, "durum" => "Normal", "resim" => "https://via.placeholder.com/60?text=Sandalye"],
        ["id" => 4, "ad" => "Kafa Lambası", "kategori" => "Elektronik Ürünler", "stok" => 0, "durum" => "Tükendi", "resim" => "https://via.placeholder.com/60?text=Lamba"],
        ["id" => 5, "ad" => "Güneş Enerjili Powerbank", "kategori" => "Elektronik Ürünler", "stok" => 8, "durum" => "Normal", "resim" => "https://via.placeholder.com/60?text=Powerbank"]
    ];
}

function istatistikleriHesapla($urunler) {
    $toplam = count($urunler);
    $kritik = 0;
    $tukendi = 0;

    foreach ($urunler as $urun) {
        if ($urun['durum'] == 'Kritik Stok') {
            $kritik++;
        } elseif ($urun['durum'] == 'Tükendi') {
            $tukendi++;
        }
    }

    return [
        'toplam' => $toplam,
        'kritik' => $kritik,
        'tukendi' => $tukendi
    ];
}

function guvenliVeri($veri) {
    return htmlspecialchars(trim($veri), ENT_QUOTES, 'UTF-8');
}
?>