<?php
session_start();
// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/shares.php');
require('controllers/users.php');

require('models/home.php');
require('models/share.php');
require('models/user.php');


$request = isset($_GET['url']) ? $_GET['url'] : null;
$request = rtrim($request, '/');
$request = filter_var($request, FILTER_SANITIZE_URL);
$params = explode('/', $request);

$controller = isset($params[0]) ? ucwords($params[0]) : 'Home';
$action = isset($params[1]) ? $params[1] : 'index';

$bootstrap = new Bootstrap(['controller' => $controller, 'action' => $action]);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}


