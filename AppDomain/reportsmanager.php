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
	$fromdate="fromdate" . "0:00:00";
	$todate="todate" . "23:59:59";
	$report="SelectReport";
	
$result = mysql_query("SELECT * FROM accounts WHERE date_added >= '$fromdate'  AND date_added < '$todate' )");
	
$result2 = mysql_query("SELECT * FROM accounts WHERE type='Asset' AND  date_added >= '$fromdate'  AND date_added < '$todate' )");
	
$result3 = mysql_query("SELECT * FROM accounts WHERE type='Liability' AND  date_added >= '$fromdate'  AND date_added < '$todate' )");
	
$result4 = mysql_query("SELECT * FROM accounts WHERE type='Equity' AND  date_added >= '$fromdate'  AND date_added < '$todate' )");
    
	if(!$result)
        {
        die(mysql_error());
        }
		
	if(!$result2)
        {
        die(mysql_error());
        }
		
	if(!$result3)
        {
        die(mysql_error());
        }
		
	if(!$result4)
        {
        die(mysql_error());
        }
    
?>

<head>
		<meta charset="utf-8">
		<title>View Report</title>
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
	                <li style="margin-left:190px"><a href="MangerHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
	     	     <form name="form1" method="post" action="reportsmanager.php" style="margin-left:100px">
	           <span id="spryselect2">
	           <select name="SelectReport" id="Select Report">
               <option value="TrialBalance" >Trial Balance</option>
               <option value="BalanceSheet">Balance Sheet</option>
               <option value="IncomeStatement">Income Statement</option>
               </select>
	           <span class="selectRequiredMsg">Please select an item.</span></span>
               <input type="date" name="fromdate">
               <input type="date" name="todate">
	           <input name="Go" type="submit" value="Go" class="btn btn-med btn-success" style="margin-top:-10px;">
              </form> 
                
          
<!-- Content Sections -->
	        <div class="row">
	        	<!-- Left Side Vertical Bar -->
	        	<div class="span4">
	        		<ul class="nav nav-list">
					  <li class="nav-header">Features</li>
					  <li class="active"><a href="managerchartofaccounts.html">Chart of Accounts</a></li>
					  <li><a href="PostTransactions.html">Post Transactions</a></li>
					  <li><a href="ViewOpenTransactions.html">Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactions.html">Final Transactions</a></li>
                       <li><a href="viewreportsmanager.html">Reports</a></li>
					  
					</ul>
	        	</div>
                
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
              
<?php 
 
 switch($report)
 {   
 	case "TrialBalance": 
	
	echo ' <table id="rounded-corner" summary="Trial Balance"> ';
  	echo "<thead>";
        echo '<tr>';
            echo '<th scope="col" class="rounded-company">Account Name</th>';
            echo '<th scope="col" class="rounded-q1">Debit Amount</th>';
            echo '<th scope="col" class="rounded-q4">Credit Amount</th>';
          
        echo '</tr>';
    echo '</thead>';

	echo '<tbody>';
        
		
		
		
		
        $totaldebit=0;
        $totalcredit=0;
        
        while($row = mysql_fetch_assoc($result))
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
       
        
  	    echo '</tbody>';
		echo '</table>';
		
		break;
 
 		case "BalanceSheet":
		
		echo '<table id="rounded-corner" summary="Balance Sheet">';
 	    echo '<thead>';
         echo '<tr>';
            echo '<th scope="col" class="rounded-company"> Assets</th>';
             echo '<th scope="col" class="rounded-q4">Total Amount</th>';
          
         echo '</tr>';
     echo '</thead>';

	 echo '<tbody>';
       
        $totaldebit=0;
		
        while($row = mysql_fetch_assoc($result))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
			 echo "<td>" . $row['total'] . "</td>";
             $totaldebit+= $row['total'];        
             echo "</tr>";
            }
  		echo "<tr>";
        echo "<th class=trbpt>" . 'Total:' . "</th>";
        echo "<td class=trbdrat align=right>" . $totaldebit . "</td>";
        echo "</table>";        
        
        
    echo '</tbody>';
 echo '<br/>';
 
 echo '<table id="rounded-corner" summary="Balance Sheet">';
   echo '<thead>';
         echo '<tr>';
             echo '<th scope="col" class="rounded-company"> Liabilities</th>';
             echo '<th scope="col" class="rounded-q4">Total Amount</th>';
          
         echo '</tr>';
     echo '</thead>';

	 echo '<tbody>';
        
		
        $totalcredit=0;
		
        while($row = mysql_fetch_assoc($result2))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
			 echo "<td>" . $row['total'] . "</td>";
             $totalcredit+= $row['total'];        
             echo "</tr>";
            }
  		echo "<tr>";
        echo "<th class=trbpt>" . 'Total:' . "</th>";
        echo "<td class=trbdrat align=right>" . $totalcredit . "</td>";
        echo "</table>";        
        
        
    echo '</tbody>';
 echo '</table>';
 echo '<br/>';

 echo '<table id="rounded-corner" summary="Balance Sheet">';
   echo '<thead>';
         echo '<tr>';
             echo '<th scope="col" class="rounded-company">Stockholder Equity</th>';
             echo '<th scope="col" class="rounded-q4">Total Amount</th>';
          
         echo '</tr>';
     echo '</thead>';

	 echo '<tbody>';
        
        $totalcredit2=0;
        
		while($row = mysql_fetch_assoc($result3))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
			 echo "<td>" . $row['total'] . "</td>";
             $totalcredit2+= $row['total'];        
             echo "</tr>";
            }
  		echo "<tr>";
        echo "<th class=trbpt>" . 'Total:' . "</th>";
        echo "<td class=trbdrat align=right>" . $totalcredit2 . "</td>";
        echo "</table>";        
        
        
    echo '</tbody>';

 echo '</table>';

		break;
 
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

