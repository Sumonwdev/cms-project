<?php
require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../includes/layout/header.php';
require_once __DIR__ . '/../../includes/layout/sidebar.php';
require_once __DIR__ . '/../../config/db.php';
$stmt = $pdo->query("SELECT * FROM pages ORDER BY id DESC");
$pages = $stmt->fetchAll();
?>
<h3>📄 All Pages</h3>
<?php if (isset($_GET['msg'])): ?>
    <p style="color: green; font-weight: bold;">
        <?php
        switch($_GET['msg']) {
            case 'created': echo '✅ Page created successfully.'; break;
            case 'updated': echo '✏️ Page updated successfully.'; break;
            case 'deleted': echo '🗑️ Page deleted successfully.'; break;
            default: echo 'ℹ️ Action completed.'; break;
        }
        ?>
    </p>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red; font-weight: bold;">
        ❌ <?= htmlspecialchars($_GET['error']) ?>
    </p>
<?php endif; ?>

<a href="add.php">➕ Add New Page</a><br><br>
<table border="1" cellpadding="8" cellspacing="0">
<tr><th>ID</th><th>Title</th><th>Slug</th><th>Created</th><th>Actions</th></tr>
<?php foreach($pages as $row): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars($row['slug']) ?></td>
    <td><?= $row['created_at'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">🗑️ Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php require_once __DIR__ . '/../../includes/layout/footer.php'; ?>
