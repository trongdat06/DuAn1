<?php
require_once 'config/config.php';
require_once 'config/database.php';

// Router đơn giản
$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controller = isset($url[0]) ? $url[0] : 'home';
$action = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerName)) {
        $controllerObj = new $controllerName();
        if (method_exists($controllerObj, $action)) {
            call_user_func_array([$controllerObj, $action], $params);
        } else {
            require_once 'views/errors/404.php';
        }
    } else {
        require_once 'views/errors/404.php';
    }
} else {
    require_once 'views/errors/404.php';
}
?>

