<?php
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];
    $admin_user = $_POST['admin_user'];
    $admin_pass = $_POST['admin_pass'];

    try {
        // DB Connection Test
        $dsn = "mysql:host=$db_host";
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create Database if not exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

        // Connect to new DB
        $pdo->exec("USE `$db_name`");

        // Load schema.sql
        $schema = file_get_contents(__DIR__ . '/schema.sql');
        $pdo->exec($schema);

        // Insert admin user
        $hashed_password = password_hash($admin_pass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
        $stmt->execute([$admin_user, $hashed_password]);

        // Generate db.php config file
        $config_code = <<<PHP
<?php
\$host = '$db_host';
\$db   = '$db_name';
\$user = '$db_user';
\$pass = '$db_pass';
\$charset = 'utf8mb4';

\$dsn = "mysql:host=\$host;dbname=\$db;charset=\$charset";
\$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    \$pdo = new PDO(\$dsn, \$user, \$pass, \$options);
} catch (\\PDOException \$e) {
    die('DB connection failed: ' . \$e->getMessage());
}
PHP;

        file_put_contents(__DIR__ . '/../config/db.php', $config_code);

        $success = true;

    } catch (PDOException $e) {
        $errors[] = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CMS Installer</title>
</head>
<body>
    <h2>🌸 CMS Installer - Phase 0 🌸</h2>

    <?php if ($success): ?>
        <p style="color: green;">✅ Installation Successful! You can now <a href="../auth/login.php">Login</a></p>
    <?php else: ?>
        <?php if ($errors): ?>
            <ul style="color: red;">
                <?php foreach ($errors as $error) echo "<li>$error</li>"; ?>
            </ul>
        <?php endif; ?>
        <form method="POST">
            <h3>Database Configuration</h3>
            DB Host: <input type="text" name="db_host" value="localhost" required><br><br>
            DB Name: <input type="text" name="db_name" required><br><br>
            DB Username: <input type="text" name="db_user" required><br><br>
            DB Password: <input type="password" name="db_pass"><br><br>

            <h3>Admin Account</h3>
            Admin Username: <input type="text" name="admin_user" required><br><br>
            Admin Password: <input type="password" name="admin_pass" required><br><br>

            <button type="submit">Install CMS</button>
        </form>
    <?php endif; ?>
</body>
</html>
