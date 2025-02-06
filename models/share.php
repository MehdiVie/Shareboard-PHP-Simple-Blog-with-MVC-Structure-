
<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT shares.*,users.name as user FROM shares INNER JOIN users ON shares.user_id = users.id ORDER BY shares.create_date DESC');
		$rows = $this->resultSet();
		return $rows;
	}

	public function edit_view($id){
	    $this->query('SELECT shares.*,users.name as user FROM shares INNER JOIN users ON shares.user_id = users.id WHERE (shares.user_id = :user_id and shares.id = :id)');
	    $this->bind(':id', $id);
	    $this->bind(':user_id', $_SESSION['user_data']['id']); // Ensure security
	    return $this->single(); // Returns one row or false
	}

	public function add(){
    // Sanitize POST
	    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	    if(isset($post['submit'])){
	        // Insert into MySQL
	        $this->query('INSERT INTO shares (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
	        $this->bind(':title', $post['title']);
	        $this->bind(':body', $post['body']);
	        $this->bind(':link', $post['link']);
	        $this->bind(':user_id', $_SESSION['user_data']['id']);
	        $this->execute();
	        // Verify
	        if($this->lastInsertId()){
	            // Redirect
	            header('Location: '.ROOT_URL.'shares');
	        }
	    }
	    return;
	}

	public function delete($id){

	    $this->query('DELETE FROM shares WHERE id = :id AND user_id = :user_id');
	    $this->bind(':id', $id);
	    $this->bind(':user_id', $_SESSION['user_data']['id']); // Ensure only the owner can delete
	    $this->execute(); // Execute the query

	    return $this->stmt->rowCount() > 0; // ✅ Correct way to check affected rows
	}

	public function update($id, $title, $body, $link) {
	    $this->query('UPDATE shares SET title = :title, body = :body, link = :link WHERE id = :id AND user_id = :user_id');
	    $this->bind(':id', $id);
	    $this->bind(':title', $title);
	    $this->bind(':body', $body);
	    $this->bind(':link', $link);
	    $this->bind(':user_id', $_SESSION['user_data']['id']); // Ensure only the owner can update

	    $this->execute();

	    return $this->stmt->rowCount() > 0; // Return true if a row was affected
	}

}