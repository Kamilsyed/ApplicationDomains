<?php
require_once 'core/init.php';

$user = new User();
//
	try
	{
		Account::enable($_POST['accounth']);
		$event = new Event();
		$event->account_status_event($_POST['accountx'], $_POST['accounth'], $_POST['user'], $_POST['act']);
		Redirect::to('accountdetails.php');
	}
	catch(Exception $e)
	{
		Redirect::to('errors/500.php');
	}
//}
?>