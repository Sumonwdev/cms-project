<?php
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/sidebar.php';
require_once __DIR__ . '/../../config/db.php';
$stmt = $pdo->query("SELECT * FROM pages ORDER BY id DESC");
$pages = $stmt->fetchAll();
?>
<h3>📄 All Pages</h3>
<a href="add.php">➕ Add New Page</a><br><br>
<table border="1" cellpadding="8" cellspacing="0">
<tr><th>ID</th><th>Title</th><th>Slug</th><th>Created</th></tr>
<?php foreach($pages as $row): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= htmlspecialchars($row['title']) ?></td>
<td><?= htmlspecialchars($row['slug']) ?></td>
<td><?= $row['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>