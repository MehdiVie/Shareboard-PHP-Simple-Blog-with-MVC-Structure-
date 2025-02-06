<?php
class HomeModel extends Model{
	public function index(){

		$this->query('SELECT shares.*,users.name as user FROM shares INNER JOIN users ON shares.user_id = users.id ORDER BY shares.create_date DESC');
		$rows = $this->resultSet();
		return $rows;
	}
}