<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);

require_once 'core/init.php';
$user = new User();
if(!$user->data()->groups==3 || !$user->isLoggedIn())
{
	Redirect::to('index.php');
}



    $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

    if (!$con)
        {
             die('Could not connect: ' . mysqli_error($con));
        }

  
	 
	 
	$todate=$_POST["todate"] . "23:59:59";
	$header=$_POST["todate"]. "23:59:59";
	$report=$_POST["SelectReport"];
	
	date_default_timezone_set('America/New_York');
	
	$date=date_create($header);
	
	$hea= date_format($date,"l F jS Y");
	
$result = mysqli_query($con, "SELECT * FROM accounts WHERE date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");
	
$result2 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Current Asset%' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' AND balance > 0 ");

$result21 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Long Term Asset%' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' AND balance > 0 ");
	
$result3 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Current Liabilities%' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' AND balance > 0 ");

$result31 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Long Term Liabilities%' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' AND balance > 0 ");
	
$result4 = mysqli_query($con, "SELECT * FROM accounts WHERE type LIKE '%Equity%' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' AND balance > 0 ");

$result5 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Operating Revenue' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");

$result6 = mysqli_query($con, "SELECT * FROM accounts WHERE name LIKE '%Goods Sold%' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");

$result7 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Operating Expenses' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' AND name !='Cost of Goods Sold' ");

$result8 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Non-Operating Revenue' AND name !='Sales Discounts' AND name !='Sales Returns and Allowances' AND   date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");

$result9 = mysqli_query($con, "SELECT * FROM accounts WHERE type='Non-Operating Expenses' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");

$result10 = mysqli_query($con, "SELECT * FROM accounts WHERE name='Sales Returns and Allowances' OR name='Sales Discounts' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");

$result11 = mysqli_query($con, "SELECT * FROM accounts WHERE name='Purchase Returns and Allowances' OR name='Purchase Discounts' AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");

$result12 = mysqli_query($con, "SELECT * FROM transactions WHERE acct_id=100000000 AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");


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
	               <li style="margin-left:190px"><a href="AccountantHomepage.php">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
	     	     <form name="form1" method="post" action="reportsaccountant.php" style="margin-left:100px">
	           <span id="spryselect2">
	           <select name="SelectReport" id="Select Report">
               <option value="TrialBalance" >Trial Balance</option>
               <option value="BalanceSheet">Balance Sheet</option>
               <option value="IncomeStatement">Income Statement</option>
               </select>
	           <span class="selectRequiredMsg">Please select an item.</span></span>
               <input type="date" name="todate">
	           <input name="Go" type="submit" value="Go" class="btn btn-med btn-success" style="margin-top:-10px;">
              </form> 
          
<!-- Content Sections -->
	        <div class="row">
	        	<!-- Left Side Vertical Bar -->
	        	<div class="span4">
	        		<ul class="nav nav-list">
					  <li class="nav-header">Features</li>
                      <li><a href="accountantchartofaccounts.php">Chart Of Accounts</a></li>
					  <li><a href="JournalizeTransactions.php">Journalize Transactions</a></li>
					  <li><a href="ViewOpenTransactionsAccountant.php">Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactionsAccountant.php">Finalized Transactions</a></li>
                      <li class="active"><a href="viewreportsaccountant.php">Reports</a></li>
                      
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
            
                

<?php 
 
 switch($report)
 {   
 	case "TrialBalance": 
	
	
	echo ' <table id="rounded-corner" summary="Trial Balance"> ';
  	echo '<thead>';
	echo '<th scope="col" class="rounded-company" align="center" colspan="3"> <b>Astute Solutions<br>Balance Sheet<br> As of ' . $hea. '</b></th>';
        echo '<tr bordercolor="">';
		
            echo '<th scope="col" class="rounded-company" align="center"><b>Account</b></th>';
            echo '<th scope="col" class="rounded-q1" align="center"><b>DR</b></th>';
            echo '<th scope="col" class="rounded-q4" align="center"><b>CR</b></th>';
          
        echo '</tr>';
    echo '</thead>';

	echo '<tbody>';
        
		
		
		
		
        $totaldebit=0;
        $totalcredit=0;
		$dcount=1;
        $count=1;
		
        while($row = mysqli_fetch_assoc($result))
            {
             echo "<tr>";
             echo '<td align="left">' . $row['name'] . "</td>";
             $side= $row['normal'];
             
			   if($side=="debit" && $dcount==1)
             {
             	echo '<td align="right">' .'$' . number_format($row['balance'],2) . "</td>";
                echo '<td align="center">' . '&nbsp;' . "</td>";
                $totaldebit+= $row['balance'];
				$dcount++;
             }
             
             
             else if($side=="credit" && $count==1)
             {
				echo '<td align="center">' . '&nbsp;' . "</td>";             
             	echo '<td align="right">' .'$' . number_format($row['balance'],2) . "</td>";
                $totalcredit+=$row['balance'];
				$count++;
             }
			 
			  if($side=="debit" && $dcount > 2 )
             {
             	echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
                echo '<td align="center">' . '&nbsp;' . "</td>";
                $totaldebit+= $row['balance'];
             }
			 
			  if($side=="credit" && $count > 2)
             {
				echo '<td align="center">' . '&nbsp;' . "</td>";             
             	echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
                $totalcredit+=$row['balance'];
             }
             
             $dcount++;
			 $count++;
			 
             echo "</tr>";
            }
			
  		echo "<tr>";
        echo '<th align="left">' . '<b>' . 'Total:' . '</b>' . "</th>";
        echo "<td  align=right>" . '<u style="text-decoration:underline; border-bottom: 1px double #000;">' . number_format($totaldebit,2) . '</u>' . "</td>";
		echo "<td  align=right>" . '<u style="text-decoration:underline; border-bottom: 1px double #000;">' . number_format($totalcredit,2) . '</u>' . "</td>";
        echo "</table>";        
       
        
  	    echo '</tbody>';
		echo '</table>';
		
		break;
 
 		case "BalanceSheet":
		
		
		echo '<table id="rounded-corner" summary="Balance Sheet">';
 	    echo '<thead>';
         echo '<tr>';
            echo '<th scope="col" class="rounded-company" align="center" colspan="2"> <b>Astute Solutions<br>Balance Sheet<br> As of ' . $hea. '</b></th>';
           
          
         echo '</tr>';
     echo '</thead>';

	 echo '<tbody>';
       
        $totalcurassets=0;
		$totallongassets=0;
	    $totalassets=0;
		
			
		
			 echo "<tr>";
             echo '<td align="left" style="font-size:20px">' . '<b>' . 'Assets' . '</b>' . "</td>";
			 echo '<td align="center">' . '&nbsp' . "</td>";       
             echo "</tr>";
			 
			 echo "<tr>";
             echo '<td align="left" style="font-size:16px">'  . '<b>' .  'Current Assets:' . '</b>' .  "</td>";
			 echo '<td align="center">' . '&nbsp;' . "</td>";       
             echo "</tr>";
			 
			$size=mysqli_num_rows($result2);
			$count=1;
        while($row = mysqli_fetch_assoc($result2))
            {
				
			if($count==1)
			{
			 echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '$'  . number_format($row['balance'],2) . "</td>";
             $totalcurassets+= $row['balance'];        
             echo "</tr>";
			 $count++;
				
			}
			
			else if($count==$size)
			{
			 echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '<u>' . number_format($row['balance'],2) . '</u>' . "</td>";
             $totalcurassets+= $row['balance'];        
             echo "</tr>";
			 $count++;	
			
			}
			
			else
			{
             echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
             $totalcurassets+= $row['balance'];        
             echo "</tr>";
			 $count++;
			 
			}
			
            }	
  		echo "<tr>";
        echo '<td align="left">' . '&nbsp;&nbsp;&nbsp;'  . 'Total current assets' . "</td>";
        echo '<td align="right">'  . number_format($totalcurassets,2)  . "</td>";
        echo "</tr>";
		
		
		
		echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		
		
		 echo "<tr>";
             echo '<td align="left" style="font-size:16px">'  . '<b>' .  'Long-Term Assets:' . '</b>' .  "</td>";
			 echo '<td align="center">' . '&nbsp;' . "</td>";       
             echo "</tr>";
		
		$size2=mysqli_num_rows($result21);
		$count2=1;
        while($row = mysqli_fetch_assoc($result21))
            {
			
			if( $count2==$size2)
			{
             echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '<u>' . number_format($row['balance'],2) . '</u>' . "</td>";
             $totallongassets+= $row['balance'];        
             echo "</tr>";
			 
			}
			else
			{
			 echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
             $totallongassets+= $row['balance'];        
             echo "</tr>";
			 $count2++;
			 
			}
			
            }
			$totalassets=$totalcurassets + $totallongassets;
				
  		echo "<tr>";
        echo '<td align="left">' . '&nbsp;&nbsp;&nbsp;&nbsp;'  . 'Total assets' . "</td>";
        echo '<td align="right">' .'<u style="text-decoration:underline; border-bottom: 1px double #000;">' .'$' . number_format($totalassets,2) . '</u>' .  "</td>";
        echo "</tr>";
		   
        echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		
         
		 
		 
         $totalcurlib=0;
		$totallonglib=0;
	    $totallib=0;
		
		
			 echo "<tr>";
               echo '<td align="left" style="font-size:20px">' . '<b>' . ' Liabilities' . '</b>' . "</td>";
			 echo '<td align="center">' . '&nbsp' . "</td>";       
             echo "</tr>";
			 
			 echo "<tr>";
             echo '<td align="left" style="font-size:16px">'  . '<b>' .  'Current Liabilities:' . '</b>' .  "</td>";
			 echo '<td align="center">' . '&nbsp;' . "</td>";       
             echo "</tr>";
		
		$size3=mysqli_num_rows($result3);
		$count3=1;
        while($row = mysqli_fetch_assoc($result3))
            {
				if($count3==1)
			{
			 echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '$'  . number_format($row['balance'],2) . "</td>";
             $totalcurlib+= $row['balance'];        
             echo "</tr>";
			 $count3++;
				
			}
			
			else if($count3==$size3)
			{
			 echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '<u>' .number_format($row['balance'],2) . '</u>' . "</td>";
             $totalcurlib+= $row['balance'];        
             echo "</tr>";
			 $count3++;	
            }
			
			else
			{
             echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
             $totalcurlib+= $row['balance'];        
             echo "</tr>";
			 $count3++;
			 
			}
		}
  		echo "<tr>";
        echo '<td align="left">' . '&nbsp;&nbsp;&nbsp;&nbsp;'  . 'Total current liabilities' . "</td>";
        echo '<td align="right">' . number_format($totalcurlib,2)  . "</td>";
        echo "</tr>";
		
		
		
		echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		
		
		 echo "<tr>";
              echo '<td align="left" style="font-size:16px">'  . '<b>' .  'Long-Term Liabilities:' . '</b>' .  "</td>";
			 echo '<td align="center">' . '&nbsp;' . "</td>";       
             echo "</tr>";
		
		
		$size4=mysqli_num_rows($result31);
		$count4=1;
        while($row = mysqli_fetch_assoc($result31))
            {
           	if( $count4==$size4)
			{
             echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '<u>' . number_format($row['balance'],2) . '</u>' . "</td>";
             $totallonglib+= $row['balance'];        
             echo "</tr>";
			 
			}
			else
			{
			 echo "<tr>";
             echo '<td align="left" >' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . number_format($row['balance'],2). "</td>";
             $totallonglib+= $row['balance'];        
             echo "</tr>";
			 $count4++;
			 
			}
			
            
            }
			$totallib=$totalcurlib + $totallonglib;
				
  		echo "<tr>";
        echo '<td align="left">' . '&nbsp;&nbsp;&nbsp;&nbsp;'  . 'Total liabilties' . "</td>";
        echo '<td align="right">' . '<u style="text-decoration:underline; border-bottom: 1px double #000;">' .'$' . number_format($totallib,2) . '</u>' .  "</td>";
        echo "</tr>";
		
		
		echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		
			 echo "<tr>";
             echo '<td align="left" style="font-size:20px">' . '<b>' . "Stockholder's Equity" . '</b>' . "</td>";
			 echo '<td align="right">' . '&nbsp' . "</td>";       
             echo "</tr>";
			 
			 $equity=0;
			 $totalrightside=0;	
			 $size5=mysqli_num_rows($result4);
		 	 $count5=1;
				
		while($row = mysqli_fetch_assoc($result4))
            {
                 
           	if( $count5==$size5)
			{
             echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . '<u>' . number_format($row['balance'],2) . '</u>' . "</td>";
             $equity+= $row['balance'];        
             echo "</tr>";
			 
			}
			else
			{
			 echo "<tr>";
             echo '<td align="left">' . '&nbsp;&nbsp;'  . $row['name'] . "</td>";
			 echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
             $equity+= $row['balance'];        
             echo "</tr>";
			 $count5++;
			 
			}
			
            
            }
  		echo "<tr>";
        echo '<td align="left">' . '&nbsp;&nbsp;&nbsp;&nbsp;' . "Total Stockholder's Equity:" . "</td>";
        echo '<td  align="right">' . '<u>' . number_format($equity,2) . '</u>' . "</td>";
        echo "</tr>"; 
		
		$totalrightside+= $totallib + $equity;
		
		echo "<tr>";
        echo '<td align="left">' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "Total Liabilities &amp; Stockholder's Equity:" . "</td>";
         echo '<td align="right">' .'<u style="text-decoration:underline; border-bottom: 1px double #000;">' .'$' . number_format($totalrightside,2) . '</u>' .  "</td>";
        echo "</tr>";      
        
        
    echo '</tbody>';
 echo '</table>';

		break;
		

		
	case "IncomeStatement":
	
echo '<table id="rounded-corner" summary="2007 Major IT Companies Profit">';

  echo '<thead>';
    	echo '<tr>';
        	 echo '<th scope="col" class="rounded-company" align="center" colspan="3"> <b>Astute Solutions<br>Income Statement<br> As of ' . $hea. '</b></th>';
        	
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
	$o=0;
        
        while($row = mysqli_fetch_assoc($result5))
        {
    	
			$operatingrev+=$row['balance'];
        }
		
			 while($row = mysqli_fetch_assoc($result10))
        {
        
           	$operatingrev-= $row['balance'];
        
        }
		
		echo "<tr>";
        echo '<td align="left">' . 'Net Sales' . "</td>";
		echo '<td></td>';
        echo '<td align="right">' . '$' . number_format($operatingrev,2)  . "</td>";
        echo "</tr>";
		
        
        while($row = mysqli_fetch_assoc($result6))
        {
			$cost+= $row['balance'];
        
        }
		
		 while($row = mysqli_fetch_assoc($result11))
        {
           	$cost-= $row['balance'];
        
        }
		
		echo "<tr>";
        echo '<td align="left">' . 'Total Cost Of Goods Sold' . "</td>";
		echo '<td></td>';
        echo '<td align="right">'. '&nbsp;&nbsp;' . '<u>' . '(' . number_format($cost,2)  . ')' . '</u>' . "</td>";
        echo "</tr>";
		
        $grossprofit=($operatingrev-$cost);
		
        echo "<tr>";
        echo '<td align="left" style="font-size:16px">' . 'Gross Profit' . "</td>";
		echo '<td></td>';
        echo '<td align="right">' . '&nbsp;&nbsp;' .'<u>'  . number_format($grossprofit,2) .  '</u>' . "</td>";
        echo "</tr>";  
        
        echo '<tr>';
		echo '<td align="left" style="font-size:16px">'  . 'Operating Expenses:' . "</td>";
        echo '<td></td>';
		echo '<td></td>';
		echo '</tr>';
		
		$size10=mysqli_num_rows($result7);
		$count10=1;
		while($row = mysqli_fetch_assoc($result7))
        {
        	if($count10==1)
		{
        	echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo '<td align="right">' . '$' . number_format($row['balance'],2) . "</td>";
			echo '<td></td>';
			$operatingexp+= $row['balance'];
        
        	echo '</tr>';
			$count10++;
		}
		
		else if($count10==$size10)
		{
			echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo '<td align="right">' . '<u>' . number_format($row['balance'],2) . '</u>' . "</td>";
			$operatingexp+= $row['balance'];
			 echo '<td align="right">' . '<u>' . '(' . number_format($operatingexp,2) .')' . '</u>' . "</td>";
			
        
        	echo '</tr>';
			$count10++;
			
			
		}
		
		else
		{
			echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
			echo '<td></td>';
			$operatingexp+= $row['balance'];
        
        	echo '</tr>';
			$count10++;
			
		}
		
		
		}
		 
		$operatingincome=$grossprofit-$operatingexp;
		echo "<tr>";
        echo '<td align="left" style="font-size:16px">' . 'Operating Income' . "</td>";
		echo '<td></td>';
        echo '<td align="right">' .  number_format($operatingincome,2)  . "</td>";
        echo "</tr>";
		
		
		echo "<tr>";
        echo '<td align="left" style="font-size:16px">' . 'Non Operating Revenue:' . "</td>";
		echo '<td></td>';
        echo '<td></td>';
        echo "</tr>";
		
		
        while($row = mysqli_fetch_assoc($result8))
        {
			echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
			echo '<td></td>';
            echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
			$nonoperatingrev+= $row['balance'];
        
        	echo '</tr>';
			
			
		}
	
		
       echo "<tr>";
        echo '<td align="left" style="font-size:16px">' . 'Non Operating Expenses:' . "</td>";
		echo '<td></td>';
        echo '<td></td>';
        echo "</tr>";
		
		
		$size11=mysqli_num_rows($result9);
		$count11=1;
        while($row = mysqli_fetch_assoc($result9))
        {
			        	if($count11==1)

		{
        	echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo '<td align="right">' . '$' . number_format($row['balance'],2) . "</td>";
			echo '<td></td>';
			$nonoperatingexp+= $row['balance'];
        
        	echo '</tr>';
			$count11++;
		}
		
		else if($count11==$size11)
		{
			echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo '<td align="right">' . '<u>' . number_format($row['balance'],2) . '</u>' . "</td>";
			$nonoperatingexp+= $row['balance'];
			 echo '<td align="right">' . '<u>' . '(' . number_format($nonoperatingexp,2) .')' . '</u>' . "</td>";
			
        
        	echo '</tr>';
			$count11++;
			
			
		}
		
		else
		{
			echo '<tr>';
        
        	echo '<td align="left">' . '&nbsp;&nbsp;' . $row['name'] . "</td>";
            echo '<td align="right">' . number_format($row['balance'],2) . "</td>";
			echo '<td></td>';
			$nonoperatingexp+= $row['balance'];
        
        	echo '</tr>';
			$count11++;
			
		}
			
		}
		
		
		$nonoperatingsub=$nonoperatingrev-$nonoperatingexp;
		
		$netincome=$operatingincome+$nonoperatingsub;
		
		        echo '<tr>';
				if( $netincome < 0)
				{
				echo '<td align="left" style="font-size:16px">' . '<b>Net Income{Loss}</b></td>';
				}
				else
				{
					echo '<td align="left" style="font-size:16px">' . '<b>Net Income</b></td>';	
				}
				echo '<td></td>';
				echo '<td align="right">' . '<u style="text-decoration:underline; border-bottom: 1px double #000;">' .'$'  . number_format($netincome,2)  . '</u>' . "</td>";
				echo '</tr>';
				
		echo '</tbody>';
echo '</table>';


break;
	
	case 'Cashflow':

		echo '<table id="rounded-corner" summary="Cash Flow">';
 	    echo '<thead>';
         echo '<tr>';
            echo '<th scope="col" class="rounded-company" align="center" colspan="3"> <b>Astute Solutions<br>Cash Flow<br> As of ' . $hea. '</b></th>';
         echo '</tr>';
     echo '</thead>';
     echo '<tbody>';

        	 echo "<th scope='col' class='rounded-q1'>Account Name</th>";
	         echo "<th scope='col' class='rounded-q1'>DR</th>";
	         echo "<th scope='col' class='rounded-q1'>CR</th>";
	         
        

     	$setid=0;
     	while($row = mysqli_fetch_assoc($result12))
     	{
     		$setid=$row['set_id'];
     		$result13 = mysqli_query($con, "SELECT * FROM sets WHERE id=$setid AND type=2");
     		while($row2 = mysqli_fetch_assoc($result13))
     		{
     			$setid=$row2['id'];
     			$result14 = mysqli_query($con, "SELECT * FROM transactions WHERE set_id=$setid AND  date_added >= '2014-01-15 0:00:00'  AND date_added < '$todate' ");
     			while($row3 = mysqli_fetch_assoc($result14))
     			{
     				if($row3['type'] == 'debit' || $row3['type'] == 'Debit')
	             	{
		             	$account1 = new Account();
		             	$account1->findByNumber($row3['acct_id']);

						echo "<tr>";
						echo "<td>" . $account1->data()->name . "</td>";
						echo "<td>" . $row3['amount'] . "</td>";
						echo "<td></td>";
						echo "</tr>";
	             	}
	             	elseif($row3['type'] == 'credit' || $row3['type'] == 'Credit')
	             	{
		             	$account2 = new Account();
		             	$account2->findByNumber($row3['acct_id']);

						echo "<tr>";
						echo "<td>" . $account2->data()->name . "</td>";
						echo "<td></td>";
						echo "<td>" . $row3['amount'] . "</td>";
						echo "</tr>";
	             	}
     			}
     		}
     	}
     	$result15 = mysqli_query($con, "SELECT * FROM accounts WHERE number=100000000");
     	while($row4 = mysqli_fetch_assoc($result15))
     	{
	     	echo "<tr>";
			echo "<td>Total in Cash</td>";
			echo "<td></td>";
			echo "<td>" . $row4['balance'] . "</td>";
			echo "</tr>";
		}
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
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
</body>

