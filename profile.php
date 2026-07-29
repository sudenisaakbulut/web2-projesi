<?php
// KAPADOKYA ÜNİVERSİTESİ - WEB PROGRAMLAMA - II PROJESİ
// Dosya: profile.php
// Amaç: Kullanıcı bilgilerinin listelendiği sayfa ve Session Güvenliği. [cite: 13]

require_once 'db.php'; 
session_start();

// Güvenlik (Session Check) Kontrolü
// profile.php sayfasına izinsiz (URL üzerinden) giriş engellenmelidir. [cite: 33]
if (!isset($_SESSION['user_id'])) {
    // Giriş yapmamış kullanıcılar zorla login.php sayfasına yönlendirilmelidir. [cite: 33]
    header("Location: login.php");
    exit;
}

// Giriş yapan kullanıcının kendi bilgilerini veritabanından çekme.
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name, surname, school_number, email, last_login FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Veri Çekme: Giriş yapan kişiye ait verilerin (ad, soyad, son giriş vb.) gösterilmesi. [cite: 34, 44]
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil Sayfası</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Kullanıcı Profil Bilgileri</h2>
        
        <?php if ($user_data): ?>
            <table class="profile-table">
                <tr><th>Ad</th><td><?php echo htmlspecialchars($user_data['name']); ?></td></tr>
                <tr><th>Soyad</th><td><?php echo htmlspecialchars($user_data['surname']); ?></td></tr>
                <tr><th>Okul Numarası</th><td><?php echo htmlspecialchars($user_data['school_number']); ?></td></tr>
                <tr><th>E-posta</th><td><?php echo htmlspecialchars($user_data['email']); ?></td></tr>
                <tr><th>Son Giriş Tarihi</th><td><?php 
                    echo $user_data['last_login'] ? htmlspecialchars($user_data['last_login']) : 'Hiç giriş yapılmadı'; 
                ?></td></tr>
            </table>
            <p><a href="dashboard.php">Panele Geri Dön</a></p>
            <p><a href="logout.php">Güvenli Çıkış</a></p>
        <?php else: ?>
            <p class="error">Kullanıcı verileri bulunamadı.</p>
        <?php endif; ?>
    </div>
</body>
</html>
//zorunlu degisiklik