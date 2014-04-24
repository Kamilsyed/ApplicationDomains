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
		date_default_timezone_set('America/New_York');
        
		$arr = array(
			'description' => "$user created a transaction for $account in the amount of $". number_format($amount),
			'user' => $user,
			'location' => $account,
			'date'=>date("Y-m-d H:i:s")
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/* Account creation event function
	*/
	public function account_event($account, $number, $user, $bal)
	{
		date_default_timezone_set('America/New_York');
		$arr = array(
			'description' => "{$user} created a new account {$number}: {$account} with starting balance $" . number_format($bal),
			'user' => $user,
			'location' => "Accounts",
			'date'=>date("Y-m-d H:i:s")
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
		date_default_timezone_set('America/New_York');

		$arr = array(
			'description' => "{$user} {$status} account {$number}: {$account}",
			'user' => $user,
			'location' => "Account Status",
			'date'=>date("Y-m-d H:i:s")
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
		$stat = '';

		if($status == '2')
		{
			$stat = 'posted';
		}
		else if($status == '3')
		{
			$stat = 'rejected';
		}
		else
		{
			$stat = $status;
		}

		date_default_timezone_set('America/New_York');
		$arr = array(
			'description' => "{$user} has {$stat} Transaction Set {$setnum}: {$setname} Reason: {$comment}",
			'user' => $user,
			'location' => "Finalized Transactions",
			'date'=>date("Y-m-d H:i:s")
			);

		try{$this->create($arr);}
		catch(Exception $e)
		{die($e->getMessage() . print_r($arr));}
	}

	/*	Event listener for creating users, or changing user status
		$action should be either 'created', 'changed user level of', 'activated', or 'deactivated'
		$var should either be a comment to show reason behind deactivation or activation of user, or
			a user's group level for cretion or changing group level
	*/
	public function user_event($action, $user, $user_changed, $var)
	{
		date_default_timezone_set('America/New_York');
		$description = '';

		if($action == 'userlevel')
		{
			$description = "$user has changed user level of $user_changed to $var";
		}
		else if($action == 'created')
		{
			$description = "$user has $action $user_changed, group $var";
		}
		else
		{
			$description = "$user $action {$user_changed}'s account. Reason: $var";
		}

		$arr = array(
			'description' => $description,
			'user' => $user,
			'location' => "Users",
			'date'=>date("Y-m-d H:i:s")
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
		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

		if($con)
		{
			$query = "SELECT * FROM events ORDER BY date DESC";
			$results = mysqli_query($con, $query);

			if(mysqli_num_rows($results) > 0)
			{
				echo "<form name='form1' method='post' action=''>";
				echo "<table id='rounded-corner'>";
				echo "<h3 style='margin-left:180px; color:#FFFFFF'>Event Log</h3>";
				echo "<thead>";
				echo "<th scope='col' class='rounded-company'>Event ID</th>";
				echo "<th scope='col' class='rounded-company'>Event</th>";
				echo "<th scope='col' class='rounded-company'>User</th>";
				echo "<th scope='col' class='rounded-company'>Date</th>";
				echo "<th scope='col' class='rounded-company'>Location</th>";
				echo "<th scope='col' class='rounded-company'>Comments</th>";
				echo "</thead><tbody>";

				while($row = mysqli_fetch_assoc($results))
				{
					echo "<tr><td>". $row['id'] . "</td>";
					echo "<td>". $row['description'] ."</td>";
					echo "<td>". $row['user'] ."</td>";
					echo "<td>". $row['date'] ."</td>";
					echo "<td>". $row['location'] ."</td>";
					echo "<td>". $row['comments'] ."</td></tr>";
				}

				echo "</tbody></table></form>";
			}

			mysqli_close($con);
		}
	}

	/* This function is used to find events pertaining to specifics parts of the website
		such as
			$loc = a particular catergory, should be left blank (or ''/"") if you want all categories
				valid categories -> 'Finalized Transactions', 'Account Status', 'Accounts', or a specific account NAME
			$d = a specific date you want results from, should be left blank (or ''/"") if you want all dates
			$u = entries from a specific user, should be left blank or (''/"") if you want all user entries
	*/
	public static function dislay_events_from($loc, $d, $u)
	{
		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

		if(!$con) {die('Could not connect to server!!');}

		$query = 'This will be a mysqli_query value';

		//Default
		if($loc == '' && $d == '' && $u == '')
		{
			Event::display_events();
			return;
		}
		//User
		else if($loc == '' && $d == '' && $u != '')
		{
			$query = "SELECT * FROM events WHERE user='{$u}' ORDER BY date DESC";
		}
		//User and date
		else if($loc == '' && $d != '' && $u != '')
		{
			$query = "SELECT * FROM events WHERE date LIKE '{$d}%' AND user='{$u}' ORDER BY date DESC";
		}
		//All fields
		else if($loc != '' && $d != '' && $u !='')
		{
			$query = "SELECT * FROM events WHERE date LIKE '{$d}%' AND user='{$u}' AND location='{$loc}' ORDER BY date DESC";
		}
		//Location and Date
		else if($loc != '' && $d != '' && $u == '')
		{
			$query = "SELECT * FROM events WHERE date LIKE '{$d}%' AND location='{$loc}' ORDER BY date DESC";
		}
		//Location and User
		else if($loc != '' && $d == '' && $u != '')
		{
			$query = "SELECT * FROM events WHERE user='{$u}' AND location='{$loc}' ORDER BY date DESC";
		}
		//Date only
		else if($loc == '' && $d != '' && $u == '')
		{
			$query = "SELECT * FROM events WHERE date LIKE '{$d}%' ORDER BY date DESC";	
		}
		//Location only
		else if($loc != '' && $d == '' && $u == '')
		{
			$query = "SELECT * FROM events WHERE location='{$loc}' ORDER BY date DESC";
		}
		else
		{
			throw new Exception('Event search failed. Please check values and try again');
		}

		$results =  mysqli_query($con, $query);

		if(mysqli_num_rows($results) > 0)
			{
				echo "<form name='form1' method='post' action=''>";
				echo "<table id='rounded-corner'>";
				echo "<h3 style='margin-left:190px; color:#FFFFFF'>Event Log</h3>";
				echo "<thead>";
				echo "<th scope='col' class='rounded-company'>Event ID</th>";
				echo "<th scope='col' class='rounded-company'>Event</th>";
				echo "<th scope='col' class='rounded-company'>User</th>";
				echo "<th scope='col' class='rounded-company'>Date</th>";
				echo "<th scope='col' class='rounded-company'>Location</th>";
				echo "<th scope='col' class='rounded-company'>Comments</th>";
				echo "</thead><tbody>";

				while($row = mysqli_fetch_assoc($results))
				{
					echo "<tr><td>". $row['id'] . "</td>";
					echo "<td>". $row['description'] ."</td>";
					echo "<td>". $row['user'] ."</td>";
					echo "<td>". $row['date'] ."</td>";
					echo "<td>". $row['location'] ."</td>";
					echo "<td>". $row['comments'] ."</td></tr>";
				}

				echo "</tbody></table></form>";
				mysqli_close($con);
			}
		else
		{
			echo "<h3 style='color:#FFFFFF'>No Events were found using those parameters.</h3>";
			mysqli_close($con);
		}
	}

	//Some events will need to be flagged for review. This function will allow a user to flag events.
	public static function flag($id, $flag, $comment)
	{
		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

		if(!$con) {die('Could not connect to server!!');}

		$query = "UPDATE events SET flag='{$flag}', comment='{$comment}' WHERE id='{$id}'";

		$results = mysqli_query($con, $query);

		if(!$results)
		{
			throw new Exception('Flag query failed!');
		}

		mysqli_close($con);
	}

	//Display flagged events
	public static function display_flagged()
	{
		$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

		if($con)
		{
			$query = "SELECT * FROM events WHERE flag='1'";
			$results = mysqli_query($con, $query);

			if(mysqli_num_rows($results) > 0)
			{
				echo "<form name='form1' method='post' action=''>";
				echo "<table id='rounded-corner'>";
				echo "<h3 style='margin-left:180px; color:#FFFFFF'>Event Log</h3>";
				echo "<thead></thead><tbody>";

				while($row = mysqli_fetch_assoc($results))
				{
					echo "<tr><td>". $row['id'] . "</td>";
					echo "<td>". $row['description'] ."</td>";
					echo "<td>". $row['user'] ."</td>";
					echo "<td>". $row['date'] ."</td>";
					echo "<td>". $row['location'] ."</td>";
					echo "<td>". $row['comments'] ."</td></tr>";
				}

				echo "</tbody></table></form>";
			}

				mysqli_close($con);
			}
	}
}