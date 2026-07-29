<?php
// Veritabanı bağlantı ayarları
$host = 'localhost';
$dbname = 'system_db'; // Projenizin veritabanı adını buraya yazın
$user = 'root';
$password = ''; // XAMPP varsayılan olarak şifresizdir

try {
    // PDO (PHP Data Objects) nesnesi oluşturuluyor
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    
    // Hata Modu Ayarı: Hata oluşursa PDO istisna (exception) fırlatır
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Bağlantı hatası durumunda kullanıcıya gösterilecek mesaj
    // Geliştirme aşamasında hatanın detayını görmek için: die($e->getMessage());
    die("Veritabanı bağlantısı kurulamadı. Lütfen XAMPP MySQL'i kontrol edin.");
}

// $pdo değişkeni, artık tüm dosyalarda veritabanı işlemleri için kullanılabilir.
?>
//db.php -v1- commit mark
// v1 commit mark - 2. deneme
//son deneme

