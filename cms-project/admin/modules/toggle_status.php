<?php
require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../config/db.php';

// Step 1: Validate ID & Status
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Invalid parameters.");
}

$module_id = (int) $_GET['id'];
$status = (int) $_GET['status']; // 1 = activate, 0 = deactivate

// Step 2: Update is_active status
$stmt = $pdo->prepare("UPDATE modules SET is_active = ? WHERE id = ?");
$stmt->execute([$status, $module_id]);

// Step 3: Redirect
header("Location: index.php?msg=status_changed");
exit();
