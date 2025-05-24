<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$module_id = (int)$_GET['id'];

// Delete module
$stmt = $pdo->prepare("DELETE FROM modules WHERE id = ?");
$stmt->execute([$module_id]);

// Redirect with message
header("Location: modules.php?msg=deleted");
exit();
?>
