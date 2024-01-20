<?php
session_start();
ob_start();
require 'config.php';
require 'database/connect.php';

$module = _MODULE_DEFAULT;
$action = _ACTION_DEFAULT;
if (!empty($_GET['modules'])) {
    $module = $_GET['modules'];
}

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$path = 'modules/' . $module . '/' . $action . '.php';
if (empty($_SESSION['is_login']) && $module == "products" && $action == "list") {
    if (file_exists($path)) {
        require_once $path;
    }
} elseif (empty($_SESSION['is_login']) && $module != "auth" && $action != "login") {
    header("Location: ?modules=auth&action=login");
}
if (file_exists($path)) {
    //echo $path;
    require_once $path;
}
