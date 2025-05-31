<?php
require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$id]);
$page = $stmt->fetch();

if (!$page) {
    header("Location: index.php?msg=notfound");
    exit;
}

require_once __DIR__ . '/../../includes/layout/header.php';
require_once __DIR__ . '/../../includes/layout/sidebar.php';
?>

<h3>✏️ Edit Page</h3>

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $page['id'] ?>">

    Title:<br>
    <input type="text" name="title" value="<?= htmlspecialchars($page['title']) ?>" required><br><br>

    Slug:<br>
    <input type="text" name="slug" value="<?= htmlspecialchars($page['slug']) ?>" readonly><br><br>

    Content:<br>
    <textarea name="content" id="content" rows="6" cols="60"><?= htmlspecialchars($page['content']) ?></textarea><br><br>

    <input type="submit" value="Update Page">
</form>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

<?php require_once __DIR__ . '/../../includes/layout/footer.php'; ?>
