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
- **Kullanım Amacı:** Kod yapısının organize edilmesi, `$_SESSION` tabanlı veri saklama mantığı ve form doğrulama fonksiyonlarının yazılması
konusunda rehberlik alındı.

**Öğrencinin Katkısı:** Kategori seçenekleri, CSS arayüz tasarımı ve projenin klasör yapısı kişiselleştirildi.

**Ekran Görüntüleri**
<img width="1896" height="1017" alt="ana giriş 1" src="https://github.com/user-attachments/assets/4beaa172-6df0-42f7-83bb-f6b7296e5d20" />
<img width="1917" height="1017" alt="Ürün ekleme 2" src="https://github.com/user-attachments/assets/2334f0d3-a333-4281-9227-7094b99ac226" />
<img width="1917" height="1017" alt="Ürün eksik kaydetmek 3" src="https://github.com/user-attachments/assets/96812b3a-dae0-4f33-99dc-93c69ddb8d65" />
<img width="1917" height="1022" alt="Ürün eksik kaydetmek 4" src="https://github.com/user-attachments/assets/d3029a71-105e-4fd2-b178-ab93b057fe3f" />
<img width="1917" height="1015" alt="Sil kod php" src="https://github.com/user-attachments/assets/dcd662fa-6c98-4469-80f5-608b0834dec5" />


