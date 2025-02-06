<?php
class Bootstrap{
	private $controller;
	private $action;
	private $request;

	public function __construct($request){
	    $this->request = array_merge($_GET, $_POST); // Ensure GET parameters are properly merged

		$this->controller = isset($request['controller']) && !empty($request['controller']) ? ucwords($request['controller']) : 'Home';
		$this->action = isset($request['action']) && !empty($request['action']) ? $request['action'] : 'index';

	}


	public function createController() {
	    $controllerName = ucwords($this->controller); // Capitalize first letter
	    $controllerFile = 'controllers/' . $controllerName . '.php';

	    if (file_exists($controllerFile)) {
	        
	        require_once($controllerFile);

	        if (class_exists($controllerName)) {
	            

	            $parents = class_parents($controllerName);


	            if (in_array("Controller", $parents)) {
	                if (method_exists($controllerName, $this->action)) {
	                    
	                    return new $controllerName($this->action, $this->request);
	                } else {
	                    die("<h1>ERROR: Method '{$this->action}' does not exist in '$controllerName'</h1>");
	                }
	            } else {
	                die("<h1>ERROR: Base controller 'Controller' not found in '$controllerName'</h1>");
	            }
	        } else {
	            die("<h1>ERROR: Class '$controllerName' does not exist</h1>");
	        }
	    } else {
	        die("<h1>ERROR: Controller file '$controllerFile' does not exist</h1>");
	    }

	    return null; // Fallback return
	}


}