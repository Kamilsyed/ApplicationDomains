<?php
//ini_set('display_startup_errors', TRUE);
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
require_once 'core/init.php';


    $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

    if (!$con)
        {
             die('Could not connect: ' . mysql_error());
        }

   
    $result = mysqli_query($con, "SELECT * FROM accounts");

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
	                <li><a href="index.php">Logout</a></li>
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
					  <li class="active"><a href="AccountantHomepage.php">Chart of Accounts</a></li>
					  <li><a href="JournalizeTransactions.php">Journalize Transactions</a></li>
					  <li><a href="ViewOpenTransaction.html">View Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactions.html">View Finalized Transactions</a></li>
                      
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
               <form name="form1" method="post" action="" style="margin-left:175px">
	        	  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
	        	    <label for="Username"><h4 style="color:#FFF;">Search:</h4></label>
	        	    <input type="text" name="Username" id="Username">
	        	   <span class="textfieldRequiredMsg">A value is required.</span></span>
        	  
              <input name="Submit" type="submit" value="Submit" class="btn btn-small btn-success" style="margin-top:-10px;">
              </form> 
                
                
<table id="rounded-corner" summary="Trial Balance">
  <thead>
        <tr>
            <th scope="col" class="rounded-company">Account Name</th>
            <th scope="col" class="rounded-q1">Debit Amount</th>
            <th scope="col" class="rounded-q4">Credit Amount</th>
          
        </tr>
    </thead>

	<tbody>
        <?php
        $totaldebit=0;
        $totalcredit=0;
        
        while($row = mysqli_fetch_assoc($result))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
             $side= $row['normal'];
             
             if($side=="debit")
             {
             	echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . 'xxx' . "</td>";
                $totaldebit+= $row['total'];
             }
             
             if($side=="credit")
             {
				echo "<td>" . 'xxx' . "</td>";             
             	echo "<td>" . $row['total'] . "</td>";
                $totalcredit+= $row['total'];
             }
             
             echo "</tr>";
            }
  		echo "<tr>";
        echo "<th class=trbpt>" . 'Total' . "</th>";
        echo "<td class=trbdrat align=right>" . $totaldebit . "</td>";
		echo "<td class=trbcrat align=right>" . $totalcredit . "</td>";
        echo "</table>";        
        ?>
        
   </tbody>
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
</script>
</body>

