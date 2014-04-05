<?php
//ini_set('display_startup_errors', TRUE);
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
require_once 'core/init.php';


    $con = mysql_connect("localhost","host","test");

    if (!$con)
        {
             die('Could not connect: ' . mysql_error());
        }

    mysql_select_db('test'); 
	$id=$_POST["searchid"];
	
    
    $result = mysql_query("SELECT * FROM transactions WHERE id = $id ");
	
    if(!$result)
        {
        die(mysql_error());
        }
            
?>

<head>
		<meta charset="utf-8">
		<title>Final Transactions</title>
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
	                 <li style="margin-left:190px"><a href="MangerHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
	     	<form name="form1" method="post" action="transactionsearchpagemanager.php"style="margin-left:650px">
	        	  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
	        	    <input type="text" name="searchid" id="Username" value="`Search by Trans ID`">
	        	    <span class="textfieldRequiredMsg">A value is required.</span></span>
        	  
              <input name="Submit" type="submit" value="Search" class="btn btn-small btn-success" style="margin-top:-10px;">
              </form> 
          
<!-- Content Sections -->
	        <div class="row">
	        	<!-- Left Side Vertical Bar -->
	        	<div class="span4">
	        		<ul class="nav nav-list">
					 <li class="nav-header">Features</li>
					  <li ><a href="managerchartofaccounts.html">Chart of Accounts</a></li>
					  <li><a href="PostTransactions.html">Post Transactions</a></li>
                       <li ><a href="edittransactions.html">Edit Transactions</a></li>
					  <li ><a href="ViewOpenTransactions.html">Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactions.html">Final Transactions</a></li>
                      <li><a href="viewreportsmanager.html">Reports</a></li>
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
                
                
<table id="rounded-corner">
  <thead> <h3 style="margin-left:190px; color:#FFFFFF">Transaction Log</h3>
    	<tr>
        	<th scope="col" class="rounded-company">Trans. ID</th>
        	<th scope="col" class="rounded-q1">Trans. Description</th>
            <th scope="col" class="rounded-q3">Debited Act.</th>
            <th scope="col" class="rounded-q2">Debited Amt.</th>
            <th scope="col" class="rounded-q5">Credited Act.</th>
            <th scope="col" class="rounded-q6">Credited Act.</th>
            <th scope="col" class="rounded-q7">Status</th>
            <th scope="col" class="rounded-q7">Date Added</th>
            <th scope="col" class="rounded-q4">Created By</th>
            
        </tr>
    </thead>
        
    <tbody>
    	<?php
		
    	while($row = mysql_fetch_assoc($result))
            {
             echo "<tr>";
             echo "<td>" . $row['id'] . "</td>";
             echo "<td>" . $row['description'] . "</td>";
             echo "<td>" . $row['debit account'] . "</td>";
             echo "<td>" . $row['debit amount'] . "</td>";
             echo "<td>" . $row['credit account'] . "</td>";
             echo "<td>" . $row['credit amount'] . "</td>";
             echo "<td>" . $row['status'] . "</td>";
             echo "<td>" . $row['date_added'] . "</td>";
             echo "<td>" . $row['user'] . "</td>";
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

