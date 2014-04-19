<?php
//ini_set('display_startup_errors', TRUE);
//ini_set('display_errors',1); 
//error_reporting(E_ALL);

require_once 'core/init.php';
$user = new User();
if(!$user->data()->groups==2)
{
	Redirect::to('index.php');
}



    $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

    if (!$con)
        {
             die('Could not connect: ' . mysqli_error($con));
        }

     
    $result = mysqli_query($con,"SELECT * FROM accounts");

    if(!$result)
        {
        die(mysqli_error($con));
        }
    
?>
<head>
		<meta charset="utf-8">
		<title>Chart Of Accounts</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css">
	</head>
    
	<style>
	body{
		background-color:#000000;
		
	}
	h1{
	
	margin:auto;
	text-align:center;	
	}
	form {
		
	margin-left:200px;	
		
	}
	
	</style>
	<body>
		
		<!-- The Main wrapper div starts -->
		<div class="container">
			<!-- header content -->
			<h1><a href="#"><span class="center2" style="color:#5bb75b"\>Astute Software Solutions</span></a></h1>
			<div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">
	               <li style="margin-left:190px"><a href="ManagerHomepage.php">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
            
            <form name="form1" method="post" action="managersearchpage.php" style="margin-left:650px">
	        	  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
	        	    <input type="text" name="searchid" id="Username" 	>
	        	    <span class="textfieldRequiredMsg">A value is required.</span></span>
        	  
              <input name="Sumbit" type="submit" value="Search" class="btn btn-small btn-success" style="margin-top:-10px;">
              </form> 
              
	        <div class="hero-unit" style="background-color:#000;">
            	
                <h2 style="margin:auto; color:#FFFFFF;"><blockquote style="background-color:#000000; color:#FFFFFF; ">Chart Of Accounts</blockquote></h2>
                <br>
	        	<table id="rounded-corner" summary="2007 Major IT Companies' Profit" style="margin:auto;">
  <thead>
    	<tr>
        	<th scope="col" class="rounded-q1">Act. Name</th>
            <th scope="col" class="rounded-q2">Act. Number</th>  
            <th scope="col" class="rounded-q3">Normal Side</th>
            <th scope="col" class="rounded-q5">Act. Type</th>
            <th scope="col" class="rounded-q6">Act. Total</th>
            <th scope="col" class="rounded-q7">Act. Status</th>
            <th scope="col" class="rounded-q4">User Added</th>
            <th scope="col" class="rounded-q4">Date Added</th>
            <th scope="col" class="rounded-q3">Act. Description</th>
        </tr>
    </thead>
        
    <tbody>
 	 	<?php
        while($row = mysqli_fetch_assoc($result))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
             echo "<td>" . $row['number'] . "</td>";
             echo "<td>" . $row['normal'] . "</td>";
             echo "<td>" . $row['type'] . "</td>";
             echo "<td>" . $row['balance'] . "</td>";
             if(intval($row['status'])==1)
				{
					echo "<td>Active</td>";
				}
			else
				{
					echo"<td>Inactive</td>";
				}
             echo "<td>" . $row['user_added'] . "</td>";
             echo "<td>" . $row['date_added'] . "</td>";
             echo "<td>" . $row['description'] . "</td>";

             echo "</tr>";
            }
        echo "</table>";        
        ?>
    </tbody>
</table>
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
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
        </script>
	</body>