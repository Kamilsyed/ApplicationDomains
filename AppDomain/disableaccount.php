<?php

require_once 'core/init.php';

$user = new User();

if(!Input::exists() || $user->data()->groups != 3 || !$user->isLoggedIn())
{Redirect::('index.php');}

try
{
	Account::disable($_POST['accounth']);
	$event = new Event();
	$event->account_status_event($_POST['accountx'], $_POST['accounth'], $_POST['user'], $_POST['act']);
	//Redirect::to('accountdetails.php');
}
catch(Exception $e)
{
	echo "<form method='post'><input type='hidden' id='failed' name='failed' value='true'></input></form>";
}

?>

<body onload="disablefailed()"></body>

<script type="text/javascript">

window.onload = function()
{
	disablefailed();
}

function disablefailed()
{
	var failed = document.getElementById().value;
	if(document.getElementById('failed'))
	{
		window.alert("Cannot disable this account, open transactions exist!:" + <?php echo $_POST['accountx';] ?>)
	}
}

</script>