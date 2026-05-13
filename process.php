<?php
include "Includes/db.php";
session_start();

// Güvenlik kontrolü: Giriş yapmamış biri bu dosyayı tetikleyemez
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// 1. EĞİTİM EKLEME
if (isset($_POST['add_education'])) {
    $inst = $_POST['institution'];
    $title = $_POST['title'];
    $date = $_POST['date_range'];
    
    $stmt = $pdo->prepare("INSERT INTO education (institution, title, date_range) VALUES (?, ?, ?)");
    $stmt->execute([$inst, $title, $date]);
    header("Location: admin_panel.php?status=success");
}

// 2. DENEYİM EKLEME
if (isset($_POST['add_experience'])) {
    $comp = $_POST['company'];
    $pos = $_POST['position'];
    $dur = $_POST['duration'];
    
    $stmt = $pdo->prepare("INSERT INTO experience (company, position, duration) VALUES (?, ?, ?)");
    $stmt->execute([$comp, $pos, $dur]);
    header("Location: admin_panel.php?status=success");
}

// 3. YETENEK EKLEME
if (isset($_POST['add_skill'])) {
    $skill = $_POST['skill_name'];
    $percent = $_POST['percentage'];
    
    $stmt = $pdo->prepare("INSERT INTO skills (skill_name, percentage) VALUES (?, ?)");
    $stmt->execute([$skill, $percent]);
    header("Location: admin_panel.php?status=success");
}

// 4. DİL EKLEME
if (isset($_POST['add_language'])) {
    $lang = $_POST['language_name'];
    $lvl = $_POST['level'];
    
    $stmt = $pdo->prepare("INSERT INTO languages (language_name, level) VALUES (?, ?)");
    $stmt->execute([$lang, $lvl]);
    header("Location: admin_panel.php?status=success");
}


if (isset($_POST['add_project'])) {
    $title = $_POST['project_title'];
    $link = $_POST['project_link'];
    $stmt = $pdo->prepare("INSERT INTO projects (title, link) VALUES (?, ?)");
    $stmt->execute([$title, $link]);
    header("Location: admin_panel.php");
}
?>