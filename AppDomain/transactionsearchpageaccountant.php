<?php
//ini_set('display_startup_errors', TRUE);
//ini_set('display_errors',1); 
//error_reporting(E_ALL);

require_once 'core/init.php';
$user = new User();
if($user->data()->groups!=3 || !$user->isLoggedIn())
{
	Redirect::to('index.php');
}



    $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

    if (!$con)
        {
             die('Could not connect: ' . mysql_error());
        }

    
	$id=$_POST["searchid"];
	
    
    $result = mysqli_query($con, "SELECT * FROM transactions WHERE id = $id ");
	
    if(!$result)
        {
        die(mysqli_error($con));
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
	                 <li style="margin-left:190px"><a href="AccountantHomepage.php">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
	     	<form name="form1" method="post" action="transactionsearchpageaccountant.php"style="margin-left:650px">
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
					  <li><a href="accountantchartofaccounts.html">Chart of Accounts</a></li>
					  <li ><a href="JournalizeTransactions.html">Journalize Transactions</a></li>
					  <li><a href="ViewOpenTransactionsAccountant.html">Open Transactions</a></li>
                      <li ><a href="ViewFinalizedTransactionsAccountant.html">Finalized Transactions</a></li>
                      <li><a href="viewreportsaccountant.html">Reports</a></li>
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
		
    	while($row = mysqli_fetch_assoc($result))
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

