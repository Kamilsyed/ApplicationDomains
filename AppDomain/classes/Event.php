<?php

/*	This class will handle data processing and display of the Event Log pages
	For more info, contact Travis Harrell email::swemajor88@gmail.com
*/

class Event
{
	private $_db, $_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
	}

	/* Function used to create an event log entry in the database
		See line 91 DB.php for more info

		requires an array structured like this:				
		array(
		'description' => $description,		where description is the action taken
		'date' => $date,					date is the current date (can be left empty if server time is same as system time)
		'user' => $user,					the current user obtained from $user->data()->username
		'location' => $location 			the account or page the action is taken on
		);

		Function is reused below for specific events
	*/
	public function create($fields = array())
	{
		if(!$this->_db->insert('events', $fields))
		{
			throw new Exception("Cannot create New Event!");			
		}
	}

	/* Function specified for transaction events see line 16 of this file for more info
	*/
	public function transaction_event($amount, $account, $user)
	{
		$arr = array(
			'description' => "$user created a transaction for $account in the amount of $". number_format($amount),
			'user' => $user,
			'location' => $account
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/* Account creation event function
	*/
	public function account_event($account, $number, $user, $bal)
	{
		$arr = array(
			'description' => "$user created a new account: $number $account with starting balance" . number_format($bal),
			'user' => $user,
			'location' => "Chart Of Accounts"
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/* Account creation event function
		$status should either be '1' or '0'
	*/
	public function account_status_event($account, $number, $user, $status)
	{
		$st = '';

		if($status == 1)
		{$st = 'enabled';}
		else {$st = 'disabled';}

		$arr = array(
			'description' => "$user $st account: $number $account",
			'user' => $user,
			'location' => "Account Status"
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/* Posting transaction set event function
		$status should either be 'posted' or 'rejected'
	*/
	public function posting_event($setnum, $setname, $comment, $status, $user)
	{
		$arr = array(
			'description' => "$user has $status Transaction Set: $setnum $setname Reason: $comment",
			'user' => $user,
			'location' => "Finalized Transactions"
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/*	Event listener for creating users, or changing user status
		$action should be either 'created' or 'changed'
	*/
	public function user_event($action, $user_changed, $user)
	{
		$arr = array(
			'description' => "$user has $status Transaction Set: $setnum $setname Reason: $comment",
			'user' => $user,
			'location' => "Finalized Transactions"
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/* find function for events
		use:
			$event = new Event();
			$event->find($event_id);

		 This will give you access to the server side data of the event accesible through
		 Event::data()->field line 144 Event.php
	*/
	public function find($id)
	{
		$data = $this->_db->get('events', array('id', '=', $id));

		if($data->count())
		{
			$this->_data = $data->first();
			return true;
		}

		return false;
	}

	/*	Allows access to object data.
	*/
	public function data()
	{
		return $this->_data;
	}

	/* display function for events, this will be used on each page that lists all events
	*/
	public static function display_events()
	{
		$con = mysqli_connect('localhost', 'host', 'test', 'test');

		if($con)
		{
			$query = "SELECT * FROM events";
			$results = mysqli_query($con, $query);

			if(mysqli_num_rows($results) > 0)
			{
				echo "<form name='form1' method='post' action=''>";
				echo "<table id='rounded-corner'>";
				echo "<thead> <h3 style='margin-left:190px; color:#FFFFFF'> Transaction Log</h3></thead><tbody>";

				while($row = mysqli_fetch_assoc($results))
				{
					echo "<tr><td>". $row['id'] . "</td>";
					echo "<td>". $row['description'] ."</td>";
					echo "<td>". $row['user'] ."</td>";
					echo "<td>". $row['date'] ."</td>";
					echo "<td>". $row['location'] ."</td>";
					echo "<td>". $row['comments'] ."</td>";
				}

				echo "</tbody></table></form>";
			}

			mysqli_close($con);
		}
	}
}