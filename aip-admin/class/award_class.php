<?php

include_once("db_config.php");


class DB_conn
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


class Awrd
{
		protected $db;
		public function __construct()
		{
			$this->db = new DB_conn();
			$this->db = $this->db->ret_obj();
		}

	public function fetch_award()
	{
		//echo "k";

		

		//checking if the username or email is available in db
		$query = "SELECT * FROM `awards` ORDER BY id DESC";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		

			return $result;
		
	}

	public function add_ward($name, $award_type, $department, $college, $year, $file){
		$targetDirectory = "uploads/award_images/";
        $allowedTypes = ["jpg", "jpeg", "png"];
        $maxSize = 1048576;

		$fileName = "file_".time().basename($file['name']);
        $targetFilePath = $targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

		if ($file["size"] > $maxSize) {

			return array(
				'status' => false,
				'message' => 'Sorry, your file is too large. Max : 1 MB'
			);

            
        }

		if (!in_array($fileType, $allowedTypes)) {
			return array(
				'status' => false,
				'message' => 'Sorry, only JPG, JPEG, PNG  files are allowed.'
			);

           
        }

			if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
					$query = "INSERT INTO `awards`(`name`, `award_type`, `department`, `college`, `year`, `imagelist`, `is_active`) 
					VALUES (?, ?, ?, ?, ?, ?, 1)";
				
				$stmt = $this->db->prepare($query);
				$stmt->bind_param("ssssss", $name, $award_type, $department, $college, $year, $fileName);

				try {
					$stmt->execute();
					return array(
						'status' => true,
						'message' => 'Award updated successfully with file upload.'
					);
				} catch (mysqli_sql_exception $e) {
					// Check for unique constraint violation
				
						return array(
							'status' => false,
							'message' => 'Failed to update award details: ' . $e->getMessage()
						);
					
				}
			} else {

				return array(
					'status' => false,
					'message' => 'Sorry, there was an error uploading your file.'
				);
			}
		

		

		

			


	}

	public function fetchoneaward($id){
		$query = "SELECT * FROM awards WHERE id='$id' ";

		$result = $this->db->query($query) or die($this->db->error);
		return $result;
	
	}

	public function update_ward($name, $award_type, $department, $college, $year, $file,$hidden_image,$active,$id){
		
		if(!empty($file["name"])){
			$targetDirectory = "uploads/award_images/";
			$allowedTypes = ["jpg", "jpeg", "png"];
			$maxSize = 1048576;

			$fileName = "file_".time().basename($file['name']);
			$targetFilePath = $targetDirectory . $fileName;
			$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

			if ($file["size"] > $maxSize) {
				return "Sorry, your file is too large.";
			}

			if (!in_array($fileType, $allowedTypes)) {
				return "Sorry, only JPG, JPEG, PNG  files are allowed.";
			}
			$oldImagePath = 'uploads/award_images/'.$hidden_image;
			if (file_exists($oldImagePath)) {
				unlink($oldImagePath);
			}

			if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
					
				
			} else {

				return array(
					'status' => false,
					'message' => 'Sorry, there was an error uploading your file.'
				);
			}

			
	
			
		}else{
			$fileName = $hidden_image;
		}

		

		

		
			$query = "UPDATE `awards` SET `name` = ?, `award_type` = ?, `department` = ?, `college` = ?, `year` = ?, `imagelist` = ?,`is_active` = ? WHERE `id` = ?";

			$stmt = $this->db->prepare($query);
			$stmt->bind_param("sssssssi", $name, $award_type, $department, $college, $year, $fileName, $active, $id);


			try {
				$stmt->execute();
				return array(
					'status' => true,
					'message' => 'Award updated successfully with file upload.'
				);
			} catch (mysqli_sql_exception $e) {
				// Check for unique constraint violation
				
					return array(
						'status' => false,
						'message' => 'Failed to update award details: ' . $e->getMessage()
					);
				
			}






			// if ($stmt->execute()) {
			// 	return "Award updated successfully with file upload.";
			// } else {
			// 	if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
			// 		return array(
			// 			'status' => false,
			// 			'message' => 'Name already exists.'
			// 		);
			// 	} else {
			// 		return array(
			// 			'status' => false,
			// 			'message' => 'Failed to add Award: ' . $stmt->error
			// 		);
			// 	}
			// }
		
		
		
		

			

	}

	public function delete($id_delete){
		$query = "DELETE FROM `awards` WHERE id = '$id_delete'";

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




