-- KAPADOKYA ÜNİVERSİTESİ - WEB PROGRAMLAMA - II PROJESİ
-- Dosya: system_db.sql
-- Amaç: Projenin teknik şartnamesine uygun veritabanı ve 'users' tablosu yapısını oluşturmak.
-- Puanlama Kriteri: Bu dosyanın proje içinde bulunması ve çalışması zorunludur (10 Puan).

-- 1. VERİTABANI OLUŞTURMA
-- Teknik Şartnameye uygun olarak veritabanı adı: system_db [cite: 17]
CREATE DATABASE IF NOT EXISTS system_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Oluşturulan veritabanını kullan.
USE system_db;

-- 2. TABLO OLUŞTURMA
-- Tablo Adı: users [cite: 18]

CREATE TABLE IF NOT EXISTS `users` (
  -- 1. id: Primary Key, Auto Increment (Zorunlu) [cite: 20]
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  
  -- 2. name: Kullanıcı Adı (Varchar) [cite: 21]
  `name` VARCHAR(100) NOT NULL,
  
  -- 3. surname: Soyadı (Varchar) [cite: 22]
  `surname` VARCHAR(100) NOT NULL,
  
  -- 4. school_number: Okul Numarası (Varchar/Int) [cite: 23]
  `school_number` VARCHAR(50) DEFAULT NULL,
  
  -- 5. email: E-posta (Varchar) - UNIQUE olmalıdır (10 Puan kriteri) [cite: 24, 43]
  `email` VARCHAR(150) NOT NULL,
  
  -- 6. password: Şifre (Varchar) - Hashlenmiş şifreyi tutacağı için uzunluğu 255 olmalıdır [cite: 25]
  `password` VARCHAR(255) NOT NULL,
  
  -- 7. last_login: DATETIME veya TIMESTAMP - Son giriş zamanını tutacaktır (10 Puan kriteri) [cite: 26, 43]
  `last_login` DATETIME DEFAULT NULL,
  
  -- Birincil Anahtarı Belirleme
  PRIMARY KEY (`id`),
  
  -- E-posta adresinin benzersizliğini zorunlu kılma (UNIQUE KEY)
  UNIQUE KEY `email_unique` (`email`) 
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------------------
-- Örnek Kullanıcı Ekleme (Opsiyonel - Test amaçlı)
-- DİKKAT: 'sifre123' şifresi bu örnekte hashlenmemiştir. Gerçek uygulamada PHP'de password_hash() kullanılmalıdır.
-- INSERT INTO users (name, surname, school_number, email, password, last_login) 
-- VALUES ('Test', 'Kullanici', '220501000', 'test@kappadokya.edu.tr', 'sifre123', NOW());
-- -----------------------------------------------------------------------
//zorunlu degisiklik