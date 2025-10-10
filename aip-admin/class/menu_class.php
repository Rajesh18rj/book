<?php

require_once "db_config.php";


class DB_menu_conn
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


class Menuscript
{
		protected $db;
		public function __construct()
		{
			$this->db = new DB_menu_conn();
			$this->db = $this->db->ret_obj();
		}

	public function fetch_menu()
	{
		//echo "k";

		

		//checking if the username or email is available in db
		$query = "SELECT * FROM `manuscript`";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		

	    return $result;
		
	}

    public function add_menu($Fname, $Lname, $email, $phone, $address, $book_title, $gender, $file_url){
		
        
	

        $query = "INSERT INTO `manuscript`(`first_name`, `last_name`, `email`, `phone`, `address`, `book_title`, 
		`genre`, `file_url`, `is_active`) 
		VALUES (?,?,?,?,?,?,?,?,1)";
			
			$stmt = $this->db->prepare($query);
			$stmt->bind_param("ssssssss", $Fname, $Lname, $email, $phone, $address, $book_title, $gender, $file_url);

			try {
				$stmt->execute();
				return array(
					'status' => true,
					'message' => 'Menu Created successfully with file upload.'
				);
			} catch (mysqli_sql_exception $e) {
				// Check for unique constraint violation
				if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
					return array(
						'status' => false,
						'message' => 'A record with this Email OR Phone Number already exists.'
					);
				} else {
					return array(
						'status' => false,
						'message' => 'Failed to update Menu details: ' . $e->getMessage()
					);
				}
			}

	}

	

    public function fetch_one_record($id){
        $query = "SELECT * FROM manuscript WHERE id='$id' ";

		$result = $this->db->query($query) or die($this->db->error);
		return $result;
    }

	

    public function update_menu($Fname, $Lname, $email, $phone, $address, $book_title, $gender, $file_url,$active,$id){
		
        
	

		$query = "UPDATE `manuscript` SET `first_name`=?,`last_name`=?,`email`=?,`phone`=?,`address`=?,
		`book_title`=?,`genre`=?,`file_url`=?, `is_active` =? WHERE `id` = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sssssssssi", $Fname, $Lname, $email, $phone, $address, $book_title, $gender, $file_url,$active , $id);

		try {
			$stmt->execute();
			return array(
				'status' => true,
				'message' => 'Menu Updated successfully with file upload.'
			);
		} catch (mysqli_sql_exception $e) {
			// Check for unique constraint violation
			if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
				return array(
					'status' => false,
					'message' => 'A record with this Email OR Phone Number already exists.'
				);
			} else {
				return array(
					'status' => false,
					'message' => 'Failed to update Menu details: ' . $e->getMessage()
				);
			}
		}

	}

	

	public function delete($id_delete){
		$query = "DELETE FROM `manuscript` WHERE id = '$id_delete'";

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




