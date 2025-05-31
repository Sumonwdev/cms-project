<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: ../auth/login.php');
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    echo "<h2 style='color:red;'>Access Denied: Admins Only</h2>";
    exit();
}
?>