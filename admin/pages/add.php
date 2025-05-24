<?php
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/sidebar.php';
?>
<h3>➕ Add New Page</h3>

<form action="insert.php" method="post">
    Title: <input type="text" name="title" id="page_title" required><br><br>
    
    Slug: <input type="text" name="slug" id="slug_field" required><br><br>
    
    Content:<br>
    <textarea name="content" rows="6" cols="60"></textarea><br><br>
    
    <input type="submit" value="Create Page">
</form>

<script>
    document.getElementById('page_title').addEventListener('input', function () {
        const title = this.value;
        const slug = title.toLowerCase()
                          .replace(/[^a-z0-9]+/g, '-')  // non-alphanumeric to hyphen
                          .replace(/^-+|-+$/g, '');     // remove leading/trailing hyphens
        document.getElementById('slug_field').value = slug;
    });
</script>


<?php require_once __DIR__ . '/../../includes/footer.php'; ?>