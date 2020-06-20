<?php


class Banner extends Database{
	public function __construct(){
		Database::__construct();
		$this->table('banners');
	}

	public function getAllBanner(){
		return $this->select();	
	}

	public function addBanner($data, $is_die = false){
		return $this->insert($data, $is_die);
	}

	public function getBannerById($id){
		$args = array(
				'where'	=> array(
					'id' => $id
				)
		);
		return $this->select($args);
	}

	public function deleteBanner($id){
		/*DELETE FROM banners WHERE id = $id*/
		$args = array(
				'where'	=> array(
						'id'	=> $id
					)
			);

		return $this->delete($args);
	}

	public function updateBanner($data, $banner_id, $is_die =false){
		$args = array(
				'where'	=> array(
						'id'	=> $banner_id
					)
			);
		return $this->update($data, $args, $is_die);
	}
}