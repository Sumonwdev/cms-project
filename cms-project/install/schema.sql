-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pages Table
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Admin Menu Table
CREATE TABLE IF NOT EXISTS admin_menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    route VARCHAR(255) NOT NULL,
    icon VARCHAR(50) DEFAULT 'circle',
    is_active TINYINT(1) DEFAULT 1,
    ordering INT DEFAULT 0
);

-- Insert default menu items
INSERT INTO admin_menus (title, route, icon, ordering) VALUES
('Dashboard', '/admin/dashboard/index.php', 'home', 1),
('Pages', '/admin/pages/index.php', 'file-text', 2),
('Users', '/admin/users/users.php', 'user', 3),
('Modules', '/admin/modules/index.php', 'settings', 4),
('Settings', '/admin/settings/settings.php', 'cog', 5),
('Logout', '/auth/logout.php', 'log-out', 99);
