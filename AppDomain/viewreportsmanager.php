<?php
require_once 'core/init.php';
$user = new User();
if($user->data()->groups!=2 || !$user->isLoggedIn())
{
	Redirect::to('index.php');
}
?>
<head>
		<meta charset="utf-8">
		<title>Report</title>
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
	                 <li style="margin-left:190px"><a href="ManagerHomepage.php">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
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
					  <li><a href="managerchartofaccounts.php">Chart of Accounts</a></li>
					  <li><a href="PostTransactions.php">Post Transactions</a></li>
                      <li ><a href="edittransactions.html">Edit Transactions</a></li>
					  <li><a href="ViewOpenTransactions.php">Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactions.php">Final Transactions</a></li>
                      <li class="active"><a href="viewreportsmanager.php">Reports</a></li>
                      <li><a href="RatiosManager.php">Ratios</a></li>
                      <li><a href="EventLogM.php">Event Log</a></li>
					  
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
               <form name="form1" method="post" action="reportsmanager.php" style="margin-left:175px">
	           <span id="spryselect2">
	           <label for="Select Report" style="color:#FFFFFF;">Select Report:</label>
	           <select name="SelectReport" id="Select Report">
               <option value="TrialBalance" >Trial Balance</option>
               <option value="BalanceSheet">Balance Sheet</option>
               <option value="IncomeStatement">Income Statement</option>
               <option value="Cashflow">Cash Flow Statement</option>
               </select>
	           <span class="selectRequiredMsg">Please select an item.</span></span>
               <br>
               <input type="date" name="todate">
              	<br>
                <br>
	           <input name="Go" type="submit" value="Go" class="btn btn-med btn-success" style="margin-top:-10px;">
              </form> 
                


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
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
</body>

