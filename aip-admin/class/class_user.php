<?php


include_once("db_config.php");

class DB_con
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



class User
{
	protected $db;
	public function __construct()
	{
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}

	/*** for registration process ***/
	public function reg_user($username, $password, $user_role)
	{
		//echo "k";

		$password = $password;

		//checking if the username or email is available in db
		$query = "SELECT * FROM login_users WHERE username='$username' ";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		if ($count_row == 0) {
			$query = "INSERT INTO login_users SET `username`='$username', `password` ='$password',
			 `role`='$user_role', `is_active`= 1";

			$result = $this->db->query($query) or die($this->db->error);

			return true;
		} else {
			return false;
		}
	}

	/*** for login process ***/
	public function check_login($username, $password)
	{
		$password = $password;

		$query = "SELECT id from login_users WHERE `username`='$username' and `password`='$password' and `is_active`='1'";
		$result = $this->db->query($query) or die($this->db->error);

		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			$_SESSION['login'] = true; // this login var will use for the session thing
			$_SESSION['id'] = $user_data['id'];
			return true;
		} else {
			return false;
		}
	}

	public function get_fullname($id)
	{
		$query = "SELECT * FROM login_users WHERE id = $id";

		$result = $this->db->query($query) or die($this->db->error);

		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		echo $user_data['username'] ;
	}

	/*** starting the session ***/
	public function get_session()
	{
		return $_SESSION['login'];
	}

	public function user_logout()
	{
		$_SESSION['login'] = FALSE;
		unset($_SESSION);
		session_destroy();
	}

	//Data particular one record read Function while login
	public function getonerecord($id)
	{
		$get_data = mysqli_query($this->db, "SELECT * FROM login_users WHERE id = $id");
		return $get_data;
	}
}
