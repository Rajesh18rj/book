<?php

include_once("db_config.php");


class DB_cate_conn
{

	public $connection;
	function __construct()
	{
		$this->connection = new mysqli(db_host, db_user, db_pass, db_name);


		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
	}

	function ret_obj()
	{
		return $this->connection;
	}
}


class Category
{
		protected $db;
		public function __construct()
		{
			$this->db = new DB_cate_conn();
			$this->db = $this->db->ret_obj();
		}

	public function fetch_category()
	{
		//echo "k";

		

		//checking if the username or email is available in db
		$query = "SELECT * FROM `category`";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		

	    return $result;
		
	}

    public function add_category($cate_name){
        $query = "INSERT INTO `category`(`category_name`, `is_active`) 
				VALUES (?,1)";
			
			$stmt = $this->db->prepare($query);
			$stmt->bind_param("s", $cate_name);

			try {
				$stmt->execute();
				return array(
					'status' => true,
					'message' => 'Category Insert successfully .'
				);
			} catch (mysqli_sql_exception $e) {
				// Check for unique constraint violation
				if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
					return array(
						'status' => false,
						'message' => 'A record with this Category name already exists.'
					);
				} else {
					return array(
						'status' => false,
						'message' => 'Failed to update category details: ' . $e->getMessage()
					);
				}
			}
    }

    public function fetch_one_record($id){
        $query = "SELECT * FROM category WHERE id='$id' ";

		$result = $this->db->query($query) or die($this->db->error);
		return $result;
    }

    

    public function update_category($cate_name , $active, $id){
       
		$query = "UPDATE `category` SET `category_name` = ? ,`is_active` = ? WHERE `id` = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sss", $cate_name ,$active,$id);

		try {
			$stmt->execute();
			return array(
				'status' => true,
				'message' => 'Category Updated successfully .'
			);
		} catch (mysqli_sql_exception $e) {
			// Check for unique constraint violation
			if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
				return array(
					'status' => false,
					'message' => 'A record with this Category name already exists.'
				);
			} else {
				return array(
					'status' => false,
					'message' => 'Failed to update category details: ' . $e->getMessage()
				);
			}
		}
    }

    public function delete($id_delete){
		$query = "DELETE FROM `category` WHERE id = '$id_delete'";

		$result = $this->db->query($query) or die($this->db->error);
		if($result){
			return array(
				'status' => true,
				'message' => 'A record Deleted Successfully.'
			);
		} else {
			return array(
				'status' => false,
				'message' => 'A record Deleted Failed ' . $e->getMessage()
			);
		}
	
	}




}




