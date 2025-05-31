<?php
require_once __DIR__ . '/../../config/db.php';

$base_url = '/web/CMS-Development/cms-project';
$menus = $pdo->query("SELECT * FROM admin_menus WHERE is_active = 1 ORDER BY ordering ASC")->fetchAll(PDO::FETCH_ASSOC);
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>


<div class="sidebar">
    <ul class="sidebar-nav">
        <?php foreach ($menus as $menu): 
            $active = strpos($current_path, $menu['route']) !== false ? 'active' : '';
        ?>
            <li class="<?= $active ?>">
                <a href="<?= $base_url . $menu['route'] ?>">
                    <i class="icon-<?= $menu['icon'] ?>"></i> <?= $menu['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
