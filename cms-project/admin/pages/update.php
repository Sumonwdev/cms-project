<?php
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = $_POST['content']; // CKEditor HTML সহ Content

    if (!$title || !$slug) {
        header("Location: edit.php?id=$id&error=missing_fields");
        exit;
    }

    $stmt = $pdo->prepare("UPDATE pages SET title = ?, slug = ?, content = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$title, $slug, $content, $id]);

    header("Location: index.php?msg=updated");
    exit;
}
?>
