<?php

class Set
{

	private $_db, $_sessionName, $_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
	}

	public function create($fields = array())
	{
		if(!$this->_db->insert('sets', $fields))
		{
			throw new Exception("Cannot create Transaction" . print_r($fields));			
		}
	}


	//USE THIS TO RETRIEVE INFORMATION ABOUT A SET FOR NON-DISPLAY PURPOSES
	public function find($set = null)
	{
		if(is_numeric($set))
		{
			$data = $this->_db->get('sets', array('id', '=', $set));

			if($data->count())
			{
				$this->_data = $data->first();
				return true;
			}
		}

		return false;
	}

	//USE THIS ONLY TO DISPLAY A SET
	public function search($id)
	{
		if($this->find($id))
		{
			$op = array(
			);

			return $op;
		}

	return false;
	}

	//$id = set trying to reject or post
	//$comment can be null, but should not be for record purposes
	//$change should be 2 or 3; 2 = Posted || 3 = Rejected
	//This function can be used to post a rejected, or reject a posted set
	public function change($id, $comment, $change)
	{
		$user = new User();
		date_default_timezone_set('America/New_York');

		$fields = array(
			'type' => $change,
			'comment' => $comment,
			'user_changed' => $user->data()->username,
			'date_added' => date("Y-m-d H:i:s")
			);

		if(!$this->_db->update('sets', $id, $fields))
		{
			throw new Exception('There was a problem updating: ' . print_r($fields));
		}
	}

	public function get_last_id()
	{

		$con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

		   if (!$con)
		       {
		            die('Could not connect: ' . mysqli_error($con));
		       }

		  
		   $query = "SELECT id FROM sets ORDER BY `date_added` DESC LIMIT 1"; 
		   $result = mysqli_query($con, $query);
		   $row = mysqli_fetch_assoc($result);
		   $number = $row['id'];

		   return $number;
	}

	public function data()
	{
		return $this->_data;
	}
	
}