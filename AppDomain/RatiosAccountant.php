<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);

require_once 'core/init.php';
$user = new User();
if(!$user->data()->groups==3)
{
	Redirect::to('index.php');
}

     $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");
		    if (!$con)
		        {
		             die('Could not connect: ' . mysqli_error($con));
		        }

	$query1 = mysqli_query($con, "SELECT * FROM accounts where name='Inventory'");
	$query2 = mysqli_query($con, "SELECT * FROM accounts WHERE name LIKE '%Goods Sold%'");
	$query3 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Current Assets'");
	$query4 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Current Liabilities'");
  	$query5 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Non-Operating Revenue'OR'Operating Revenue'");
  	$query6 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Operating Expenses'");
  	$query7 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Operating Revenue'");
  	$query8 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Non-Operating Expenses'OR'Operating Expenses'");
  	$query9 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Current Assets' OR type='Long Term Assets'");
  	$query10 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Long Term Assets'");
  	$query11 = mysqli_query($con, "SELECT * FROM accounts WHERE name LIKE '%Payable%'");
  	$query12 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Equity'");

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
	                <li style="margin-left:285px"><a href="AccountantHomepage.php">Home</a></li>
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
					  <li><a href="ChartofAccounts.php">Chart of Accounts</a></li>
					  <li><a href="JournalizeTransactions.php">Journalize Transactions</a></li>
					  <li><a href="ViewOpenTransaction.php">View Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactions.php">View Finalized Transactions</a></li>
                      <li class="active"><a href="RatiosAccountant.php">Ratios</a></li>
					</ul>
	        	</div>
	        	
	        	<div class="span8">
               
                
                
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
  <thead>
  </thead>
        <tfoot>
    	<tr>
        	
        	
        </tr>
    </tfoot>
    <tbody>
    	<?php
    		/*Operating Cycle section*/
    		//Days of Inventory search
			$Inventory=mysqli_fetch_assoc($query1);
			$InvAmount = $Inventory['balance'];
			
			$CoG=0;
			while($CostAccounts=mysqli_fetch_assoc($query2))
			{
				$CoG = $CoG+$CostAccounts['balance'];
			}
			if($CoG!=0)
			{
				$result1=$InvAmount/($CoG/365);
				$result1=number_format($result1, 2);
				echo "<tr>";
				echo "<th colspan='2'>Operating Cycle</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Number of Days of Inventory</td>";
				echo "<td align='right'>" . $result1 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<th colspan='2'>Operating Cycle</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Number of Days of Inventory</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Days of Receivables search
			/*$row=mysqli_fetch_assoc($query1);
			$row2=mysqli_fetch_assoc($query2);
			if($row2['balance']!=0)
			{
				$result=$row['balance']/($row2['balance']/365);
				echo "<tr>";
				echo "<th colspan='2'>Operating Cycle</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Number of Days of Inventory</td>";
				echo "<td>" . $result . "</td>";
				echo "</tr>";
			}
			 else
			{
				echo "<tr>";
				echo "<th colspan='2'>Operating Cycle</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Number of Days of Inventory</td>";
				echo "<td>Error!</td>";
				echo "</tr>";
			}*/
			/*Liquidity*/
			//Current Ratio
	
			$CASUM = 0;
			$CLSUM =0;
			while($CA=mysqli_fetch_assoc($query3))
			{
				$CASUM = $CASUM+$CA['balance'];
			}
			while($CL=mysqli_fetch_assoc($query4))
			{
				$CLSUM = $CLSUM+$CL['balance'];
			}
			
			if($CLSUM!=0)
			{
				$result2=$CASUM/$CLSUM;
				$result2=number_format($result2, 2);
				echo "<tr>";
				echo "<th colspan='2'>Liquidity</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Current Ratio</td>";
				echo "<td align='right'>" . $result2 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<th colspan='2'>Liquidity</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Current Ratio</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Quick Ratio
			
			if($CLSUM!=0)
			{
				$result3=$CASUM-$InvAmount/$CLSUM;
				$result3=number_format($result3, 2);
				echo "<tr>";
				echo "<td>Quick Ratio</td>";
				echo "<td align='right'>" . $result3 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<td>Quick Ratio</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Net Working Capital to Sales
			$RevAmount= 0;
			while($Revenue= mysqli_fetch_assoc($query5))
			{
				$RevAmount = $RevAmount+$Revenue['balance'];
			}
			
			if($RevAmount!=0)
			{
				$result4=($CASUM-$CLSUM)/$RevAmount;
				$result4=number_format($result4, 2);
				echo "<tr>";
				echo "<td>Net Working Capital to Sales</td>";
				echo "<td align='right'>" . $result4 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<td>Net Working Capital to Sales</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}

			/*Profitability*/
			//Gross Profit Margin
			if($RevAmount!=0)
			{
				$result5=($RevAmount-$CoG)/$RevAmount;
				$result5=number_format($result5, 2);
				echo "<tr>";
				echo "<th>Profitability</th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Gross Profit Margin</td>";
				echo "<td align='right'>" . $result5 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<th>Profitability</th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Gross Profit Margin</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}

			//Operating Profit Margin
			$OpExpenses = 0;
			while($ExpAcct= mysqli_fetch_assoc($query6))
			{
				$OpExpenses = $OpExpenses+$ExpAcct['balance'];
			}
			$OpRev = 0;
			while($RevAcct= mysqli_fetch_assoc($query7))
			{
				$OpRev = $OpRev+$RevAcct['balance'];
			}
			
			if($OpRev!=0)
			{
				$result6=(($OpRev-$CoG)-$OpExpenses)/$RevAmount;
				$result6=number_format($result6, 2);
				echo "<tr>";	
				echo "<td>Operating Profit Margin</td>";
				echo "<td align='right'>" . $result6 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<td>Operating Profit Margin</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Net Profit Margin
			$TotExpenses = 0;
			while($TotExpAcct= mysqli_fetch_assoc($query8))
			{
				$TotExpenses = $TotExpenses+$TotExpAcct['balance'];
			}
			if($RevAmount!=0)
			{
				$result7=($RevAmount-$CoG-$TotExpenses)/$RevAmount;
				$result7=number_format($result7, 2);
				echo "<tr>";
				echo "<td>Net Profit Margin</td>";
				echo "<td align='right'>" . $result7 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<td>Net Profit Margin</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			/*ACTIVITY*/
			//Inventory Turnover
			if($InvAmount!=0)
			{
				$result8 = $CoG/$InvAmount;
				$result8=number_format($result8, 2);
				echo "<tr>";
				echo "<th>Activity</th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Inventory Turnover</td>";
				echo "<td align='right'>" . $result8 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<th>Activity</th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Inventory Turnover</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Total Assets Turnover
			$TotalAssets = 0;
			while($assets= mysqli_fetch_assoc($query9))
			{
				$TotalAssets = $TotalAssets+$assets['balance'];
			}
			if($TotalAssets!=0)
			{
				$result9 = $RevAmount/$TotalAssets;
				$result9=number_format($result9, 2);
				
				echo "<tr>";
				echo "<td>Total Assets Turnover</td>";
				echo "<td align='right'>" . $result9 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				
				echo "<tr>";
				echo "<td>Total Assets Turnover</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Fixed Assets Turnover
			$FixedAssets = 0;
			while($row1= mysqli_fetch_assoc($query10))
			{
				$FixedAssets = $FixedAssets+$row1['balance'];
			}
			if($FixedAssets!=0)
			{
				$result10 = $RevAmount/$FixedAssets;
				$result10=number_format($result10, 2);
				
				echo "<tr>";
				echo "<td>Fixed Assets Turnover</td>";
				echo "<td align='right'>" . $result10 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				
				echo "<tr>";
				echo "<td>Fixed Assets Turnover</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			/*Financial Leverage*/
			//Total Debt to Assets ratio
			$TotalDebt = 0;
			while($row2= mysqli_fetch_assoc($query11))
			{
				$TotalDebt = $TotalDebt+$row2['balance'];
			}
			if($InvAmount!=0)
			{
				$result11 = $TotalDebt/$TotalAssets;
				$result11=number_format($result11, 2);
				echo "<tr>";
				echo "<th>Financial Leverage</th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Total Debt to Assets</td>";
				echo "<td align='right'>" . $result11 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				echo "<tr>";
				echo "<th>Financial Leverage</th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Total Debt to Assets</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
			//Total Debt to Equity ratio
			$TotalEquity = 0;
			while($row3= mysqli_fetch_assoc($query12))
			{
				$TotalEquity = $TotalEquity+$row3['balance'];
			}
			if($TotalEquity!=0)
			{
				$result12 = $TotalDebt/$TotalEquity;
				$result12 =number_format($result12, 2);
				
				echo "<tr>";
				echo "<td>Total Debt to Equity</td>";
				echo "<td align='right'>" . $result12 . ":1</td>";
				echo "</tr>";
			}
			else
			{
				
				echo "<tr>";
				echo "<td>Total Debt to Equity</td>";
				echo "<td align='right'>Error!</td>";
				echo "</tr>";
			}
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

