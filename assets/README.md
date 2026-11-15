# Ürün ve Stok Takip Sistemi

## Projenin Amacı ve Özellikleri
Bu proje, PHP tabanlı dinamik bir kayıt ve takip sistemi oluşturmak amacıyla geliştirilmiştir.
- **Özellikler:** 
  - PHP dizileri ve `$_SESSION` ile veri yönetimi
  - Ürün listeleme ve kategoriye göre filtreleme (GET)
  - Yeni ürün ekleme ve veri doğrulama (POST)
  - Ürün silme
  - Toplam ürün ve durum sayaçları
  - `htmlspecialchars()` ile güvenli çıktı

## Klasör Yapısı
- `index.php`: Ana sayfa, listeleme, sayaçlar ve filtreleme ekranı.
- `ekle.php`: Yeni kayıt formu ve veri doğrulama mantığı.
- `sil.php`: Ürün silme işlemlerini gerçekleştiren betik.
- `functions.php`: Ortak fonksiyonlar (`istatistikleriHesapla`, `guvenliVeri`) ve başlangıç verileri.
- `assets/style.css`: Arayüz tasarımı.

## XAMPP Üzerinde Çalıştırma Adımları
1. Proje klasörünü `C:/xampp/htdocs/urun_takip` konumuna kopyalayın.
2. XAMPP Control Panel üzerinden **Apache** servisini başlatın.
3. Tarayıcınızda `http://localhost/urun_takip/index.php` adresini ziyaret edin.

## Yapay Zekâ Kullanımı
- **Araç:** Gemini
- **Kullanım Amacı:** Kod yapısının organize edilmesi, `$_SESSION` tabanlı veri saklama mantığı ve form doğrulama fonksiyonlarının yazılması konusunda rehberlik alındı.
- **Öğrencinin Katkısı:** Kategori seçenekleri, CSS arayüz tasarımı ve projenin klasör yapısı kişiselleştirildi.