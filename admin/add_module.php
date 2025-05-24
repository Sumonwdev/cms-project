<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

$message = '';

// Form Submit হলে Data Insert
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $icon = trim($_POST['icon']);

    if (!empty($name) && !empty($slug)) {
        $stmt = $pdo->prepare("INSERT INTO modules (module_name, slug, icon) VALUES (?, ?, ?)");
        $stmt->execute([$name, $slug, $icon]);
        $message = "Module added successfully!";
    } else {
        $message = "Name and Slug are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Module</title>
    <link rel="stylesheet" href="style.css"> <!-- যদি থাকে -->
</head>
<body>
    <h2>Add New Module</h2>

    <?php if ($message): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Module Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Slug (lowercase, no space):</label><br>
        <input type="text" name="slug" required><br><br>

        <label>Icon (optional - e.g., <code>fas fa-home</code>):</label><br>
        <input type="text" name="icon"><br><br>

        <button type="submit">Add Module</button>
    </form>

    <p><a href="modules.php">← Back to Module List</a></p>
</body>
</html>
