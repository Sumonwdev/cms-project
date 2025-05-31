<?php
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $stmt = $pdo->prepare("INSERT INTO pages (title, slug, content) VALUES (?, ?, ?)");
    $stmt->execute([$title, $slug, $content]);
    header("Location: index.php?msg=created");
    exit;
}
?>