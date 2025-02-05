<?php
class Bootstrap{
	private $controller;
	private $action;
	private $request;

	public function __construct($request){
	    $this->request = array_merge($_GET, $_POST); // Ensure GET parameters are properly merged

	    $this->controller = !empty($this->request['controller']) ? $this->request['controller'] : 'home';
	    $this->action = !empty($this->request['action']) ? $this->request['action'] : 'index';

	    /*echo "Controller: " . $this->controller . "<br>";
	    echo "Action: " . $this->action . "<br>";
	    exit();*/
	}


	public function createController(){
	    $controllerName = ucwords($this->controller); // Capitalize first letter
	    $controllerFile = 'controllers/' . $controllerName . '.php';

	    if(file_exists($controllerFile)){
	        require_once($controllerFile);
	        $parents = class_parents($controllerName);

	        if(in_array("Controller", $parents)){
	            if(method_exists($controllerName, $this->action)){
	                return new $controllerName($this->action, $this->request);
	            } else {
	                die('<h1>Method "'.$this->action.'" does not exist in '.$controllerName.'</h1>');
	            }
	        } else {
	            die('<h1>Base controller not found</h1>');
	        }
	    } else {
	        die('<h1>Controller "'.$controllerName.'" does not exist</h1>');
	    }
	}

}