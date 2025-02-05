<?php


class UserModel extends Model{
	public function register(){
				// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


		if(isset($post['submit'])){

			if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			$password = isset($post['password']) ? md5($post['password']) : null;

			// Insert into MySQL
			$this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
			$this->bind(':name', $post['name']);
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'users/login');
			}
		}
		return;
	}

	public function login(){
				// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = isset($post['password']) ? md5($post['password']) : null;

		if(isset($post['submit'])){

			// Insert into MySQL
			$this->query('SELECT * FROM users WHERE (email = :email AND password = :password )');
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			$this->execute();
			// Verify
			$row = $this->single();
			if($row){
				// Redirect

				$_SESSION['is_logged_in'] = true ; 
				$_SESSION['user_data'] = array(
					"id" => $row['id'] , 
					"email" => $row['email'] , 
					"name" => $row['name']
				);
				//print_r($_SESSION['user_logged_in']);
				
				header('Location: '.ROOT_URL.'shares');
				exit();
				
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}


}