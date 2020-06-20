<?php


class Category extends Database{
	public function __construct(){
		Database::__construct();
		$this->table('categories');
	}

	public function addCategory($data){
		return $this->insert($data);
	}

	public function getAllParents(){
		/* SELECT * FROM categories WHERE is_parent = 1 AND parent_id = 0*/
		$args = array(
			'where' => array(
				'is_parent' => 1,
				'parent_id'	=> 0
			)
		);

		return $this->select($args);
	}

	public function getAllCategories(){
		return $this->select();
	}


	public function getCategoryById($cat_id){
		$args = array(
				'where' => array('id' => $cat_id)
		);
		return $this->select($args);
	}

	public function deleteCategory($cat_id){
		$args = array(
				'where' => array('id' => $cat_id)
		);

		return $this->delete($args);
	}

	public function updateCategory($data, $cat_id){
		$args = array(
				'where' => array('id' => $cat_id)
		);
		return $this->update($data, $args);
	}

	public function getChildByCatId($cat_id){
		$args = array(
				'where'	=> array('parent_id' => $cat_id)
		);

		return $this->select($args);
	}
}