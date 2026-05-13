<?php
require_once "db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $full_name = $_POST['name_surname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql = "INSERT INTO messages (full_name, email, subject, message) 
                VALUES (:full_name, :email, :subject, :message)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo "success";
            exit; // Başka çıktı gelmesini engelle
        }
    } catch (PDOException $e) {
        echo "error";
        exit;
    }
}
?>