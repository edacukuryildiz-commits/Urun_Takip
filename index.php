<?php
require_once 'functions.php';

// STOK GÜNCELLEME İŞLEMİ (Yeni Eklenen Kısım)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['stok_guncelle'])) {
    $guncellenecek_id = (int)$_POST['urun_id'];
    $yeni_stok = (int)$_POST['yeni_stok'];

    if ($yeni_stok >= 0) {
        foreach ($_SESSION['urunler'] as $index => $urun) {
            if ($urun['id'] == $guncellenecek_id) {
                // Stoku güncelle
                $_SESSION['urunler'][$index]['stok'] = $yeni_stok;

                // Stok durumunu (Normal/Kritik/Tükendi) otomatik ayarla!
                if ($yeni_stok == 0) {
                    $_SESSION['urunler'][$index]['durum'] = "Tükendi";
                } elseif ($yeni_stok <= 5) {
                    $_SESSION['urunler'][$index]['durum'] = "Kritik Stok";
                } else {
                    $_SESSION['urunler'][$index]['durum'] = "Normal";
                }
                break;
            }
        }
    }
    // Formun tekrar gönderilmesini önlemek için sayfayı yenile
    header("Location: index.php");
    exit;
}

// FİLTRELEME İŞLEMİ
$secilenKategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$filtrelenmisUrunler = $_SESSION['urunler'];

if ($secilenKategori != '') {
    $filtrelenmisUrunler = array_filter($_SESSION['urunler'], function($u) use ($secilenKategori) {
        return $u['kategori'] == $secilenKategori;
    });
}

// İstatistikleri hesapla
$istatistik = istatistikleriHesapla($_SESSION['urunler']);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kamp ve Etkinlik Stok Takip Sistemi</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Stok güncelleme formu için ufak tasarım dokunuşu */
        .stok-form { display: flex; gap: 5px; align-items: center; }
        .stok-input { width: 65px; padding: 5px; border: 1px solid #ccc; border-radius: 4px; text-align: center; }
        .btn-update { background-color: #27ae60; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; }
        .btn-update:hover { background-color: #219150; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🏕️ Kamp ve Etkinlik Stok Takip Sistemi</h1>
            <p>Doğa maceralarınız ve etkinlikleriniz için ekipman yönetim paneli.</p>
            <nav>
                <a href="index.php" class="btn">Ana Sayfa / Listele</a>
                <a href="ekle.php" class="btn btn-primary">+ Yeni Ürün Ekle</a>
            </nav>
        </header>

        <section class="stats">
            <div class="stat-card">
                <h3>Toplam Ekipman</h3>
                <p><?php echo $istatistik['toplam']; ?></p>
            </div>
            <div class="stat-card warning">
                <h3>Kritik Stok</h3>
                <p><?php echo $istatistik['kritik']; ?></p>
            </div>
            <div class="stat-card danger">
                <h3>Tükenen Ekipman</h3>
                <p><?php echo $istatistik['tukendi']; ?></p>
            </div>
        </section>

        <section class="filter-section">
            <form method="GET" action="index.php">
                <label for="kategori">Kategoriye Göre Filtrele:</label>
                <select name="kategori" id="kategori">
                    <option value="">Tüm Kategoriler</option>
                    <option value="Kamp Eşyaları" <?php if($secilenKategori=='Kamp Eşyaları') echo 'selected'; ?>>Kamp Eşyaları</option>
                    <option value="Etkinlik Eşyaları" <?php if($secilenKategori=='Etkinlik Eşyaları') echo 'selected'; ?>>Etkinlik Eşyaları</option>
                    <option value="Elektronik Ürünler" <?php if($secilenKategori=='Elektronik Ürünler') echo 'selected'; ?>>Elektronik Ürünler</option>
                </select>
                <button type="submit" class="btn">Filtrele</button>
                <?php if($secilenKategori != ''): ?>
                    <a href="index.php" class="btn btn-secondary">Filtreyi Temizle</a>
                <?php endif; ?>
            </form>
        </section>

        <section class="table-section">
            <h2>Kayıtlı Ekipmanlar</h2>
            <?php if(empty($filtrelenmisUrunler)): ?>
                <p class="empty-msg">Listelenecek ürün bulunamadı.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>ID</th>
                            <th>Ürün Adı</th>
                            <th>Kategori</th>
                            <th>Stok Miktarı</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filtrelenmisUrunler as $urun): ?>
                        <tr>
                            <td>
                                <img src="<?php echo guvenliVeri($urun['resim'] ?? 'https://via.placeholder.com/60'); ?>" alt="Ürün Görseli" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc; display: block;">
                            </td>
                            <td><?php echo $urun['id']; ?></td>
                            <td><?php echo guvenliVeri($urun['ad']); ?></td>
                            <td><?php echo guvenliVeri($urun['kategori']); ?></td>
                            
                            <!-- İŞTE ADET GÜNCELLEME KISMI BURADA -->
                            <td>
                                <form method="POST" action="index.php" class="stok-form">
                                    <input type="hidden" name="urun_id" value="<?php echo $urun['id']; ?>">
                                    <input type="number" name="yeni_stok" class="stok-input" value="<?php echo $urun['stok']; ?>" min="0">
                                    <button type="submit" name="stok_guncelle" class="btn-update" title="Stoku Güncelle">✔</button>
                                </form>
                            </td>
                            
                            <td>
                                <span class="badge <?php echo strtolower(str_replace(' ', '-', $urun['durum'])); ?>">
                                    <?php echo guvenliVeri($urun['durum']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="sil.php?id=<?php echo $urun['id']; ?>" class="btn-delete" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">Sil</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>