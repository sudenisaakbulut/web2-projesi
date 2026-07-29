<?php
// KAPADOKYA ÜNİVERSİTESİ - WEB PROGRAMLAMA - II PROJESİ
// Dosya: dashboard.php
// Amaç: Sadece giriş yapmış kullanıcıların görebileceği panel. [cite: 13]

session_start();

// Güvenlik (Session Check) Kontrolü
// dashboard.php sayfasına izinsiz (URL üzerinden) giriş engellenmelidir. [cite: 33]
if (!isset($_SESSION['user_id'])) {
    // Giriş yapmamış kullanıcılar zorla login.php sayfasına yönlendirilmelidir. [cite: 33]
    header("Location: login.php");
    exit;
}
// Eğer buraya ulaşıldıysa, kullanıcı giriş yapmıştır.

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli (Anasayfa)</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Hoş Geldiniz, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
        <h3>Yönetim Paneli (Dashboard)</h3>
        <p>Bu sayfayı sadece başarılı şekilde giriş yapan yetkili kullanıcılar görebilir.</p>

        <p>Kullanıcı Bilgileri: <a href="profile.php" class="button">Profilim</a></p>
        <p>Güvenli Çıkış: <a href="logout.php" class="button">Çıkış Yap</a></p>
    </div>
</body>
</html>
<!-- // dashboard.php - v3 commit mark
//zorunlu degisiklik -->