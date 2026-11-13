# sudenisaakbulut-22902003-Sude-Nisa_Akbulut-Web2
# YAZ307 - Web Programlama II - Üyelik ve Yönetim Sistemi Projem

Bu proje, **Kapadokya Üniversitesi Yönetim Bilişim Sistemleri Bölümü YAZ307 Web Programlama II** dersi kapsamında geliştirilmiş bireysel dönem projesidir. PHP ve MySQL mimarisi kullanılarak dinamik, güvenli ve oturum yönetimi içeren bir üyelik ve yetkilendirme sistemi tasarlanmıştır.

🔗 **Canlı Demo:** [web2-projesi.free.nf](http://web2-projesi.free.nf)

## 📸 Ekran Görüntüleri
<p align="center">
 <img width="1909" height="1073" alt="Ekran Görüntüsü (6)" src="https://github.com/user-attachments/assets/5b1b84f2-772d-4bc8-a865-ab5f4336ed03" />
<img width="1909" height="1071" alt="Ekran Görüntüsü (5)" src="https://github.com/user-attachments/assets/574b194b-d45d-4c97-a923-b3f19f4a20a8" />
<img width="1920" height="1069" alt="Ekran Görüntüsü (4)" src="https://github.com/user-attachments/assets/44fd21f6-96da-41f2-94bd-758ccb54583c" />
<img width="1918" height="1075" alt="Ekran Görüntüsü (3)" src="https://github.com/user-attachments/assets/c05e7b61-043d-4847-b07a-36f2459b28e7" />
<img width="1920" height="1069" alt="Ekran Görüntüsü (2)" src="https://github.com/user-attachments/assets/1be49eb7-27e4-4529-ab55-1ef1a4492693" />
<img width="1913" height="1069" alt="Ekran Görüntüsü (7)" src="https://github.com/user-attachments/assets/b9c28244-9db3-4d7a-911b-a813c7ce8b21" />

 </p>
---

## 🚀 Projenin Kapsamı ve Güvenlik Önlemleri

Teknik şartname gereksinimlerine uygun olarak projede uygulanan temel işlevler:

### A. Güvenlik ve Veritabanı İşlemleri
* **Güvenli Şifreleme (Hashing):** Kullanıcı şifreleri veritabanına açık metin olarak kaydedilmez; PHP'nin `password_hash()` fonksiyonu ile tek yönlü olarak hashlenerek saklanır.
* **E-posta Benzersizlik Kontrolü:** Kayıt (`register.php`) sırasında girilen e-postanın veritabanında bulunup bulunmadığı sorgulanır ve mükerrer kayıtlar engellenir (`UNIQUE KEY`).
* **Son Giriş Tarihi (`last_login`):** Kullanıcı kimlik doğrulaması başarılı olduğunda, veritabanındaki `last_login` sütunu `NOW()` fonksiyonu ile güncellenir.
* **Oturum Güvenliği:** Oturum başlangıcı `session_start()` ile standardize edilmiş, giriş yapan kullanıcı verileri oturum değişkenlerine (`$_SESSION`) güvenle aktarılmıştır.

### B. Oturum Yönetimi ve Yetkilendirme
* **İzinsiz Erişim Engelleme:** `dashboard.php` ve `profile.php` gibi özel sayfalar yetkilendirme kontrolüne tabi tutulmuştur. Aktif bir oturumu bulunmayan kullanıcılar doğrudan `login.php` sayfasına yönlendirilir.
* **Dinamik Veri Gösterimi:** `profile.php` sayfasında, giriş yapmış olan kullanıcının Ad, Soyad, Öğrenci Numarası ve Son Giriş Tarihi bilgileri veritabanından çekilerek listelenir.
* **Güvenli Oturum Kapatma:** `logout.php` dosyası üzerinden `session_destroy()` ve `$_SESSION = array()` komutlarıyla oturum verileri tamamen sıfırlanır.

---

## 📁 Dosya Yapısı

| Dosya Adı | Açıklama |
| :--- | :--- |
| `db.php` | Merkezi PDO veritabanı bağlantı ayarları |
| `index.php` | Karşılama ve ana yönlendirme sayfası (Giriş & Kayıt) |
| `register.php` | Kullanıcı kayıt formu ve arka uç veri işleme mekanizması |
| `login.php` | Kullanıcı kimlik doğrulama ve `last_login` güncelleme ekranı |
| `dashboard.php` | Yetkili kullanıcılar için korumalı ana kontrol paneli |
| `profile.php` | Oturum açan kullanıcının profil bilgilerini gösteren sayfa |
| `logout.php` | Güvenli oturum sonlandırma ve yönlendirme dosyası |
| `system_db.sql` | Veritabanı şeması ve test verilerini içeren SQL yedeği |
| `style.css` | Arayüz stillerini ve form düzenlerini barındıran CSS dosyası |

---

## 🛠️ Veritabanı Mimarisi

* **Veritabanı Adı:** `system_db`
* **Tablo Adı:** `users`
* **Kritik Alanlar:**
  * `email` (`VARCHAR`, UNIQUE)
  * `password` (`VARCHAR(255)`, Hashlenmiş)
  * `last_login` (`DATETIME` / `TIMESTAMP`)

---

## 💻 Yerel Kurulum (Localhost)

Projeyi yerel geliştirme ortamında çalıştırmak için:

1. **XAMPP Servislerini Başlatın:** XAMPP Kontrol Paneli üzerinden **Apache** ve **MySQL** servislerini aktif edin (`Start`).
2. **Veritabanını İçe Aktarın:** 
   * `http://localhost/phpmyadmin` adresine gidin.
   * `system_db` adında yeni bir veritabanı açın.
   * `system_db.sql` dosyasını bu veritabanı içerisine içe aktarın (**Import**).
3. **Bağlantı Ayarlarını Doğrulayın:** `db.php` dosyasındaki yerel bağlantı bilgilerinin ortamınızla eşleştiğinden emin olun:
   ```php
   $host = "localhost";
   $dbname = "system_db";
   $username = "root";
   $password = "";nden başlattım.
