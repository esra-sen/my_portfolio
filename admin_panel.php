<?php
session_start();
include "Includes/db.php";

if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: admin_login.php"); 
    exit; 
}

// --- SİLME İŞLEMLERİ --- 
if (isset($_GET['delete_project'])) { $pdo->prepare("DELETE FROM projects WHERE id = ?")->execute([$_GET['delete_project']]); header("Location: admin_panel.php#projects"); }
if (isset($_GET['delete_edu'])) { $pdo->prepare("DELETE FROM education WHERE id = ?")->execute([$_GET['delete_edu']]); header("Location: admin_panel.php#education"); }
if (isset($_GET['delete_exp'])) { $pdo->prepare("DELETE FROM experience WHERE id = ?")->execute([$_GET['delete_exp']]); header("Location: admin_panel.php#experience"); }
if (isset($_GET['delete_skill'])) { $pdo->prepare("DELETE FROM skills WHERE id = ?")->execute([$_GET['delete_skill']]); header("Location: admin_panel.php#skills"); }
if (isset($_GET['delete_lang'])) { $pdo->prepare("DELETE FROM languages WHERE id = ?")->execute([$_GET['delete_lang']]); header("Location: admin_panel.php#languages"); }
if (isset($_GET['delete_msg'])) { $pdo->prepare("DELETE FROM messages WHERE id = ?")->execute([$_GET['delete_msg']]); header("Location: admin_panel.php#messages"); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli | Esra Nur Şen</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        .message-row { cursor: pointer; transition: background 0.3s; }
        .message-row:hover { background-color: #f8f8f8; }
        .details-box { display: none; background: #fffdf5; border: 1px solid #e0e0e0; margin: 10px 0; padding: 20px; border-radius: 8px; font-family: 'Montserrat', sans-serif; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); }
        .details-box p { margin: 10px 0; line-height: 1.6; }
    </style>
</head>
<body class="admin-page-body">

    <div class="panel-container">
        <header style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 40px;">
            <h1 style="font-family:'Playfair Display'; color:#B8860B;">Hoş Geldin, Esra</h1>
            <div>
                <a href="index.php" style="color:#666; text-decoration:none; font-weight:bold;">SİTEYİ GÖR</a>
                <a href="logout.php" style="color:red; margin-left:20px; text-decoration:none;">ÇIKIŞ YAP</a>
            </div>
        </header>

        <main class="panel-content">
            
            <section class="admin-section" id="projects">
                <h2 class="section-title">PROJELER</h2>
                <form action="process.php" method="POST" class="add-form">
                    <input type="text" name="project_title" placeholder="Proje Adı" required>
                    <input type="text" name="project_link" placeholder="Proje Linki">
                    <button type="submit" name="add_project" class="save-btn">EKLE</button>
                </form>
                <table class="project-table">
                    <tbody>
                        <?php
                        $projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
                        foreach($projects as $p) {
                            echo "<tr>
                                <td>" . htmlspecialchars($p['title']) . "</td>
                                <td style='text-align:right;'>
                                    <a href='#' onclick=\"confirmDelete('?delete_project={$p['id']}')\" class='delete-btn'><i class='fa fa-trash'></i> SİL</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>

            <section class="admin-section" id="education">
                <h2 class="section-title">EĞİTİM & SERTİFİKALAR</h2>
                <form action="process.php" method="POST" class="add-form">
                    <input type="text" name="institution" placeholder="Kurum/Okul" required>
                    <input type="text" name="title" placeholder="Eğitim" required>
                    <input type="text" name="date_range" placeholder="Tarih">
                    <button type="submit" name="add_education" class="save-btn">EKLE</button>
                </form>
                <table class="project-table">
                    <?php
                    $edu = $pdo->query("SELECT * FROM education ORDER BY id DESC")->fetchAll();
                    foreach($edu as $e) {
                        echo "<tr>
                            <td><strong>" . htmlspecialchars($e['institution']) . "</strong> - " . htmlspecialchars($e['title']) . "</td>
                            <td style='text-align:right;'><a href='#' onclick=\"confirmDelete('?delete_edu={$e['id']}')\" class='delete-btn'><i class='fa fa-trash'></i> SİL</a></td>
                        </tr>";
                    }
                    ?>
                </table>
            </section>

            <section class="admin-section" id="experience">
                <h2 class="section-title">DENEYİM</h2>
                <form action="process.php" method="POST" class="add-form">
                    <input type="text" name="company" placeholder="Şirket" required>
                    <input type="text" name="position" placeholder="Pozisyon" required>
                    <input type="text" name="duration" placeholder="Süre">
                    <textarea name="description" placeholder="Açıklama" rows="3" style="width:100%; margin-bottom:10px; padding:10px; border:1px solid #ddd; border-radius:5px;"></textarea>
                    <button type="submit" name="add_experience" class="save-btn">EKLE</button>
                </form>
                <table class="project-table">
                    <?php
                    $exp = $pdo->query("SELECT * FROM experience ORDER BY id DESC")->fetchAll();
                    foreach($exp as $ex) {
                        echo "<tr>
                            <td><strong>" . htmlspecialchars($ex['company']) . "</strong> (" . htmlspecialchars($ex['position']) . ")</td>
                            <td style='text-align:right;'><a href='#' onclick=\"confirmDelete('?delete_exp={$ex['id']}')\" class='delete-btn'><i class='fa fa-trash'></i> SİL</a></td>
                        </tr>";
                    }
                    ?>
                </table>
            </section>

            <section class="admin-section" id="skills">
                <h2 class="section-title">YETENEKLER</h2>
                <form action="process.php" method="POST" class="add-form">
                    <input type="text" name="skill_name" placeholder="Yetenek" required>
                    <input type="text" name="category" placeholder="Kategori" required>
                    <button type="submit" name="add_skill" class="save-btn">EKLE</button>
                </form>
                <table class="project-table">
                    <?php
                    $skills = $pdo->query("SELECT * FROM skills ORDER BY id DESC")->fetchAll();
                    foreach($skills as $s) {
                        echo "<tr>
                            <td>" . htmlspecialchars($s['skill_name']) . " <span style='color: #888;'>(" . htmlspecialchars($s['category']) . ")</span></td>
                            <td style='text-align:right;'><a href='#' onclick=\"confirmDelete('?delete_skill={$s['id']}')\" class='delete-btn'><i class='fa fa-trash'></i> SİL</a></td>
                        </tr>";
                    }
                    ?>
                </table>
            </section>

            <section class="admin-section" id="languages">
                <h2 class="section-title">DİLLER</h2>
                <form action="process.php" method="POST" class="add-form">
                    <input type="text" name="language_name" placeholder="Dil" required>
                    <input type="text" name="level" placeholder="Seviye" required>
                    <button type="submit" name="add_language" class="save-btn">EKLE</button>
                </form>
                <table class="project-table">
                    <?php
                    $langs = $pdo->query("SELECT * FROM languages ORDER BY id DESC")->fetchAll();
                    foreach($langs as $l) {
                        echo "<tr>
                            <td>" . htmlspecialchars($l['language_name']) . " ({$l['level']})</td>
                            <td style='text-align:right;'><a href='#' onclick=\"confirmDelete('?delete_lang={$l['id']}')\" class='delete-btn'><i class='fa fa-trash'></i> SİL</a></td>
                        </tr>";
                    }
                    ?>
                </table>
            </section>

            <section class="admin-section" id="messages">
                <h2 class="section-title">GELEN MESAJLAR</h2>
                <table class="project-table">
                    <tbody>
                        <?php
                        $msgs = $pdo->query("SELECT * FROM messages ORDER BY id DESC")->fetchAll();
                        foreach($msgs as $m) {
                            echo "<tr class='message-row' onclick=\"toggleMessageDetails({$m['id']})\">
                                <td style='width:30%;'><strong>" . htmlspecialchars($m['full_name']) . "</strong></td>
                                    <td>" . htmlspecialchars($m['subject']) . "</td>                                <td style='text-align:right;'>
                                    <a href='#' onclick=\"event.stopPropagation(); confirmDelete('?delete_msg={$m['id']}')\" class='delete-btn'>
                                        <i class='fa fa-trash'></i> SİL
                                    </a>
                                </td>
                            </tr>
                            <tr id='details-row-{$m['id']}' style='display:none;'>
                                <td colspan='3'>
                                    <div id='details-{$m['id']}' class='details-box' style='display:block;'>
                                        <p><strong>E-posta:</strong> <span id='email-{$m['id']}'>Yükleniyor...</span></p>
                                        <p><strong>Mesaj:</strong><br><span id='body-{$m['id']}'>Yükleniyor...</span></p>
                                    </div>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
    function toggleMessageDetails(id) {
        const row = document.getElementById('details-row-' + id);
        if (row.style.display === 'none') {
            row.style.display = 'table-row';
            if (document.getElementById('email-' + id).innerText === 'Yükleniyor...') {
                fetch('get_message.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('email-' + id).innerText = data.email || 'E-posta bulunamadı';
                        document.getElementById('body-' + id).innerText = data.message || 'Mesaj içeriği boş';
                    })
                    .catch(err => {
                        document.getElementById('body-' + id).innerText = "Veri yüklenirken hata oluştu!";
                    });
            }
        } else {
            row.style.display = 'none';
        }
    }

    function confirmDelete(url) {
        Swal.fire({
            title: 'Emin misin?',
            text: "Bu veriyi sildiğinde geri getiremezsin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#B8860B',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
    </script>
</body>
</html>