# sudenisaakbulut-22902003-Sude-Nisa_Akbulut-Web2
# YAZ307 - Web Programlama II - Üyelik ve Yönetim Sistemi Projem

Bu proje, **Kapadokya Üniversitesi Yönetim Bilişim Sistemleri YAZ307 Web Programlama II** dersi için hazırladığım bireysel proje ödevidir.

[cite_start]Bu projede PHP ve MySQL kullanarak **dinamik, güvenli ve oturum yönetimi içeren bir Üyelik ve Yönetim Sistemi** geliştirdim[cite: 6].

## ✨ Projenin Kapsamı ve Uyguladığım Güvenlik Önlemleri

Projemde, dersin teknik şartnamesine uygun olarak aşağıdaki kritik işlevleri başarıyla uyguladım:

### A. Güvenlik ve Veritabanı İşlemleri
1.  [cite_start]**Güvenli Şifreleme (Hashing):** Kullanıcı şifrelerini veritabanına kaydederken düz metin yerine **`password_hash()`** fonksiyonunu kullanarak şifreledim[cite: 29].
2.  [cite_start]**E-posta Tekrar Kontrolü:** Kayıt (Register) işlemi sırasında, aynı e-posta adresiyle tekrar kayıt olunmasını engelledim[cite: 28].
3.  [cite_start]**last_login Güncellemesi:** Kullanıcı girişi başarılı olduğunda, veritabanındaki **`last_login`** sütununu o anki zaman (NOW()) ile otomatik olarak güncelledim[cite: 31].
4.  [cite_start]**Oturum Güvenliği:** Sisteme giriş yapan kullanıcının oturumunu **`session_start()`** ile başlattım[cite: 32].

### B. Oturum Yönetimi ve Yetkilendirme
1.  **İzinsiz Erişim Engelleme:** `dashboard.php` ve `profile.php` gibi özel sayfaları koruma altına aldım. [cite_start]Giriş yapmamış bir kullanıcı bu sayfalara URL üzerinden ulaşmaya çalışırsa, otomatik olarak `login.php` sayfasına yönlendirilir[cite: 33].
2.  [cite_start]**Kişisel Bilgi Gösterimi:** `profile.php` sayfasında, giriş yapmış kullanıcının kendi bilgilerini (Ad, Soyad, Okul No ve Son Giriş Tarihi) veritabanından çekerek listeledim[cite: 34].
3.  [cite_start]**Güvenli Çıkış:** `logout.php` dosyasını kullanarak tüm oturumları güvenli bir şekilde sonlandırdım (`session_destroy`)[cite: 35].

## 📂 Dosya Yapısı

Proje klasörümde, şartnamede belirtilen tüm zorunlu dosyalar bulunmaktadır:

| Dosya Adı | Açıklama |
| :--- | :--- |
| `db.php` | Veritabanı bağlantı ayarlarını (PDO) içeriyor. |
| `index.php` | Projenin ana karşılama sayfası (Login ve Register yönlendirmeleri). |
| `register.php` | Yeni kullanıcı kayıt formunu ve veriyi işleyen arka uç kodlarını içeriyor. |
| `login.php` | Kullanıcı giriş formunu, doğrulamasını ve `last_login` güncellemesini yapıyor. |
| `dashboard.php` | Giriş yapmış kullanıcılar için yetkili ana panel. |
| `profile.php` | Kullanıcı bilgilerinin gösterildiği sayfa. |
| `logout.php` | Güvenli çıkış ve oturum sonlandırma kodu. |
| **`system_db.sql`** | [cite_start]Veritabanımın yedeği (Export dosyası)[cite: 14, 17]. |
| `style.css` | Temel tasarımları ve form yapısını düzenlediğim CSS dosyası. |

## 🛠️ Veritabanı Detayları

[cite_start]Projeyi kurarken kullandığım veritabanı ayarları şunlardır[cite: 17, 18]:

* **Veritabanı Adı:** `system_db`
* **Tablo Adı:** `users`
* **Önemli Sütunlar:** `email` (**UNIQUE**), `password` (Hashlenmiş), `last_login` (DATETIME/TIMESTAMP)[cite: 24, 25, 26].

## 💻 Kurulum ve Çalıştırma

Projenin çalışması için XAMPP ortamı gerekmektedir.

1.  **XAMPP Başlatma:** XAMPP Kontrol Panelinde **Apache** ve **MySQL** servislerini başlattım.
2.  **Veritabanı Oluşturma:** `system_db.sql` dosyasını `localhost/phpmyadmin` üzerinden içe aktararak `system_db` veritabanını oluşturdum.
3.  **Ayarlar:** `db.php` dosyasındaki veritabanı adı (`system_db`), kullanıcı adı (`root`) ve şifre (`''` - varsayılan boş) bilgilerini kontrol ettim.
4.  **Çalıştırma:** Projeyi `http://localhost/webprogramlamaa/index.php` adresinden başlattım.
