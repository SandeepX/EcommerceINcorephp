<?php


class Order extends Database{
	public function __construct(){
		Database::__construct();
		$this->table('orders');
	}

	public function addOrder($data){
		return $this->insert($data);
	}
}