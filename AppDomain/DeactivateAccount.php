<?php
require_once 'core/init.php';

$user = new User();
if(!$user->hasPermission('admin'))
{
	Redirect::to('index.php');
}

?>

<head>
		<meta charset="utf-8">
		<title>Account information</title>
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
	                <!-- <li class="nav-header">Features</li> -->
					<li style="margin-left:190px"><a href="adminHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li class="active" style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
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
					  <li><a href="adminchartofaccounts.php">Chart of Accounts</a></li>
					  <li><a href="CreateAccount.php">Create Account</a></li>
					  <li class="active"><a href="DeactivateAccount.php">Deactivate Account</a></li>
					  <li><a href="CreateUsers.php">Create Users</a></li>
					  <li><a href="EditUsers.php">Edit Users</a></li>
					  
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
               <form name="form1" method="post" action="" style="margin-left:175px">
	        	<span id="spryselect1">
	        	<label for="Account ID:" style="color:#FFF;">Account Name</label>
	        	<select name="account" id="account">
					<?php
						$con = mysqli_connect('localhost', 'host', 'test', 'test');

						$query = "SELECT * FROM accounts";
						$results = mysqli_query($con, $query);

						while($row = mysqli_fetch_assoc($results))
						{
							/*SEE ACCOUNT.PHP LINE 123 FOR MORE INFORMATION*/
							echo "<option value=" . $row['number'] . ">". $row['name'] ."</option>";
						}

						mysqli_close($con);
					?>
           	      </select>
	        	<span class="selectRequiredMsg">Please select an item.</span></span>
	        	<input name="Deactivate" type="submit" value="Find" class="btn btn-large btn-success" style="margin-top:-10px;">
              </form>
              
              <?php
					if(Input::exists())
					{
						
						$acc = new Account();
						/*SEE ACCOUNT.PHP LINE 123 FOR MORE INFORMATION*/
						$acc->findByNumber(Input::get('account'));
						$con = mysqli_connect('localhost', 'host', 'test', 'test');
						if(!$con){Redirect::to('errors/500.php');}
						$query = "SELECT * FROM transactions WHERE acct_id='". $acc->data()->number ."'";
						$res = mysqli_query($con, $query);


						if($acc->data()->status == 1)
						{
							echo "<form name='disable' method='post' action='disableaccount.php'>";
							echo "<table id='rounded-corner' summary='Account Information " . $acc->data()->name . "'>";
							echo "<thead> <h3 style='margin-left:100px; color:#FFFFFF'>Account Information for ". $acc->data()->name ."</h3>";
							echo "<tr><th scope='col' class='rounded-company'>Acct#</th>";
							echo "<th scope='col' class='rounded-q3'>Account Name</th>";
							echo "<th scope='col' class='rounded-q1'>Description</th>";
							echo "<th scope='col' class='rounded-q3'>User Added</th>";
							echo "<th scope='col' class='rounded-q3'>Date Added</th>";
							echo "<th scope='col' class='rounded-q3'>Current Balance</th>";
							echo "<th scope='col' class='rounded-q1'>Account Status</th>";
							echo "<th></th>";
							echo "</tr></thead>";
							echo "<tbody><tr>";
							echo "<td>" . $acc->data()->number . "</td>";
							echo "<td>" . $acc->data()->name . "</td>";
							echo "<td>" . $acc->data()->description . "</td>";
							echo "<td>" . $acc->data()->user_added . "</td>";
							echo "<td>" . $acc->data()->date_added . "</td>";
							echo "<td>" . $acc->data()->balance. "</td>";
							echo "<td>Active</td>";
							echo "<td><button type='submit'>Disable Account</button>";
							echo "<input name='accounth' type='hidden' value=" . $acc->data()->number . "></input";
							echo "</tr></tbody></table>";
							echo "</form>";
							//echo "<h3 style='margin-left:100px; color:#FFFFFF'>There are no transactions for ". $acc->data()->name ."</h3>";
						}
						else
						{
							echo "<form name='enable' method='post' action='enableaccount.php'>";
							echo "<table id='rounded-corner' summary='Account Information " . $acc->data()->name . "'>";
							echo "<thead> <h3 style='margin-left:100px; color:#FFFFFF'>Account Information for ". $acc->data()->name ."</h3>";
							echo "<tr><th scope='col' class='rounded-company'>Acct#</th>";
							echo "<th scope='col' class='rounded-q3'>Account Name</th>";
							echo "<th scope='col' class='rounded-q1'>Description</th>";
							echo "<th scope='col' class='rounded-q3'>User Added</th>";
							echo "<th scope='col' class='rounded-q3'>Date Added</th>";
							echo "<th scope='col' class='rounded-q3'>Current Balance</th>";
							echo "<th scope='col' class='rounded-q1'>Account Status</th>";
							echo "<th></th>";
							echo "</tr></thead>";
							echo "<tbody><tr>";
							echo "<td>" . $acc->data()->number . "</td>";
							echo "<td>" . $acc->data()->name . "</td>";
							echo "<td>" . $acc->data()->description . "</td>";
							echo "<td>" . $acc->data()->user_added . "</td>";
							echo "<td>" . $acc->data()->date_added . "</td>";
							echo "<td>" . $acc->data()->balance. "</td>";
							echo "<td>Inactive</td>";
							echo "<td><button type='submit'>Activate Account</button>";
							echo "<input name='accounth' type='hidden' value=" . $acc->data()->number . "></input";
							echo "</tr></tbody></table>";
							echo "</form>";
							//echo "<h3 style='margin-left:100px; color:#FFFFFF'>There are no transactions for ". $acc->data()->name ."</h3>";
						}
					}					
              		?>

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
</script>
</body>

