<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: " . dirname($_SERVER['PHP_SELF']) . "/admin/dashboard/index.php");
    exit;
}
header("Location: auth/login.php");
exit;
?>