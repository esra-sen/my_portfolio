<?php
include "Includes/db.php";
session_start();

// Güvenlik: Giriş yapmamış kişilere veri gönderme
if (!isset($_SESSION['admin_logged_in'])) {
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Unauthorized']));
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    

    $stmt = $pdo->prepare("SELECT email, message FROM messages WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(['email' => 'Hata', 'message' => 'Detaylar çekilemedi.']);
    }
    exit;
}
?>