<?php


class UserModel extends Model{
	public function register(){
				// Sanitize POST
		$post = filter_input_array(INPUT_POST, [
		    'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		    'email' => FILTER_SANITIZE_EMAIL,
		    'password' => FILTER_DEFAULT // No sanitization for passwords (hashing is enough)
		]);


		if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
			
			if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			$password = password_hash($post['password'], PASSWORD_DEFAULT);

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
	    $post = filter_input_array(INPUT_POST, [
	        'email' => FILTER_SANITIZE_EMAIL,
	        'password' => FILTER_DEFAULT // No sanitization for passwords (hashing is enough)
	    ]);

	    // Check if form is submitted
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	        
	        if (empty($post['email']) || empty($post['password'])) {
	            Messages::setMsg('Please Fill In All Fields', 'error');
	            return;
	        }

	        // Fetch user from DB
	        $this->query('SELECT * FROM users WHERE email = :email');
	        $this->bind(':email', $post['email']);
	        $this->execute();
	        $row = $this->single();

	        // Verify password
	        if ($row && password_verify($post['password'], $row['password'])) {
	            $_SESSION['is_logged_in'] = true;
	            $_SESSION['user_data'] = [
	                "id" => $row['id'],
	                "email" => $row['email'],
	                "name" => $row['name']
	            ];

	            header('Location: '.ROOT_URL.'shares');
	            exit();
	        } else {
	            Messages::setMsg('Incorrect Email or Password', 'error');
	        }
	    }
	}



}