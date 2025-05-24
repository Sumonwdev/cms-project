<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<h3>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h3>
<p>This is your dashboard overview.</p>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>