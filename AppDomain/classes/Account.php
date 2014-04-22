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

		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

	    if (!$con)
	        {
	             die('Could not connect: ' . mysqli_error());
	        }

	    // mysql_select_db('test');
	    $query = "SELECT number FROM accounts WHERE type='" . $type ."' ORDER BY `number` DESC LIMIT 1"; 
	    $result = mysqli_query($con, $query);
	    $row = mysqli_fetch_assoc($result);
	    $number = $row['number'];

	    if(!$result)
	        {
	        	die(mysql_error());
	        }

		switch($type)
		{
			case 'Current Assets':
				if($number >= 100000000)
				{
					return $number + 1;
				}
				else
					{return 100000000;}
			break;
			case 'Long Term Assets':
				if($number >= 200000000)
				{
					return $number + 1;
				}
				else
					{return 200000000;}
			break;
			case 'Current Liabilities':
				if($number >= 300000000)
				{
					return $number + 1;
				}
				else
					{return 300000000;}
			break;
			case 'Long-Term Liabilities':
				if($number >= 400000000)
				{
					return $number + 1;
				}
				else
					{return 400000000;}
			break;
			case 'Equity':
				if($number >= 500000000)
				{
					return $number + 1;
				}
				else
					{return 500000000;}
			break;
				case 'Operating Revenue':
				if($number >= 600000000)
				{
					return $number + 1;
				}
				else
					{return 600000000;}
			break;
				case 'Operating Expenses':
				if($number >= 700000000)
				{
					return $number + 1;
				}
				else
					{return 700000000;}
			break;
				case 'Non-Operating Revenue':
				if($number >= 800000000)
				{
					return $number + 1;
				}
				else
					{return 800000000;}
			break;
				case 'Non-Operating Expenses':
				if($number >= 900000000)
				{
					return $number + 1;
				}
				else
					{return 900000000;}
			break;
			default:
				return 000000000;
			break;
		}
	}


	/* NOTE IMPORTANT: THIS FUNCTION WILL NOT WORK IF THERE IS A SPACE IN THE NAME OF
		THE ACCOUNT! USE Account::findByNumber() TO ACCESS ACCOUNT DATA

		IF ANY PAGE REQUIRES A DROP DOWN TO GIVE INFORMATION TO ACCOUNT.php FOR DATA
		RETRIEVAL, SET THE DROP DOWN VALUE TO row['number'] AND NOT row['name']. 

		SEE Travis Harrell FOR MORE DETAILS
	*/
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

	public function data()
	{
		return $this->_data;
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

		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");
		

	    $query = "UPDATE accounts SET balance='$bal' WHERE number='$num'";

	    try
	    {mysqli_query($con, $query);}
	    catch(Exception $e)
	    {
	    	die('Balance did not update:<br>' . $query . "<br>" . mysqli_error($con));
	    }

	    mysqli_close($con);
	}

	public static function disable($number)
	{
		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

		if(!$con){Redirect::to('errors/500.php');}

		$res = mysqli_query($con, "SELECT * FROM transactions WHERE acct_id='$number'");

		if(mysqli_num_rows($res) == 0)
		{
			$query = "UPDATE accounts SET status='0' WHERE number='{$number}'";

			if(!mysqli_query($con, $query))
				{throw new Exception("Could not update account!");}
		}
		else
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$q2 = "SELECT * FROM sets WHERE id='". $row['set_id'] ."' AND type='1'";
				$r2 = mysqli_query($con, $q2);

				if(mysqli_num_rows($res) < 0)
				{
<<<<<<< HEAD
					throw new Exception('Cannot close an account with open transactions!!');				
=======
					throw new Exception('Cannot close an account with open transactions!!');		
>>>>>>> aaf8b21dae29e0e4c59d2a4c9afd74cd137b61ce
				}
			}

			$query = "UPDATE accounts SET status='0' WHERE number='{$number}'";

			if(!mysqli_query($con, $query))
				{throw new Exception("Could not update account!");}
		}
	}

	public static function enable($number)
	{
		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

		if(!$con){Redirect::to('errors/500.php');}

		$query = "UPDATE accounts SET status='1' WHERE number='{$number}'";

		if(!mysqli_query($con, $query))
			{throw new Exception("Could not update account!");}
	}
}