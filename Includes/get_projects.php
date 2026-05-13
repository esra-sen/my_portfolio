<?php
include 'db.php';
header('Content-Type: application/json');

// 1. GitHub'dan Projeleri Çek 
$github_username = "esra-sen";
$url = "https://api.github.com/users/$github_username/repos?sort=updated";

$options = [
    "http" => ["header" => "User-Agent: PHP-App"]
];
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$github_projects = json_decode($response, true);

// 2. Yeni Projeleri Veritabanına Kaydet (Eğer daha önce eklenmemişse)
if ($github_projects && is_array($github_projects)) {
    foreach ($github_projects as $repo) {
        if ($repo['fork']) continue; // Fork'ları atla

        $title = $repo['name'];
        $desc = $repo['description'] ?? 'GitHub Repository';
        $link = $repo['html_url'];

        // Veritabanında bu linkle bir proje var mı kontrol et
        $check = $pdo->prepare("SELECT id FROM projects WHERE project_link = ?");
        $check->execute([$link]);
        
        if ($check->rowCount() == 0) {
            // Eğer yoksa, yeni projeyi INSERT et
            $stmt = $pdo->prepare("INSERT INTO projects (title, description, project_link) VALUES (?, ?, ?)");
            $stmt->execute([$title, $desc, $link]);
        }
    }
}

// 3. Son Güncel Halini Veritabanından Çekip JSON Olarak Dön
try {
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($projects);
} catch (PDOException $e) {
    echo json_encode([]);
}
?>