
<?php

require_once "db_config.php";

class DB_quotation
{
	// DB Construct Function
	function __construct(){
		$conn = mysqli_connect(db_host,db_user,db_pass,db_name);
		$this->dbs = $conn;

		if(mysqli_connect_errno()){
			echo "Error connecting DB". mysqli_connect_errno();
		}		
	}

	//Data Insertion Function
	public function insert($signed, $name, $email, $phone, $address, $inscope, $outscope, $addendums, $payment, $status){

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM quotation WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows
	
		$signed = $this->dbs->real_escape_string($signed);
		$name = $this->dbs->real_escape_string($name);
		$email = $this->dbs->real_escape_string($email);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		$inscope = $this->dbs->real_escape_string($inscope);		
		$outscope = $this->dbs->real_escape_string($outscope);
		$addendums = $this->dbs->real_escape_string($addendums);
		$payment = $this->dbs->real_escape_string($payment);		

		if($count_row == 0){				
			$insert_data = mysqli_query($this->dbs, "INSERT INTO quotation(signed,name,email,phone,address,inscope,outscope,addendums,payment,status)VALUES('$signed','$name','$email','$phone','$address','$inscope','$outscope','$addendums','$payment','$status')");
			return $insert_data;			

		}
		else		{
			echo "Email already exist. &nbsp;";
		}
	}

	//Data updation Function
	public function update($id, $signed, $name, $phone, $address, $inscope, $outscope, $addendums, $payment, $status){

		$signed = $this->dbs->real_escape_string($signed);
		$name = $this->dbs->real_escape_string($name);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		$inscope = $this->dbs->real_escape_string($inscope);		
		$outscope = $this->dbs->real_escape_string($outscope);
		$addendums = $this->dbs->real_escape_string($addendums);
		$payment = $this->dbs->real_escape_string($payment);
		

		$update_data = mysqli_query($this->dbs, "UPDATE quotation SET signed='$signed', name='$name', phone='$phone', address='$address', inscope='$inscope', outscope='$outscope', addendums='$addendums', payment='$payment', status='$status' WHERE id='$id'");

			return $update_data;
		
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM quotation WHERE id=$id");

		return $delete_data;		
	}
		
	//quotation List View function
	public function list_quotation(){
		$list_quotation = mysqli_query($this->dbs, "SELECT * FROM quotation");
		return $list_quotation;
	}

	//quotation List View function
	public function quotation_last1(){
		$quotation = mysqli_query($this->dbs, "SELECT * FROM quotation ORDER BY id DESC LIMIT 1");
		return $quotation;
	}

	//quotation List View function
	public function quotation_year($y1){
		$quotation = mysqli_query($this->dbs, "SELECT * FROM quotation WHERE year='$y1' ORDER BY id DESC LIMIT 1");
		return $quotation;
	}
	
	//quotation List View with status function
	public function list_quotation_status(){
		$list_quotation = mysqli_query($this->dbs, "SELECT * FROM quotation WHERE id!=1 AND status = 1");
		return $list_quotation;
	}

	//quote_price List View function
	public function list_quote_price($id){
		$list_quotation = mysqli_query($this->dbs, "SELECT * FROM quote_price WHERE quote_id=$id");
		return $list_quotation;
	}
	

	//Data particular one record read Function while update - quotation
	public function get_one_quotation($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM quotation WHERE id=$id");
		return $get_data;
	}

	

	
}

?>