<?php
require_once 'core/init.php';

$user = new User();

//
	try
	{
		Account::disable($_POST['accounth']);
		$event = new Event();
		$event->account_status_event($_POST['accountx'], $_POST['accounth'], $_POST['user'], $_POST['act']);
		Redirect::to('accountdetails.php');
	}
	catch(Exception $e)
	{
		echo "<?php echo disablefailed(".$_POST['accountx'].") ?>";
	}
//
?>

<script type="text/javascript">

function disablefailed(account)
{
	window.alert("Disabling " + account + " failed, there are currently open transactions for this account.");
}

</script>