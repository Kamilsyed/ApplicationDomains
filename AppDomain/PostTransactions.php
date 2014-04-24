<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 

require_once 'core/init.php';
$user = new User();
if($user->data()->groups!=2 || !$user->isLoggedIn())
{
	Redirect::to('index.php');
}

$set = new Set();
date_default_timezone_set('America/New_York');
$acc = new Account();

if(Input::exists())
{
	$user = new User();

	for($x = 0; $x < intval(Input::get('c')); $x++)
	{
		$id = 'id' . $x;
		$rad = 'rad' . $x;
		$com = 'comments' . $x;

		if(Input::get($rad) != 0)
		{
			$con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

			if (!$con)
			{
				Redirect::to('errors/500.php');
			}
			
			$query = "SELECT * FROM `transactions` WHERE set_id='". Input::get($id) ."'";
			$results = mysqli_query($con, $query);

			//POSSIBLE BUG, UPDATES BALANCE OF ACCOUNTS INCLUDED IN REJECTED SETS
			while($res = mysqli_fetch_assoc($results))
			{
				$acc->findByNumber($res['acct_id']);
				$acc->update_balance($res['acct_id'], $res['type'], $res['amount']);
			}
			//END BUG

			try
			{
				$set->find(Input::get($id));
				$set->change(Input::get($id), Input::get($com), Input::get($rad));
				$event = new Event();
				$event->posting_event(Input::get($id), $set->data()->description, Input::get($com), Input::get($rad), $user->data()->username);
			}
			catch(Exception $e)
			{
				$e->getMessage();
			}

			mysqli_close($con);
		}

	}
}
    
?>

<head>
		<meta charset="utf-8">
		<title>Post/Reject Transactions</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
    <style>
	body{
		background-color:#000000;
		
	}
	h1{
	
	margin:auto;
	text-align:center;	
	}
	</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
            function download (id)
            {
                window.open ("download.php?fileId="+id, "hiddenFrame");
            }
</script>
</head>
<body>
		
		<!-- The Main wrapper div starts -->
		<div class="container">
			<!-- header content -->
			<h1><a href="#"><span class="center2" style="color:#5bb75b"\>Astute Software Solutions</span></a></h1>
			<!-- Navigation -->
		  <div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">
	                <li style="margin-left:190px"><a href="ManagerHomepage.php">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="">Log out</a></li>
	              </ul>
	            </div>
	          </div>
          </div>
	     
          
<!-- Content Sections -->
          <div class="row">
	        	<!-- Left Side Vertical Bar -->
	        	<div class="span4">
	        		<ul class="nav nav-list">
					  <li class="nav-header">Features</li>
					  <li ><a href="managerchartofaccounts.php">Chart of Accounts</a></li>
					  <li class="active"><a href="PostTransactions.php">Post Transactions</a></li>
                       <li ><a href="edittransactions.html">Edit Transactions</a></li>
					  <li><a href="ViewOpenTransactions.php">View Open Transactions</a></li>
                      <li ><a href="ViewFinalizedTransactions.php"> View Finalized Transactions</a></li>
                      <li><a href="viewreportsmanager.php">Reports</a></li>
                      <li><a href="RatiosManager.php">Ratios</a></li>
					  <li><a href="EventLogM.php">Event Log</a></li>
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
        	  <div class="span8">
  <form name='form1' method='post' action=''>
          
  <table id="rounded-corner">
  <thead> <h3 style="margin-left:190px; color:#FFFFFF"> Transaction Log</h3>
    </thead>
        
    <tbody>
    	<tr>
        	<?php
			$con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

		    if (!$con)
	        {
	             die('Could not connect: ' . mysqli_error($con));
	        }

		     
		    $result = mysqli_query($con,"SELECT * FROM sets WHERE type='1'");

		    if(!$result)
	        {
	            die(mysqli_error($con));
	        }

	        $c = 0;

	        while($row = mysqli_fetch_assoc($result))
	            {

		    	echo "<tr id='set$c' name='set$c' value='" . $row['id'] . "'>";
	        	echo "<th scope='col' class='rounded-company'>". $row['description'] . "</th>";
	        	echo "<th scope='col' class='rounded-q2'>". $row['user_added'] . "</th>";
	            echo "<th scope='col' class='rounded-q1'>". $row['date_added'] . "</th>";
	            echo "<th scope='col' class='rounded-q3' width='100px'>";
				echo "<input type='text' name='comments$c' size='4'></input>";
	            echo "<input type='radio' name='rad$c' value='2'>Post</input><br>";
	            echo "<input type='radio' name='rad$c' value='3'>Reject</input></th>";
		    	echo "<input type='hidden' name='id$c' id='id$c' value='" . $row['id'] . "'>";
		    	echo "<th></th>";
		        echo "</tr>"; 
	             
	             $q = mysqli_query($con, "SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

	             while($row2 = mysqli_fetch_assoc($q))
	             {
	             	$account = new Account();
	             	$account->findByNumber($row2['acct_id']);
	             	
	             	echo "<tr>";
	             	echo "<td>" . $account->data()->name . "</td>";
	             	echo "<td>" . $row2['amount'] . "</td>";
	             	echo "<td>" . $row2['type'] . "</td>";
	             	echo "<td><a href='javascript:download(".$row2['trans_id'].")'> ".$row2['file_name']."</a></td>";
	             	echo "<td></td>";
	             	echo "</tr>";
	             }
	             
	             echo "</tr>";
	             $c++;
 	            }
 	    echo "<input type='hidden' name='c' id='c' value='$c'>";
        echo "</table>";
        ?>
        	    <!-- echo " --><input name='Submit' type='submit' value='Submit' class='btn btn-med btn-success'/><!-- "; -->
        </tr>
    </tbody>
    </form>
</table>

				
        	  </div>
          </div>
          
<!-- Footer Section -->
	        <hr>
	        <div class="row">
				<div class="span4">
					<h4 class="muted text-center">Meet Our Clients</h4>
					<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
					<a href="#" class="btn"><i class="icon-user"></i> Our Clients</a>
				</div>
				<div class="span4">
					<h4 class="muted text-center">Know Our Employees</h4>
					<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
					<a href="#" class="btn btn-success"><i class="icon-star icon-white"></i> Our Employees</a>
				</div>
				<div class="span4">
					<h4 class="muted text-center">Reach Us</h4>
					<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
					<a href="#" class="btn btn-info">Contact Us</a>
				</div>
			</div>

			<!-- Copyright Area -->
			<hr>
			<div class="footer">
				<p>&copy; 2013</p>
			</div>
		</div>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script scr="js/bootstrap.js">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
</body>

