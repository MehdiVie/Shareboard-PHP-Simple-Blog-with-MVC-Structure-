<?php
class Users extends Controller{
	protected function register() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register() , true);
	}

	protected function login() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->login() , true);
	}

	protected function logout() {
	    //die("Logout function is being called!"); // Debugging output to check if it runs

	    session_start();
	    session_unset();
	    session_destroy();
	    header("Location: " . ROOT_URL . "users/login");
	    exit();
	}
	
}