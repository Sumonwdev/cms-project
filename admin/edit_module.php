<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

// Step 1: Check if ID is present
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request: No module ID provided.");
}

$module_id = (int)$_GET['id'];

// Step 2: Fetch existing module
$stmt = $pdo->prepare("SELECT * FROM modules WHERE id = ?");
$stmt->execute([$module_id]);
$module = $stmt->fetch();

if (!$module) {
    die("Module not found.");
}

// Step 3: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $icon = trim($_POST['icon']);
    $description = trim($_POST['description']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $update = $pdo->prepare("UPDATE modules SET module_name = ?, slug = ?, icon = ?, description = ?, is_active = ? WHERE id = ?");
    $update->execute([$name, $slug, $icon, $description, $is_active, $module_id]);

    header("Location: modules.php?msg=updated");
    exit();
}
?>

<!-- Step 4: Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Module</title>
</head>
<body>
    <h2>Edit Module</h2>
    <form method="POST">
        <label>Module Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($module['module_name']) ?>" required><br><br>

        <label>Slug:</label><br>
        <input type="text" name="slug" value="<?= htmlspecialchars($module['slug']) ?>" required><br><br>

        <label>Icon (FontAwesome class):</label><br>
        <input type="text" name="icon" value="<?= htmlspecialchars($module['icon']) ?>"><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= htmlspecialchars($module['description']) ?></textarea><br><br>

        <label>Active:</label>
        <input type="checkbox" name="is_active" <?= $module['is_active'] ? 'checked' : '' ?>><br><br>

        <button type="submit">Update Module</button>
    </form>

    <br>
    <a href="modules.php">← Back to Modules</a>
</body>
</html>
