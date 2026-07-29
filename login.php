<?php
// KAPADOKYA ÜNİVERSİTESİ - WEB PROGRAMLAMA - II PROJESİ
// Dosya: login.php
// Amaç: Giriş formu, doğrulama ve son giriş güncelleme kodları. [cite: 13]

require_once 'db.php'; 
session_start(); // Oturumu başlat

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; 

    if (empty($email) || empty($password)) {
        $error_message = "Lütfen e-posta ve şifrenizi girin.";
    } else {
        
        // 1. Kullanıcıyı E-posta ile Veritabanında Bulma
        $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Şifre Doğrulama
        // Bulunan kullanıcı varsa ve şifre doğruysa:
        if ($user && password_verify($password, $user['password'])) {
            
            // 3. Giriş ve Update: last_login Güncelleme
            // last_login sütunu anlık zaman (NOW()) ile güncellenecektir. [cite: 26, 31]
            $update_stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $update_stmt->execute([$user['id']]);

            // 4. Oturum Başlatma (Session Start)
            // $_SESSION başlatılacak ve kullanıcı panele yönlendirilecektir. [cite: 32]
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name']; // Profil ve panelde kullanmak için adı da tutuyoruz.
            
            // Kullanıcıyı Yönetim Paneline yönlendir.
            header("Location: dashboard.php");
            exit;

        } else {
            // E-posta veya Şifre doğrulaması başarısız.
            $error_message = "Hatalı e-posta veya şifre.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Giriş (Login)</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h3>Kullanıcı Giriş Formu</h3>
        
        <?php 
        if (!empty($error_message)) {
            echo '<p class="error">' . htmlspecialchars($error_message) . '</p>';
        }
        ?>

        <form action="login.php" method="POST">
            <label for="email">E-posta:</label>
            <input type="email" name="email" required><br>

            <label for="password">Şifre:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Giriş Yap</button>
        </form>
        <p><a href="register.php">Hesabınız yok mu? Kayıt Olun</a></p>
    </div>
</body>
</html>
<!-- // login.php - v2 commit mark
//zorunlu degisiklik -->
