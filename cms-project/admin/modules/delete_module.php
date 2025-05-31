<?php
require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../config/db.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$module_id = (int)$_GET['id'];

// Delete module
$stmt = $pdo->prepare("DELETE FROM modules WHERE id = ?");
$stmt->execute([$module_id]);

// Redirect with message
header("Location: index.php?msg=deleted");
exit();
?>
