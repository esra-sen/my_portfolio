<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Website Inquiry';
    $message = $_POST['message'] ?? '';

    if (!empty($full_name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (full_name, email, subject, message) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$full_name, $email, $subject, $message])) {
                echo "success";
            } else { echo "fail"; }
        } catch (PDOException $e) { echo "error"; }
    } else { echo "missing_fields"; }
}
?>