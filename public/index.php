<?php
// ================================================
// FRONT CONTROLLER (SINGLE ENTRY POINT)
// ================================================

session_start();

// Autoloader sederhana
spl_autoload_register(function($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Load config
require_once __DIR__ . '/../config/config.php';

// Load core
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Controller.php';

// Routing sederhana
$controller = $_GET['c'] ?? 'home';
$method = $_GET['m'] ?? 'index';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerClass)) {
        $controllerObj = new $controllerClass();
        
        if (method_exists($controllerObj, $method)) {
            $controllerObj->$method();
        } else {
            die("Method {$method} tidak ditemukan di controller {$controllerClass}");
        }
    } else {
        die("Class {$controllerClass} tidak ditemukan");
    }
} else {
    die("Controller {$controllerClass} tidak ditemukan");
}
?>