<?php
require_once 'core/init.php';

$user = new User();
//
	try
	{
		Account::disable($_POST['acct_num']);
		$event = new Event();
		$event->account_status_event($_POST['acct_name'], $_POST['acct_num'], $_POST['user'], $_POST['action']);
		echo "Account disabled successfully!";
		echo "<br><li><a href='accountdetails.php'>Go back...</a></li>";
		// sleep(10);
		// Redirect::to('accountdetails.php');
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		echo "<br><li><a href='accountdetails.php'>Go back...</a></li>";
		// sleep(10);
		// Redirect::to('accountdetails.php');
	}
//}
?>