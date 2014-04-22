<?php
//ini_set('display_startup_errors', TRUE);
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
require_once 'core/init.php';

$user = new User();
if(!$user->data()->groups==1)
{
	Redirect::to('index.php');
}


    $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

    if (!$con)
        {
             die('Could not connect: ' . mysqli_error($con));
        }

    
	 
	$id=$_POST["searchid"];
	
$result = mysqli_query($con, "SELECT * FROM accounts WHERE number = $id");
$a = mysqli_query($con, "SELECT * FROM accounts WHERE number = $id");

$result1 = mysqli_query($con, "SELECT set_id FROM transactions WHERE acct_id=$id");
$b = mysqli_query($con, "SELECT set_id FROM transactions WHERE acct_id=$id");

	


	

    if(!$result)
        {
        die(mysqli_error($con));
        }
		
	if(!$result1)
        {
        die(mysqli_error($con));
        }
		
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
	                <li style="margin-left:190px"><a href="AdminHomepage.php">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li class="active" style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="#">Log out</a></li>

	              </ul>
	            </div>
	          </div>
	        </div>
	     
          <form name="form1" method="post" action="adminsearchpage.php" style="margin-left:650px">
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
					  <li><a href="CreateAccount.html">Create Account</a></li>
					  <li><a href="DeactivateAccount.html">Deactivate Account</a></li>
					  <li><a href="CreateUsers.html">Create Users</a></li>
					  <li><a href="EditUsers.html">Edit Users</a></li>
					  
					</ul>
	        	</div>
                
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
            <?php 
			
		      if(mysqli_fetch_assoc($result) != false)	
 	       {
            echo ' <table id="rounded-corner" summary="2007 Major IT Companies Profit" style="margin:auto;"> ';
            echo '<thead>';
        	echo '<tr>';
        	echo '<th scope="col" class="rounded-company">Act. Name</th>';
            echo '<th scope="col" class="rounded-q2">Act. Number</th>';
            echo '<th scope="col" class="rounded-q3">Act. Description</th>';
            echo '<th scope="col" class="rounded-q3">Normal Side</th>';
            echo '<th scope="col" class="rounded-q5">Act. Type</th>';
            echo '<th scope="col" class="rounded-q6">Act. Balance</th>';
            echo '<th scope="col" class="rounded-q7">Act. Status</th>';
            echo '<th scope="col" class="rounded-q4">Date Added</th>';
            echo '</tr>';
            echo '</thead>';
        
            echo '<tbody>';
 	
        while($row = mysqli_fetch_assoc($a))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
             echo "<td>" . $row['number'] . "</td>";
             echo "<td>" . $row['description'] . "</td>";
             echo "<td>" . $row['normal'] . "</td>";
             echo "<td>" . $row['type'] . "</td>";
             echo "<td>" . $row['balance'] . "</td>";
             echo "<td>" . $row['status'] . "</td>";
             echo "<td>" . $row['date_added'] . "</td>";
             echo "</tr>";
            }
        echo "</table>";        
        
   echo '</tbody>';
echo '</table>';
		   }
		     if(mysqli_fetch_assoc($result1) != false)
            {
 echo ' <table id="rounded-corner" summary="2007 Major IT Companies Profit" style="margin:auto;"> ';
  echo '<thead>';
    	echo '<tr>';
        	echo '<th scope="col" class="rounded-company">Trans ID</th>';
            echo '<th scope="col" class="rounded-q2">Acct. ID</th>';
            echo '<th scope="col" class="rounded-q3">Set ID</th>';
            echo '<th scope="col" class="rounded-q3">Acct. Type</th>';
            echo '<th scope="col" class="rounded-q5">Amount</th>';
            echo '<th scope="col" class="rounded-q6">Created By</th>';
            echo '<th scope="col" class="rounded-q4">Date Added</th>';
        echo '</tr>';
    echo '</thead>';
        
    echo '<tbody>';
 	
        while($row = mysql_fetch_assoc($b))
            {
         		
				
				 $q = mysql_query("SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

	             while($row2 = mysql_fetch_assoc($q))
	             {
	             	echo "<tr>";
             		echo "<td>" . $row['trans_id'] . "</td>";
            		 echo "<td>" . $row['acct_id'] . "</td>";
            		 echo "<td>" . $row['set_id'] . "</td>";
             		echo "<td>" . $row['type'] . "</td>";
             		echo "<td>" . $row['amount'] . "</td>";
					echo "<td>" . $row['user_added'] . "</td>";
            		 echo "<td>" . $row['date_added'] . "</td>";
            		 echo "</tr>";
	             
	            
 	             }
				 
			}
        echo "</table>";        
        
   echo '</tbody>';
echo '</table>';

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

