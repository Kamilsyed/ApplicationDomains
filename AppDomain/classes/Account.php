<?php

class Account
{
	private $_db, $_sessionName, $_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
	}

	public function create($fields = array())
	{
		if(!$this->_db->insert('accounts', $fields))
		{
			throw new Exception("Cannot create Account" . print_r($fields));			
		}
	}

	public function get_number($type)
	{	

		$con = mysql_connect("localhost","host","test");

	    if (!$con)
	        {
	             die('Could not connect: ' . mysql_error());
	        }

	    mysql_select_db('test');
	    $query = "SELECT number FROM accounts WHERE type='" . $type ."' ORDER BY `date_added` DESC LIMIT 1"; 
	    $result = mysql_query($query);
	    $row = mysql_fetch_assoc($result);
	    $number = $row['number'];

	    if(!$result)
	        {
	        	die(mysql_error());
	        }

		switch($type)
		{
			case 'asset':
				if($number >= 1000000000)
				{
					return $number + 1;
				}
				else
					{return 1000000000;}
			break;
			case 'liability':
				if($number >= 2000000000)
				{
					return $number + 1;
				}
				else
					{return 2000000000;}
			break;
			case 'revenue':
				if($number >= 3000000000)
				{
					return $number + 1;
				}
				else
					{return 3000000000;}
			break;
			case 'equity':
				if($number >= 4000000000)
				{
					return $number + 1;
				}
				else
					{return 4000000000;}
			break;
			case 'expenses':
				if($number >= 5000000000)
				{
					return $number + 1;
				}
				else
					{return 5000000000;}
			break;
			default:
				return 0000000000;
			break;
		}
	}

	public function find($acc = null)
	{

		$data = $this->_db->get('accounts', array('name', '=', $acc));

		if($data->count())
		{
			$this->_data = $data->first();
			return true;
		}

		return false;
	}

	public function findByNumber($id = null)
	{
		$data = $this->_db->get('accounts', array('number', '=', $id));

		if($data->count())
		{
			$this->_data = $data->first();
			return true;
		}

		return false;
	}

	public function data()
	{
		return $this->_data;
	}

	//Use this to update the amount in a given account
	//$type = type of the transaction
	public function update_balance($num, $type, $amount)
	{	
		$t = $this->_data->normal;
		$bal = $this->_data->balance;

		if(strcasecmp($t, $type) == 0)
		{
			$bal += $amount;
		}
		else
		{
			$bal -= $amount;
		}

		mysql_connect("localhost", "host", "test");
		mysql_select_db('test');

	    $query = "UPDATE accounts SET balance='$bal' WHERE number='$num'";

	    try
	    {mysql_query($query);}
	    catch(Exception $e)
	    {
	    	die('Balance did not update:<br>' . $query . "<br>" . mysql_error());
	    }

	    mysql_close();
	}

/*	public static function accountValidation()
	{
		
	}*/
}