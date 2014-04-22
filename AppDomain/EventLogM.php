
<?php
require_once 'core/init.php';
?>
<head>
		<meta charset="utf-8">
		<title>Homepage</title>
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
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
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
	                <li style="margin-left:190px"><a href="ManagerHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	            </div>
	          </div>
	        </div>
	     	 <form name="form1" method="post" action="managersearchpage.php" style="margin-left:650px">
	        	  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
	        	    <input type="text" name="searchid" id="Username">
	        	    <span class="textfieldRequiredMsg">A value is required.</span></span>
        	  
              <input name="Sumbit" type="submit" value="Search" class="btn btn-small btn-success" style="margin-top:-10px;">
              </form> 
          
<!-- Content Sections -->
	        <div class="row">
	        	<!-- Left Side Vertical Bar -->
	        	<div class="span4">
	        		<ul class="nav nav-list">
					  <li class="nav-header">Features</li>
					  <li><a href="managerchartofaccounts.php">Chart of Accounts</a></li>
					  <li><a href="PostTransactions.php">Post Transactions</a></li>
                      <li ><a href="edittransactions.html">Edit Transactions</a></li>
                      <li><a href="ViewOpenTransactions.php">View Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactions.php">View Finalized Transactions</a></li>
                      <li><a href="viewreportsmanager.html">Reports</a></li>
                      <li><a href="EventLogM.php">Event Log</a></li>
					</ul>
	        	</div>
               
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
	        	<form method='post'>
				<select name='where'>
					<option value=''>--Select a Location--</option>
	        		<option value='Accounts'>Accounts</option>
	        		<option value='Account Status'>Account Status</option>
	        		<option value='Finalized Transactions'>Finalized Transactions</option>
	        		<option value='Users'>Users</option>
	        	</select><br>
	        	<select name='account'>
	        	<option value=''>--OR Select an Account--</option>
	        		<?php
	        			$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

	        			if(!$con){die('SERVER ERROR');}

	        			$q = "SELECT * FROM accounts ORDER BY name";

	        			$res = mysqli_query($con, $q);

	        			while($row = mysqli_fetch_assoc($res))
	        			{
	        				echo "<option value='". $row['number']."'>". $row['name']."</option>";
	        			}
	        		?>
	        	</select><br>
	        	<select name='user'>
	        		<option value=''>--Select a User--</option>
	        		<?php
	        			$con = mysqli_connect("localhost","mmollica","Thepw164","app_domain");

	        			if(!$con){die('SERVER ERROR');}

	        			$q = "SELECT * FROM users";

	        			$res = mysqli_query($con, $q);

	        			while($row = mysqli_fetch_assoc($res))
	        			{
	        				echo "<option value='". $row['username']."'>". $row['username']."</option>";
	        			}
	        		?>
	        	</select>
	        	<br>
				<input type='date' name='date'></input></tr>
	        	
	        	<br>
	        	<input name="Sumbit" type="submit" value="Search" class="btn btn-small btn-success">
	        	<br>
	        	<label>Fields may be left blank.</label>
	        	</form>

	        	<?php
	        	if(Input::exists())
	        	{
	        		
	        		if(Input::get('where') != '' && Input::get('account') != '')
	        		{
	        			echo "Please select either a location or account, not both!";
	        			return;
	        		}
	        		else if(Input::get('account') == '')
	        		{
	        			$loc = Input::get('where');
	        		}
	        		else if(Input::get('where') == '')
	        		{
	        			$loc = Input::get('account');
	        		}

	        		$d = Input::get('date');
	        		$u = Input::get('user');

	        		Event::dislay_events_from($loc, $d, $u);
	        	}
	        	else
	        	{
	        		Event::display_events();
	           	}
	        	?>          

        	  </div>
          </div>

	        <!-- Footer Section -->
	        <hr>
	          <div class="row">
				<div class="span4">
					
					<p></p>
					
				</div>
				<div class="span4">
					
					<p></p>
					
				</div>
				<div class="span4">
				
					<p></p>
					
				</div>
			</div>
			<!-- Copyright Area -->
			<hr>
			<div class="footer">
            <div class="hero-unit">
            
				<p>&copy; 2013</p>
			</div>
            </div>
		</div>


<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script scr="js/bootstrap.js">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>
