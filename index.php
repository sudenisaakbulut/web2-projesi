<?php
// KAPADOKYA ÜNİVERSİTESİ - WEB PROGRAMLAMA - II PROJESİ
// Dosya: index.php
// Amaç: Karşılama sayfası - Login ve Register yönlendirmeleri. 

// Oturumu başlat, böylece kullanıcı giriş yapmışsa panel bağlantısı gösterebiliriz.
session_start();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Web Programlama II - Ana Sayfa</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Üyelik ve Yönetim Sistemi</h2>
        [cite_start]<p>PHP ve MySQL kullanarak dinamik, güvenli bir sistem geliştirme projesi. [cite: 6]</p>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Hoş geldiniz, **<?php echo htmlspecialchars($_SESSION['name']); ?>**.</p>
            <p><a href="dashboard.php" class="button">Yönetim Paneline Git (Dashboard)</a></p>
            <p><a href="logout.php">Güvenli Çıkış</a></p>
        <?php else: ?>
            <p>Lütfen bir işlem seçin:</p>
            <p><a href="login.php" class="button">Giriş Yap (Login)</a></p>
            <p><a href="register.php" class="button">Kayıt Ol (Register)</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
//zorunlu degisiklik