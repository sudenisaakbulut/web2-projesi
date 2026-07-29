<?php
// 1. Veritabanı Bağlantısını Dahil Et
require_once 'db.php';

// Hata mesajlarını tutmak için dizi
$errors = [];

// Form alanlarından gelen veriler için varsayılan boş değerler
$name = $surname = $school_number = $email = ''; 
$raw_password = '';


// 2. Formun POST metoduyla gönderilip gönderilmediğini kontrol et
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 2.1 Veri Alma ve Temizleme (Sanitization)
    // trim() ile boşlukları temizleyerek verileri alıyoruz.
    $name = trim($_POST['name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $school_number = trim($_POST['school_number'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $raw_password = $_POST['password'] ?? ''; // Şifreyi şimdilik temizlemiyoruz

    // 2.2 Basit Doğrulama (Validation)

    // Alanların Boş Olup Olmadığını Kontrol Et
    if (empty($name) || empty($surname) || empty($school_number) || empty($email) || empty($raw_password)) {
        $errors[] = "Lütfen tüm alanları doldurunuz.";
    }

    // E-posta Formatını Kontrol Et
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Lütfen geçerli bir e-posta adresi giriniz.";
    }

    // Şifre Uzunluğunu Kontrol Et (Opsiyonel)
    if (strlen($raw_password) < 6) {
        $errors[] = "Şifreniz en az 6 karakter uzunluğunda olmalıdır.";
    }


    // 3. Eğer doğrulama hataları yoksa kayıt işlemine geçiliyor.
    if (empty($errors)) {
        
        try {
            // 3.1 Aynı E-posta Kontrolü
            $check_sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindParam(':email', $email);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                // E-posta zaten varsa hata mesajı ekle
                $errors[] = "Bu e-posta adresi zaten kayıtlıdır. Lütfen giriş yapın.";
            } else {
                
                // 3.2 Güvenli Şifreleme (Hashing)
                $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
                
                // 3.3 Veritabanına Kayıt (Prepared Statement ile)
                $insert_sql = "INSERT INTO users (name, surname, school_number, email, password) 
                               VALUES (:name, :surname, :school_number, :email, :password)";
                
                $insert_stmt = $pdo->prepare($insert_sql);
                
                // Parametreleri bağla (bindParam hataları düzeltildi)
                $insert_stmt->bindParam(':name', $name);
                $insert_stmt->bindParam(':surname', $surname);
                $insert_stmt->bindParam(':school_number', $school_number);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':password', $hashed_password); 
                
                $insert_stmt->execute();
                
                // Kayıt başarılı, kullanıcıyı giriş sayfasına yönlendir.
                header("Location: login.php?kayit_basarili=1");
                exit();
            }

        } catch (PDOException $e) {
            // Veritabanı ile ilgili bir hata oluşursa (Kritik)
            $errors[] = "Sistemde beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.";
            // Geliştirme için hatayı görebilirsiniz: error_log("DB Hata: " . $e->getMessage());
        }
    }
}
// Ana if bloğu burada kapanıyor. (Form ilk açıldığında veya hatalı POST edildiğinde HTML gösterilir)
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Üyelik Sistemi | Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f4; }
        .container { max-width: 400px; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .alert-danger { color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        label, input, button { display: block; width: 100%; margin-bottom: 10px; }
        input:not([type="submit"]) { padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button[type="submit"] { padding: 10px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Üyelik Kayıt Formu</h2>

        <?php
        // Hata mesajlarını göster
        if (!empty($errors)): ?>
            <div class="alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label for="name">Adı:</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">

            <label for="surname">Soyadı:</label>
            <input type="text" id="surname" name="surname" required value="<?php echo htmlspecialchars($surname); ?>">

            <label for="school_number">Okul Numarası:</label>
            <input type="text" id="school_number" name="school_number" required value="<?php echo htmlspecialchars($school_number); ?>">

            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="register_btn">Kayıt Ol</button>
        </form>

        <p>Zaten hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
    </div>
</body>
</html>
//zorunlu degisiklik