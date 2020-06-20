<?php 

	class Product extends Database{
		public function __construct(){
			Database::__construct();
			$this->table('products');
		}

		public function addProduct($data){
			return $this->insert($data);
		}

		public function deleteProduct($product_id){
		
		
		$args = array(
				'where' => array('id' => $product_id)
		);

		return $this->delete($args);
	}
		

		public function getAllProducts(){
			$args = array(
					'fields' => array(
										'products.id',
										'products.title',
										'products.cat_id',
										'products.price',
										'products.discount',
										'products.status',
										'categories.title as cat_title',
										'(SELECT title FROM categories WHERE categories.id = products.child_cat_id) AS child_cat_title'
									),
					'join'	=> "LEFT JOIN categories ON products.cat_id = categories.id"
			);
			return $this->select($args);
		}

		public function getAllProduct(){
			$args = array(
					'fields' => array(
										'products.id',
										'products.title',
										'products.cat_id',
										'products.price',
										'products.discount',
										'products.status',
										'product_images.image_name',
									),
					'join'	=> "LEFT JOIN categories ON products.cat_id = categories.id",
					'join'	=> "LEFT JOIN product_images ON products.id = product_images.product_id",
					'where' =>"products.discount >='10' "
					 
			);
			return $this->select($args);
		}

		public function getSearchResult($search, $is_die =false){

			$where = " products.status = 'Active' ";

			/*Search*/
			if(isset($search['keyword']) && !empty($search['keyword'])){
				$where .= " AND (	products.title LIKE '%".$search['keyword']."%' OR 
									products.summary LIKE '%".$search['keyword']."%' OR
									products.description LIKE '%".$search['keyword']."%') ";
			}
			

			if(isset($search['cat_id']) && !empty($search['cat_id']) && $search['cat_id'] > 0){
				$where .= " AND products.cat_id = ".$search['cat_id'];
			}
			//debugger($search, true);

			if(isset($search['min_price']) && !empty($search['min_price']) && $search['min_price'] > 0){
				$where .= " AND products.price >= ".$search['min_price'];
			}


			if(isset($search['max_price']) && !empty($search['max_price']) && $search['max_price'] > 0){
				$where .= " AND products.price <= ".$search['max_price'];
			}

			if(isset($search['brand']) && !empty($search['brand'])){
				$where .= " AND products.brand LIKE '%".$search['brand']."%'";
			}

			$order_by = 'products.price DESC';

			if(isset($search['order_by']) && !empty($search['order_by'])){
				$order_by = $search['order_by'];
			}

			$args = array(
				'fields' => array(
								'products.id',
								'products.title',
								'products.price',
								'products.discount',
								'product_images.image_name',
								'products.added_date',
								'(SELECT count(id) FROM product_reviews WHERE product_id = products.id)  as total_reviewer',
								'(SELECT SUM(rate) FROM product_reviews WHERE product_id = products.id)  as total_rate' 
							),
				'join'	=> "LEFT JOIN product_images ON products.id = product_images.product_id",
				'group_by'	=> ' products.id ',
				'where' => $where,
				'order_by'	=> $order_by
			);
			return $this->select($args, $is_die);
		}

		public function getAllBrands(){

			$args = array(
					'fields' => 'distinct (brand)'
			);

			return $this->select($args);
		}  

		public function getAllbranded(){
			$args = array(
					'fields' => array(
										'products.id',
										'products.title',
										'products.cat_id',
										'products.price',
										'products.discount',
										'products.status',
										'product_images.image_name',
										'products.brand',
										'products.added_date',
										'(SELECT count(id) FROM product_reviews WHERE product_id = products.id)  as total_reviewer',
										'(SELECT SUM(rate) FROM product_reviews WHERE product_id = products.id)  as total_rate',

									),
					'join'	=> "LEFT JOIN categories ON products.cat_id = categories.id",
					'join'	=> "LEFT JOIN product_images ON products.id = product_images.product_id",
					'where' => " products.brand != '' "

			);
			return $this->select($args);
		}

		public function getAllfeatured(){
			$args = array(
					'fields' => array(
										'products.id',
										'products.title',
										'products.cat_id',
										'products.price',
										'products.discount',
										'products.status',
										'product_images.image_name',
										'products.brand',
										'products.added_date',
										'(SELECT count(id) FROM product_reviews WHERE product_id = products.id)  as total_reviewer',
										'(SELECT SUM(rate) FROM product_reviews WHERE product_id = products.id)  as total_rate',

									),
					'join'	=> "LEFT JOIN categories ON products.cat_id = categories.id",
					'join'	=> "LEFT JOIN product_images ON products.id = product_images.product_id",
					'where' => " products.is_featured != '0' "

			);
			return $this->select($args);
		}


		public function getProductById($id){
			$args = array(
					'fields' => array(
									'products.id',
									'products.title',
									'products.price',
									'products.discount',
									'product_images.image_name',
									'products.added_date',
									'products.delivery_cost'
								),
					'join'	=> "LEFT JOIN product_images ON products.id = product_images.product_id",
					'group_by'	=> ' products.id ',
					'where' => "products.id = ".$id
			);
			return $this->select($args);
		}
	}

