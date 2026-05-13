<?php
session_start();
include "Includes/db.php"; 

$user = ""; // Başta boş tanımlıyoruz

if (isset($_POST['login'])) {
    $user = $_POST['username']; // Yazdığın ismi değişkene alıyoruz
    $pass = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE user_name = ? AND password = ?");
        $stmt->execute([$user, $pass]);
        $admin = $stmt->fetch();

        if ($admin) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_panel.php");
            exit;
        } else {
            $error = "Hatalı kullanıcı adı veya şifre!";
            // Şifreyi güvenlik gereği siliyoruz ama kullanıcı adını silmiyoruz
        }
    } catch (PDOException $e) {
        $error = "Veritabanı Hatası: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Esra Nur Şen</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="login-card">
        <h2>Panel Girişi</h2>
        
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Kullanıcı Adı" 
                       value="<?php echo htmlspecialchars($user); ?>" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Şifre" required>
                <i class="fa-solid fa-eye toggle-password" id="eyeIcon"></i>
            </div>
            
            <button type="submit" name="login" class="login-btn">Giriş Yap</button>
        </form>

        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <a href="index.php" style="display:inline-block; margin-top:20px; color:#666; text-decoration:none; font-size:12px;">← Siteye Dön</a>
    </div>

    <script>
        // Şifre Göster/Gizle Scripti
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // İkonu değiştir
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>