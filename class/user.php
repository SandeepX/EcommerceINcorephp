<?php


class User extends Database{
	public function __construct(){
		Database::__construct();
		$this->table('users');
	}

	public function getUserByUserName($user_name, $is_die=false){
		/*$sql = "SELECT * FROM users WHERE email = '".$user_name."'"; */
		$args = array(
				'fields'	=> 'id, full_name, email, password, status, role',
				 'where'		=> "email = '".$user_name."'"
				/*'where'		=> array(	
									'email'		=>$user_name
								)*/
				// 'fields'	=> array('id', 'full_name', 'email', 'password', 'status', 'role')
		);

		return $this->select($args, $is_die);

	}

	public function updateUser($data, $user_id, $is_die = false){
		$args = array('where'	=> array('id'=>$user_id));
		return $this->update($data, $args, $is_die);
	}

	public function getUserBySession($api_token, $is_die = false){
		$args = array(
				'where'	=> array(
						'api_token' => $api_token
				)
		);

		return $this->select($args, $is_die);
	}

	public function addUser($data){
		return $this->insert($data);
	}
}