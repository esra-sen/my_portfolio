<?php
session_start();
include "Includes/db.php";

// Oturum kontrolü: Giriş yapılmadıysa login sayfasına at
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Proje Silme İşlemi
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: admin_panel.php");
        exit;
    } catch (PDOException $e) {
        $error = "Silme işlemi başarısız: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Esra Nur Şen</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        /* Panel için birkaç özel dokunuş */
        body { padding: 40px; background-color: #fdfbf7; font-family: 'Montserrat', sans-serif; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #B8860B; padding-bottom: 20px; margin-bottom: 40px; }
        .admin-header h1 { font-family: 'Playfair Display', serif; color: #B8860B; margin: 0; }
        .nav-links a { text-decoration: none; color: #333; margin-left: 20px; font-weight: bold; transition: 0.3s; }
        .nav-links a:hover { color: #B8860B; }
        .logout-link { color: #d9534f !important; }
        
        .project-table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .project-table th { background: #B8860B; color: #fff; padding: 15px; text-align: left; text-transform: uppercase; letter-spacing: 1px; }
        .project-table td { padding: 15px; border-bottom: 1px solid #eee; color: #444; }
        .delete-btn { color: #d9534f; text-decoration: none; font-weight: bold; transition: 0.3s; }
        .delete-btn:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header class="admin-header">
        <h1>Hoş Geldin, Esra</h1>
        <div class="nav-links">
            <a href="index.php">SİTEYİ GÖR</a>
            <a href="logout.php" class="logout-link">ÇIKIŞ YAP</a>
        </div>
    </header>

    <main>
        <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">MEVCUT PROJELER</h3>
        
        <?php if(isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <table class="project-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proje Adı</th>
                    <th style="text-align: right;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
                while($row = $stmt->fetch()) {
                    echo "<tr>
                        <td>#{$row['id']}</td>
                        <td><strong>" . htmlspecialchars($row['title']) . "</strong></td>
                        <td style='text-align: right;'>
                            <a href='?delete={$row['id']}' class='delete-btn' onclick='return confirm(\"Bu projeyi silmek istediğine emin misin?\")'>SİL</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>
</html>