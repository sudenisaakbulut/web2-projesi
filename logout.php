<?php
// KAPADOKYA ÜNİVERSİTESİ - WEB PROGRAMLAMA - II PROJESİ
// Dosya: logout.php
// Amaç: Oturumu sonlandırma ve güvenli çıkış. [cite: 14]

session_start();

// Güvenli Çıkış: Oturum değişkenlerini temizle.
$_SESSION = array();

// Oturum çerezini sil (isteğe bağlı ama önerilir).
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Oturumu tamamen sonlandır. [cite: 35]
session_destroy();

// Kullanıcıyı ana sayfaya veya giriş sayfasına yönlendir.
header("Location: index.php");
exit;
?>
//zorunlu degisiklik