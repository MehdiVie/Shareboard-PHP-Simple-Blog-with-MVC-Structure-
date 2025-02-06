<?php
session_start();
// Include Config
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT_PATH', '/shareboard/');
define('ROOT_URL', 'http://php.local/shareboard/');

require('db.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/Home.php');
require('controllers/shares.php');
require('controllers/users.php');

require('models/home.php');
require('models/share.php');
require('models/user.php');


$request = isset($_GET['url']) ? $_GET['url'] : ''; // Default to an empty string
$request = rtrim($request, '/');
$request = filter_var($request, FILTER_SANITIZE_URL);
$params = explode('/', $request);

$controller = !empty($params[0]) ? ucwords($params[0]) : 'Home';
$action = !empty($params[1]) ? $params[1] : 'index';


$bootstrap = new Bootstrap(['controller' => $controller, 'action' => $action]);
$controller = $bootstrap->createController();
if ($controller) {
    
    $controller->executeAction();
} else {
    die("<h1>Controller creation failed</h1>");
}



