<?php


abstract class Database{
	protected $conn = null;
	protected $stmt = null;
	protected $table = null;

	protected $sql = null;

	public function __construct(){
		try{
			/*Db Connection*/
			$this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', DB_USER, DB_PWD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->stmt = $this->conn->prepare("SET NAMES utf8");
			$this->stmt->execute();

		} catch(PDOException $e){
			$message = date('Y-m-d h:i:s A').", Database(Connection): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){
			$message = date('Y-m-d h:i:s A').", Database(General): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		}
	}

	public final function table($_table){
		$this->table = $_table;
	}

	public final function select($args = array(), $is_die = false){
		try{
			/*
				SELECT fields FROM table 
				join statement
				WHERE clause
				GROUP BY clause
				ORDER BY clause
				LIMIT start, count
			*/

			$this->sql = "SELECT ";


			if(isset($args['fields']) && !empty($args['fields'])){
				if(is_string($args['fields'])){
					$this->sql .= $args['fields'];
				} else {
					$this->sql .= implode(", ",$args['fields']);
				}
			} else {
				$this->sql .= ' * ';
			}

			$this->sql .= " FROM ";


			if(!isset($this->table) || empty($this->table)){
				throw new Exception('Table not set');
			}

			$this->sql .= $this->table;


			/*Join Clause*/
			if(isset($args['join']) && !empty($args['join'])){
				$this->sql .= " ".$args['join'];
			}
			/*Join Clause*/

			/*WHERE Clause*/
			if(isset($args['where']) && !empty($args['where'])){
				if(is_string($args['where'])){
					$this->sql .= " WHERE ".$args['where'];
				} else {

					$temp = array();
					foreach($args['where'] as $column_name => $value){
						$str = $column_name." = :".$column_name;
						$temp[] = $str;
					}

					$this->sql .= " WHERE ".implode(" AND ", $temp);
				}
			}
			/*WHERE Clause*/


			/*GROUP BY Clause*/
			if(isset($args['group_by']) && !empty($args['group_by'])){
				$this->sql .= " GROUP BY ".$args['group_by'];
			}
			/*GROUP BY Clause*/


			/*Order BY Clause*/
			if(isset($args['order_by']) && !empty($args['order_by'])){
				$this->sql .= " ORDER BY ".$args['order_by'];
			} else {
				$this->sql .= " ORDER BY ".$this->table.".id DESC ";
			}
			/*Order BY Clause*/

			/*LIMIT Clause*/
			/*LIMIT Clause*/

			if($is_die){

				echo $this->sql;
				debugger($args, true);
			}


			$this->stmt = $this->conn->prepare($this->sql);


			if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
				foreach($args['where'] as $column_name=>$value){
					if(is_int($value)){
						$param = PDO::PARAM_INT;
					} else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					} else if(is_null($value)){
						$param = PDO::PARAM_NULL;
					} else {
						$param = PDO::PARAM_STR;
					}


					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
				}
			}


			$this->stmt->execute();

			$data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;
		}  catch(PDOException $e){
			$message = date('Y-m-d h:i:s A').", Database(Select): SQL(".$this->sql.")".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){
			$message = date('Y-m-d h:i:s A').", Database(Select): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		}
	}

	public final function insert($data, $is_die = false){
		try{
			
				$this->sql = "INSERT INTO ";

				if(!isset($this->table) || empty($this->table)){
					throw new Exception('Table not set');
				}

				$this->sql .= $this->table;

				$this->sql .= " SET ";


				/*Data*/
				if(isset($data) && !empty($data)){
					if(is_string($data)){
						$this->sql .= $data;
					} else {

						$temp = array();
						foreach($data as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}

						$this->sql .= implode(", ", $temp);
					}
				}
				/*Data*/

				if($is_die){
					echo $this->sql;
					debugger($data, true);
				}


				$this->stmt = $this->conn->prepare($this->sql);

				/*Bind Value*/
				if(isset($data) && !empty($data) && is_array($data)){
					foreach($data as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} else if(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} else if(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else {
							$param = PDO::PARAM_STR;
						}


						if($param){
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}

				$this->stmt->execute();
				$insert_id = $this->conn->lastInsertId();
				return $insert_id;
		}  catch(PDOException $e){
			$message = date('Y-m-d h:i:s A').", Database(INSERT): SQL(".$this->sql.")".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){
			$message = date('Y-m-d h:i:s A').", Database(INSERT): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		}
	}

	public final function update($data, $args = array(), $is_die = false){
		try{
			/*
				UPDATE table SET 
					column_name_1 = :column_name_1,
					column_name_2	= :column_name_2,
					................
				WHERE condition

			*/
				$this->sql = "UPDATE ";

				if(!isset($this->table) || empty($this->table)){
					throw new Exception('Table not set');
				}

				$this->sql .= $this->table;

				$this->sql .= " SET ";


				/*Data*/
				if(isset($data) && !empty($data)){
					if(is_string($data)){
						$this->sql .= $data;
					} else {

						$temp = array();
						foreach($data as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}

						$this->sql .= implode(", ", $temp);
					}
				}
				/*Data*/

				/*WHERE Clause*/
				if(isset($args['where']) && !empty($args['where'])){
					if(is_string($args['where'])){
						$this->sql .= " WHERE ".$args['where'];
					} else {

						$temp = array();
						foreach($args['where'] as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp[] = $str;
						}

						$this->sql .= " WHERE ".implode(" AND ", $temp);
					}
				}
				/*WHERE Clause*/

				if($is_die){
					echo $this->sql;
					debugger($data);
					debugger($args, true);
				}


				$this->stmt = $this->conn->prepare($this->sql);

				/*Bind Value*/
				if(isset($data) && !empty($data) && is_array($data)){
					foreach($data as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} else if(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} else if(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else {
							$param = PDO::PARAM_STR;
						}


						if($param){
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}


				if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
					foreach($args['where'] as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} else if(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} else if(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else {
							$param = PDO::PARAM_STR;
						}


						if($param){
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}

				$success = $this->stmt->execute();
				return $success;
		}  catch(PDOException $e){
			$message = date('Y-m-d h:i:s A').", Database(Update): SQL(".$this->sql.")".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){
			$message = date('Y-m-d h:i:s A').", Database(Update): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		}
	}

	public final function delete($args = array(), $is_die = false){

		try{
			/*
				DELETE FROM table 
				WHERE clause
			*/

			$this->sql = "DELETE FROM ";

			if(!isset($this->table) || empty($this->table)){
				throw new Exception('Table not set');
			}

			$this->sql .= $this->table;

			/*WHERE Clause*/
			if(isset($args['where']) && !empty($args['where'])){
				if(is_string($args['where'])){
					$this->sql .= " WHERE ".$args['where'];
				} else {

					$temp = array();
					foreach($args['where'] as $column_name => $value){
						$str = $column_name." = :".$column_name;
						$temp[] = $str;
					}

					$this->sql .= " WHERE ".implode(" AND ", $temp);
				}
			}
			/*WHERE Clause*/

			if($is_die){

				echo $this->sql;
				debugger($args, true);
			}


			$this->stmt = $this->conn->prepare($this->sql);


			if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
				foreach($args['where'] as $column_name=>$value){
					if(is_int($value)){
						$param = PDO::PARAM_INT;
					} else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					} else if(is_null($value)){
						$param = PDO::PARAM_NULL;
					} else {
						$param = PDO::PARAM_STR;
					}


					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
				}
			}


			return $this->stmt->execute();

		}  catch(PDOException $e){
			$message = date('Y-m-d h:i:s A').", Database(Select): SQL(".$this->sql.")".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){
			$message = date('Y-m-d h:i:s A').", Database(Select): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_PATH."error.log");
			return false;
		}
	}
}