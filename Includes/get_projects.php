<?php
include 'db.php';
$query = $pdo->query("SELECT * FROM projects");
echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
?>