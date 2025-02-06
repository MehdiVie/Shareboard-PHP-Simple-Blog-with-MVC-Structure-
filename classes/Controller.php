<?php
abstract class Controller{
	protected $request;
	protected $action;

	public function __construct($action, $request){
		$this->action = $action;
		$this->request = $request;
	}

	public function executeAction() {
	    if (method_exists($this, $this->action)) {
	        
	        return $this->{$this->action}();
	    } else {
	        die("<h1>ERROR: Method '$this->action' does not exist in " . get_class($this) . "</h1>");
	    }
	}


	protected function returnView($viewmodel, $fullview) {
	    $controller = strtolower(get_class($this)); // Ensure lowercase
	    $view = 'views/' . $controller . '/' . $this->action . '.php';

	    

	    if (!file_exists($view)) {
	        die("<h1>ERROR: View file '$view' not found!</h1>");
	    }

	    if ($fullview) {
	        
	        require('views/main.php');
	    } else {
	        require($view);
	    }
	}



}