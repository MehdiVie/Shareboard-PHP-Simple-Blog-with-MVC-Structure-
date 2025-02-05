<?php
class Shares extends Controller{
	protected function Index(){
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function add(){
		if (!isset($_SESSION['is_logged_in'])) {
			header('Location: '.ROOT_URL.'shares');
		}
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function edit_view(){
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	        die('<h1>Invalid request method</h1>');
	    }

	    if (!isset($_POST['postId'])) {
	        header('Location: '.ROOT_URL.'shares');
	        exit();
	    }

	    $viewmodel = new ShareModel();
	    $share = $viewmodel->edit_view($_POST['postId']);

	    if (!$share) {
	        die('<h1>Post not found or access denied</h1>');
	    }

	    // Check if "edit=true" was passed
	    $editMode = !empty($_POST['edit_mode']) && $_POST['edit_mode'] === 'true';

	    // Pass the edit flag to the view
	    $this->returnView(['share' => $share, 'edit' => $editMode ? 1 : 0], true);
	}

	protected function delete(){

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('<h1>Invalid request method</h1>');
    }

    if (!isset($_POST['postId'])) {
        header('Location: '.ROOT_URL.'shares');
        exit();
    }

    $viewmodel = new ShareModel();
    $result = $viewmodel->delete($_POST['postId']);

    if ($result) {
        header('Location: '.ROOT_URL.'shares'); // ✅ Redirect if delete was successful
        exit();
    } else {
        die('<h1>Error: Post was deleted but system failed to verify!</h1>');
    }
	}

	protected function edit(){
	    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	        die('<h1>Invalid request method</h1>');
	    }

	    if (!isset($_POST['postId']) || empty($_POST['title']) || empty($_POST['body'])) {
	        header('Location: '.ROOT_URL.'shares');
	        exit();
	    }

	    $viewmodel = new ShareModel();
	    $result = $viewmodel->update($_POST['postId'], $_POST['title'], $_POST['body'], $_POST['link']);

	    if ($result) {
	        header('Location: '.ROOT_URL.'shares'); // Redirect to shares list after update
	        exit();
	    } else {
	        die('<h1>Error: Unable to update the post.</h1>');
	    }
	}



}