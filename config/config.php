<?php
// Cấu hình chung
define('BASE_URL', 'http://localhost/duann1/');
define('SITE_NAME', 'Cửa Hàng Điện Thoại');

// Cấu hình session
ini_set('session.cookie_httponly', 1);
session_start();

// Timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        'models/' . $class . '.php',
        'controllers/' . $class . '.php',
        'config/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});
?>

