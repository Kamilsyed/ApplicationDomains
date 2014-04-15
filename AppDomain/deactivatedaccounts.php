<?php
//ini_set('display_startup_errors', TRUE);
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
require_once 'core/init.php';


    $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

    if (!$con)
        {
             die('Could not connect: ' . mysqli_error($con));
        }

    
    $result = mysqli_query($con, "SELECT * FROM accounts WHERE status = '0'");

    if(!$result)
        {
        die(mysqli_error($con));
        }
    
?>

<head>
		<meta charset="utf-8">
		<title>My First Bootstrap project</title>
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
			<h1><a href="#"><span class="center2"\>Astute Software Solutions</span></a></h1>
			<!-- Navigation -->
		  <div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">
	                <li class="active" style="margin-left:285px"><a href="#">Home</a></li>
	                <li style="margin-left:25px"><a href="#" >About Us</a></li>
	                <li style="margin-left:25px"><a href="#">Contact Us</a></li>
	                <li><a href="logout.php">Logout</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
	     
          
<!-- Content Sections -->
	        <div class="row">
	        	
	        	<div class="span3">
	        		<ul class="nav nav-list">
					  <li class="nav-header">Features</li>
					  <li ><a href="adminchartofaccounts.php">Chart of Accounts</a></li>
					  <li><a href="CreateAccount.php">Create Account</a></li>
					  <li><a href="DeactivateAccount.php">Deactivate Account</a></li>
					  <li><a href="CreateUsers.php">Create Users</a></li>
					  <li><a href="EditUsers.php">Edit Users</a></li>
					  <li class="active"><a href="deactivatedaccounts.php">View Deactivated Accounts</a></li>
                      
					</ul>
	        	</div>
	        	
	        	<div class="span8">
               
                
                
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
  <thead>
    	<tr>
        	
        	<th scope="col" class="rounded-q1">Account Name</th>
            <th scope="col" class="rounded-q2">Account Number</th>
            <th scope="col" class="rounded-q3">Normal Side</th>
            <th scope="col" class="rounded-q4">Date Added</th>
            <th scope="col" class="rounded-q5">Description</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	
        	
        </tr>
    </tfoot>
    <tbody>
    	<?php
        while($row = mysqli_fetch_assoc($result))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
             echo "<td>" . $row['number'] . "</td>";
             echo "<td>" . $row['normal'] . "</td>";
             echo "<td>" . $row['date_added'] . "</td>";
             echo "<td>" . $row['description'] . "</td>";
             echo "</tr>";
            }
        echo "</table>";        
        ?>
    </tbody>
</table>


        	  </div>
          </div>

	        <!-- Footer Section -->
	        <hr>
	        <div class="row" >
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
</script>
</body>

