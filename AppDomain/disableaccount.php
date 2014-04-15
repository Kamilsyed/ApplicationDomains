<?php
require_once 'core/init.php';

$user = new User();

if($user->hasPermission('admin'))
{
	try
	{
		Account::disable($_POST['accounth']);
		Redirect::to('accountdetails.php');
	}
	catch(Exception $e)
	{
		Redirect::to('errors/500.php');
	}
}
?>