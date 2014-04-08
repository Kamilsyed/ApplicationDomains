<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);
require_once 'core/init.php';


    $con = mysqli_connect("localhost","host","test", "test");

    if (!$con)
        {
             die('Could not connect: ' . mysqli_error($con));
        }

  
	 
	$fromdate=$_POST["fromdate"] . "0:00:00";
	$todate=$_POST["todate"] . "23:59:59";
	$report=$_POST["SelectReport"];
	
$result = mysqli_query($con, "SELECT * FROM accounts WHERE date_added >= '$fromdate'  AND date_added < '$todate' ");
	
$result2 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Asset%' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");
	
$result3 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Liabilities%' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");
	
$result4 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Equity%' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");

$result5 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Operating Revenue' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");

$result6 = mysqli_query($con, "SELECT * FROM accounts WHERE name LIKE '%Goods Sold%' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");

$result7 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Operating Expenses' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");

$result8 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Non-Operating Revenue' AND name !='Sales Discounts' AND name !='Sales Returns and Allowances' AND   date_added >= '$fromdate'  AND date_added < '$todate' ");

$result9 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Non-Operating Expenses' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");

$result10 = mysqli_query($con, "SELECT * FROM accounts WHERE name='Sales Returns and Allowances' OR name='Sales Discounts' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");

$result11 = mysqli_query($con, "SELECT * FROM accounts WHERE name='Purchase Returns and Allowances' OR name='Purchase Discounts' AND  date_added >= '$fromdate'  AND date_added < '$todate' ");



    if(!$result)
        {
       		die(mysqli_error($con));
        }
		
	if(!$result2)
        {
        die(mysqli_error($con));
        }
		
	if(!$result3)
        {
        die(mysqli_error($con));
        }
		
	if(!$result4)
        {
        die(mysqli_error($con));
        }
		
	if(!$result5)
        {
        die(mysqli_error($con));
        }
		
	if(!$result6)
        {
        die(mysqli_error($con));
        }
		
	if(!$result7)
        {
        die(mysqli_error($con));
        }
		
	if(!$result8)
        {
        die(mysqli_error($con));
        }
	if(!$result9)
        {
        die(mysqli_error($con));
        }
    
		if(!$result10)
        {
        die(mysqli_error($con));
        }
		
		if(!$result11)
        {
        die(mysqli_error($con));
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
        
        while($row = mysqli_fetch_assoc($result))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
             $side= $row['normal'];
             
             if($side=="Debit")
             {
             	echo "<td>" . $row['balance'] . "</td>";
                echo "<td>" . 'xxx' . "</td>";
                $totaldebit+= $row['balance'];
             }
             
             if($side=="Credit")
             {
				echo "<td>" . 'xxx' . "</td>";             
             	echo "<td>" . $row['balance'] . "</td>";
                $totalcredit+= $row['balance'];
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
		
        while($row = mysqli_fetch_assoc($result2))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
			 echo "<td>" . $row['balance'] . "</td>";
             $totaldebit+= $row['balance'];        
             echo "</tr>";
            }
  		echo "<tr>";
        echo "<th class=trbpt>" . 'Total:' . "</th>";
        echo "<td class=trbdrat align=right>" . $totaldebit . "</td>";
        echo "</table>";        
        
		echo "<tr>";
        
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
		
        while($row = mysqli_fetch_assoc($result3))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
			 echo "<td>" . $row['balance'] . "</td>";
             $totalcredit+= $row['balance'];        
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
        
		while($row = mysqli_fetch_assoc($result4))
            {
             echo "<tr>";
             echo "<td>" . $row['name'] . "</td>";
			 echo "<td>" . $row['balance'] . "</td>";
             $totalcredit2+= $row['balance'];        
             echo "</tr>";
            }
  		echo "<tr>";
        echo "<th class=trbpt>" . 'Total:' . "</th>";
        echo "<td class=trbdrat align=right>" . $totalcredit2 . "</td>";
        echo "</table>";        
        
        
    echo '</tbody>';

 echo '</table>';

		break;
		
	case "IncomeStatement":
	
	
echo '<table id="rounded-corner" summary="2007 Major IT Companies Profit">';

  echo '<thead> <h3 style="margin-left:190px; color:#FFFFFF">Income Statement</h3>';
    	echo '<tr>';
        	echo '<th scope="col" colspan="2" class="rounded-company"><b>Gross Profit</b></th>';
        	
        echo '</tr>';
    echo '</thead>';
        
   echo '<tbody>';
   
    $grossprofit=0;
	$operatingrev=0;
    $operatingexp=0;
    $operatingincome=0;
    $nonoperatingrev=0;
    $nonoperatingexp=0;
	$nonoperatingsub=0;
    $netincome=0;
	$cost=0;
        
        while($row = mysqli_fetch_assoc($result5))
        {
    		echo '<tr>';
        	echo "<td>" . '&nbsp;&nbsp;'. $row['name'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
			$operatingrev+=$row['balance'];
            
           
        	echo '</tr>';
        }
		
			 while($row = mysqli_fetch_assoc($result10))
        {
        
       	 echo '<tr>';
        	echo "<td>" . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo "<td>" . '-' . $row['balance'] . "</td>";
           	$operatingrev-= $row['balance'];
        echo '</tr>';
        
        }
		
		echo "<tr>";
        echo "<td>" . '<b>Total Operating Revenue:</b>' . "</td>";
        echo "<td>" . '<b>' . $operatingrev . '</b>' . "</td>";
        echo "</tr>";
		
		echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
        
        while($row = mysqli_fetch_assoc($result6))
        {
        
       	 echo '<tr>';
        	echo "<td>" . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo "<td>"  . $row['balance'] . "</td>";
			$cost+= $row['balance'];
        echo '</tr>';
        
        }
		
		 while($row = mysqli_fetch_assoc($result11))
        {
        
       	 echo '<tr>';
        	echo "<td>" . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo "<td>" . '-' . $row['balance'] . "</td>";
           	$cost-= $row['balance'];
        echo '</tr>';
        
        }
		
		echo "<tr>";
        echo "<td>" . '<b>Total Cost Of Goods Sold:</b>' . "</td>";
        echo "<td>" . '<b>'  . $cost . '</b>' . "</td>";
        echo "</tr>";
		
		echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		
        $grossprofit=($operatingrev-$cost);
		
        echo "<tr>";
        echo "<td>" . '<b>Gross Profit:</b>' . "</td>";
        echo "<td>" . '&nbsp;&nbsp;&nbsp;&nbsp;' .'<b>'  . $grossprofit . '</b>' . "</td>";
        echo "</tr>";  
        
        
        
        echo '<tr><th scope="col" colspan="2" class="rounded-company"><b>Operating Income</b></th></tr>';
        
		while($row = mysqli_fetch_assoc($result7))
        {
        
        	echo '<tr>';
        
        	echo "<td>" . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
			$operatingexp+= $row['balance'];
        
        	echo '</tr>';
        
		}
		
		echo "<tr>";
        echo "<td>" . '&nbsp;'. '<b>Total Operating Expenses:</b>' . "</td>";
        echo "<td>" . '<b>'  . $operatingexp . '</b>' . "</td>";
        echo "</tr>";  
        
        echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		$operatingincome=$grossprofit-$operatingexp;
		echo "<tr>";
        echo "<td>" . '<b>Total Operating Income:</b>' . "</td>";
        echo "<td>" . '<b>'  . $operatingincome . '</b>' . "</td>";
        echo "</tr>";
		
		
		
        echo '<tr><th scope="col" colspan="2" class="rounded-company"><b>Non-Operating Revenues</b></th></tr>';
		
        while($row = mysqli_fetch_assoc($result8))
        {
			echo '<tr>';
        
        	echo "<td>" . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
			$nonoperatingrev+= $row['balance'];
        
        	echo '</tr>';
			
			
		}
		
		echo "<tr>";
        echo "<td>" . '<b>Total Non-Operating Revenues:</b>' . "</td>";
        echo "<td>" . '<b>'  . $nonoperatingrev . '</b>' . "</td>";
        echo "</tr>";
		

        
        echo '<tr><th scope="col" colspan="2" class="rounded-company"><b>Non-Operating Expenses</b></th></tr>';
		
        while($row = mysqli_fetch_assoc($result9))
        {
			echo '<tr>';
        
        	echo "<td>" . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
			$nonoperatingexp+= $row['balance'];
        
        	echo '</tr>';
			
			
		}
		
		echo "<tr>";
        echo "<td>" . '<b>Total Non-Operating Expenses:</b>' . "</td>";
        echo "<td>" .'<b>' . $nonoperatingexp .'</b>' . "</td>";
        echo "</tr>";
		
		
		echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		
		$nonoperatingsub=$nonoperatingrev-$nonoperatingexp;
		
		$netincome=$operatingincome+$nonoperatingsub;
		
		        echo '<tr>';
				echo '<th scope="col" class="rounded-company"><b>Net Income:</b></th>';
				echo "<td>" .'<b>' . $netincome . '</b>' . "</td>";

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

