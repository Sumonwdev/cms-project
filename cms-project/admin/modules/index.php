<?php
// admin/modules.php

require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../config/db.php';


$stmt = $pdo->prepare("SELECT * FROM modules ORDER BY id DESC");
$stmt->execute();
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Module Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <body>
    <h2>📦 Module Management</h2>
    <?php require_once __DIR__ . '/../../includes/layout/sidebar.php'; ?>

    <a href="add_module.php">➕ Add New Module</a>
    <br><br>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;">
            <?php
                switch ($_GET['msg']) {
                    case 'added':
                        echo "✅ Module added successfully!";
                        break;
                    case 'updated':
                        echo "✏️ Module updated successfully!";
                        break;
                    case 'deleted':
                        echo "🗑️ Module deleted successfully!";
                        break;
                    case 'status_changed':
                        echo "🔄 Module status updated!";
                        break;
                    default:
                        echo "ℹ️ Operation completed.";
                }
            ?>
        </p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Module Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $index => $module): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($module['module_name']) ?></td>
                <td><?= htmlspecialchars($module['slug']) ?></td>
                <td><?= htmlspecialchars($module['description']) ?></td>
                <td>
                    <?php if ($module['is_active']): ?>
                        ✅ Active
                    <?php else: ?>
                        ❌ Inactive
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit_module.php?id=<?= $module['id'] ?>">✏️ Edit</a> |
                    <a href="delete_module.php?id=<?= $module['id'] ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a> |
                    <?php if ($module['is_active']): ?>
                        <a href="toggle_status.php?id=<?= $module['id'] ?>&status=0">🚫 Deactivate</a>
                    <?php else: ?>
                        <a href="toggle_status.php?id=<?= $module['id'] ?>&status=1">✅ Activate</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
