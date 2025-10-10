<?php

require_once "db_config.php";


class DB_product_conn
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


class Product
{
		protected $db;
		public function __construct()
		{
			$this->db = new DB_product_conn();
			$this->db = $this->db->ret_obj();
		}

	public function fetch_product()
	{
		//echo "k";

		

		//checking if the username or email is available in db
		$query = "SELECT * FROM products ORDER BY id DESC";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		

			return $result;
		
	}

	public function add_product($name,$sqft_price,$category,$author,$isbn_no,$file){
		$targetDirectory = "uploads/product_images/";
        $allowedTypes = ["jpg", "jpeg", "png"];
        $maxSize = 1048576;
	
 		//$fileName =$file['name'];
		 $fileName = "file_".time().basename($file['name']);
        $targetFilePath = $targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

		if ($file["size"] > $maxSize) {
			return array(
				'status' => false,
				'message' => 'Sorry, your file is too large.'
			);
		}

		if (!in_array($fileType, $allowedTypes)) {
			return array(
				'status' => false,
				'message' => "Sorry, only JPG, JPEG, PNG  files are allowed."
			);
            
        }
		
		
		
		if (move_uploaded_file($file["tmp_name"], $targetFilePath)){
				$query = "INSERT INTO `products`(`name`, `sqft_price`, `category`, `material`, `group_name`, `imagelist`, `is_active`) 
				VALUES (?,?,?,?,?,?,1)";
			//$prefix = '["';
			//$suffix = '"]';
			
			
			$stmt = $this->db->prepare($query);
			$stmt->bind_param("ssssss", $name, $sqft_price, $category,$author, $isbn_no, $fileName);

			try {
				$stmt->execute();
				return array(
					'status' => true,
					'message' => 'Product Created successfully with file upload.'
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
		} else {

			return array(
				'status' => false,
				'message' => 'Sorry, there was an error uploading your file. '
			);
			
		}

		

			


	}

	public function fetchoneproduct($id){
		$query = "SELECT * FROM products WHERE id='$id' ";

		$result = $this->db->query($query) or die($this->db->error);
		return $result;
	
	}

	public function update_product($name,$sqft_price,$category,$author,$hidden_image,$isbn_no,$file,$active,$id){
		
		if(!empty($file["name"])){
			$targetDirectory = "uploads/product_images/";
			$allowedTypes = ["jpg", "jpeg", "png"];
			$maxSize = 1048576;

			$fileName = "file_".time().basename($file['name']);
			$targetFilePath = $targetDirectory . $fileName;
			$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
			
			if ($file["size"] > $maxSize) {

				return array(
					'status' => false,
					'message' => 'Sorry, your file is too large.'
				);

				
			}

			if (!in_array($fileType, $allowedTypes)) {

				return array(
					'status' => false,
					'message' => 'Sorry, only JPG, JPEG, PNG  files are allowed.'
				);
				
			}
			$oldImagePath = 'uploads/product_images/'.$hidden_image;
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
		
		
		$query = "UPDATE `products` SET `name`=?, `sqft_price`=?, `category`=?, `material`=?, `group_name`=?, `imagelist`=?, `is_active`=? WHERE `id`=?";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sssssssi", $name, $sqft_price, $category, $author, $isbn_no, $fileName, $active, $id);

		try {
			$stmt->execute();
			return array(
				'status' => true,
				'message' => 'Product Updated successfully with file upload.'
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
					'message' => 'Failed to Updated Product details: ' . $e->getMessage()
				);
			}
		}

			

	}

	public function delete($id_delete){
		$query = "DELETE FROM `products` WHERE id = '$id_delete'";

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

	public function fetch_category(){
		$query = "SELECT * FROM `category`" ;

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;
		return $result;
	}




}




