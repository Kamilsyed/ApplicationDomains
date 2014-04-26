<?php
require_once 'core/init.php';

$user = new User();
//
	try
	{
		Account::disable($_POST['accounth']);
		$event = new Event();
		$event->account_status_event($_POST['accountx'], $_POST['accounth'], $_POST['user'], $_POST['act']);
		echo "Account disabled successfully!";
		echo "<br><li><a href='accountdetails.php'>Go back...</a></li>";
		sleep(10);
		Redirect::to('accountdetails.php');
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		echo "<br><li><a href='accountdetails.php'>Go back...</a></li>";
		sleep(10);
		Redirect::to('accountdetails.php');
	}
//}
?>