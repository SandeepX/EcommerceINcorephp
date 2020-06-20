<?php 

	class ProductImages extends Database{
		public function __construct(){
			Database::__construct();
			$this->table('product_images');
		}

		public function addImage($data){
			return $this->insert($data);
		}
	}