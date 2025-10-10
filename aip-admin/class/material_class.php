<?php

require_once "db_config.php";


class DB_material_conn
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


class Material
{
		protected $db;
		public function __construct()
		{
			$this->db = new DB_material_conn();
			$this->db = $this->db->ret_obj();
		}

	public function fetch_material()
	{
		//echo "k";

		

		//checking if the username or email is available in db
		$query = "SELECT * FROM `material`";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		

	    return $result;
		
	}

    public function add_material($materila_name){
        $query = "INSERT INTO `material`(`material_type`, `is_active`) 
				VALUES (?,1)";
			
			$stmt = $this->db->prepare($query);
			$stmt->bind_param("s", $materila_name);

			try {
				$stmt->execute();
				return array(
					'status' => true,
					'message' => 'Material Created successfully with file upload.'
				);
			} catch (mysqli_sql_exception $e) {
				// Check for unique constraint violation
				if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
					return array(
						'status' => false,
						'message' => 'A record with this Name already exists.'
					);
				} else {
					return array(
						'status' => false,
						'message' => 'Failed to Create Material details: ' . $e->getMessage()
					);
				}
			}
    }

    public function fetch_one_record($id){
        $query = "SELECT * FROM material WHERE id='$id' ";

		$result = $this->db->query($query) or die($this->db->error);
		return $result;
    }

    

    public function update_material($materila_name ,$active,$id){
       
		$query = "UPDATE `material` SET `material_type` = ?,`is_active`=? WHERE `id` = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sss", $materila_name,$active ,$id);

		try {
			$stmt->execute();
			return array(
				'status' => true,
				'message' => 'Material Updated successfully with file upload.'
			);
		} catch (mysqli_sql_exception $e) {
			// Check for unique constraint violation
			if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
				return array(
					'status' => false,
					'message' => 'A record with this Name already exists.'
				);
			} else {
				return array(
					'status' => false,
					'message' => 'Failed to Updated Material details: ' . $e->getMessage()
				);
			}
		}
    }

    public function delete($id_delete){
		$query = "DELETE FROM `material` WHERE id = '$id_delete'";

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




