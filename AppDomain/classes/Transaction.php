<?php

class Transaction
{
	private $_db, $_sessionName, $_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
	}

	public function create($fields = array())
	{
		if(!$this->_db->insert('transactions', $fields))
		{
			throw new Exception("Cannot create Transaction" . print_r($fields));			
		}
	}

	//Checks to see if a set of transactions if balanced for validation purposes
	//Takes in an array of account type, and amounts and compares them
	//If the total is zero at the end, function returns true, otherwise false
	public function balanced($types = array(), $amounts = array())
	{
		if(count($types) == count($amounts))
		{
			$total = 0.00;

			for($x=0; $x < count($amounts); $x++)
			{
				switch($types[$x])
				{
					case 'debit':
					case 'Debit':
						$total -= floatval($amounts[$x]);
					break;
					case 'credit':
					case 'Credit':
						$total += floatval($amounts[$x]);
					break;
					default:
						//If neither case, input is invalid and return value is false
						return false;
					break;
				}
			}

			if ($total == 0.00)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function find($trans = null)
	{
		if(is_numeric($trans))
		{
			$data = $this->_db->get('transactions', array('trans_id', '=', $trans));

			if($data->count())
			{
				$this->_data = $data->first();
				return true;
			}
		}
	}

	public function search($id)
	{
		if($this->find($id))
		{
			$op = array(
			'ID' => $this->_data->trans_id, 
			'Account ID' => $this->_data->acct_id, 
			'Amount' => $this->_data->amount, 
			'Type' => $this->_data->type, 
			'User Addedd' => $this->_data->user_added, 
			'Date Added' => $this->_data->date_added);

			return $op;
		}

	return false;
	}

}