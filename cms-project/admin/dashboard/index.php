<?php
require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../includes/layout/header.php';
require_once __DIR__ . '/../../includes/layout/sidebar.php';
?>
<h3>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h3>
<p>This is your dashboard overview.</p>
<?php require_once __DIR__ . '/../../includes/layout/footer.php'; ?>