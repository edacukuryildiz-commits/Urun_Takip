<?php
require_once 'functions.php';

$hata = "";
$basari = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ad = trim($_POST['ad'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    $durum = trim($_POST['durum'] ?? '');
    
    // URL'yi alıyoruz
    $resimURL = trim($_POST['resim'] ?? '');

    // Veri Doğrulama
    if (empty($ad) || empty($kategori) || $stok === '' || empty($durum)) {
        $hata = "Lütfen tüm zorunlu alanları doldurunuz!";
    } elseif (!is_numeric($stok) || $stok < 0) {
        $hata = "Stok miktarı geçerli bir sayı olmalıdır!";
    } else {
        
        // Eğer kullanıcı boş bırakırsa varsayılan kamp çantası/ürün resmi eklensin
        if (empty($resimURL)) {
            $resimURL = "https://via.placeholder.com/60?text=Urun";
        }

        // Yeni ID oluştur
        $yeniId = count($_SESSION['urunler']) > 0 ? end($_SESSION['urunler'])['id'] + 1 : 1;

        // Oturuma yeni kaydı bağlantı yolu (URL) ile ekle
        $_SESSION['urunler'][] = [
            "id" => $yeniId,
            "ad" => $ad,
            "kategori" => $kategori,
            "stok" => (int)$stok,
            "durum" => $durum,
            "resim" => $resimURL
        ];

        $basari = "Ürün görsel bağlantısı ile birlikte başarıyla eklendi!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Ürün Ekle - Kamp & Etkinlik Takip</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🏕️ Yeni Ürün Ekle</h1>
            <nav>
                <a href="index.php" class="btn">← Ana Sayfaya Dön</a>
            </nav>
        </header>

        <div class="form-card">
            <?php if (!empty($hata)): ?>
                <div class="alert error"><?php echo $hata; ?></div>
            <?php endif; ?>

            <?php if (!empty($basari)): ?>
                <div class="alert success"><?php echo $basari; ?></div>
            <?php endif; ?>

            <form method="POST" action="ekle.php">
                <div class="form-group">
                    <label for="ad">Ürün Adı:</label>
                    <input type="text" id="ad" name="ad" placeholder="Örn: Uyku Tulumu">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select id="kategori" name="kategori">
                        <option value="">Seçiniz...</option>
                        <option value="Kamp Eşyaları">Kamp Eşyaları</option>
                        <option value="Etkinlik Eşyaları">Etkinlik Eşyaları</option>
                        <option value="Elektronik Ürünler">Elektronik Ürünler</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stok">Stok Miktarı:</label>
                    <input type="number" id="stok" name="stok" placeholder="Örn: 25">
                </div>

                <div class="form-group">
                    <label for="durum">Stok Durumu:</label>
                    <select id="durum" name="durum">
                        <option value="Normal">Normal</option>
                        <option value="Kritik Stok">Kritik Stok</option>
                        <option value="Tükendi">Tükendi</option>
                    </select>
                </div>

                <!-- Dosya seçme alanı metin (URL) giriş alanına dönüştürüldü -->
                <div class="form-group">
                    <label for="resim">Ürün Görseli (Bağlantı URL Kopyala/Yapıştır):</label>
                    <input type="text" id="resim" name="resim" placeholder="Örn: https://site.com/resim.jpg">
                </div>

                <button type="submit" class="btn btn-primary">Ürünü Kaydet</button>
            </form>
        </div>
    </div>
</body>
</html>