<?php
/*These values are for testing/development purposes only and should be set to 0 'ZERO'
after development is finished.*/
ini_set('display_startup_errors',1);
ini_set('display_errors',1); 

require_once 'core/init.php';

/*This web page will collect data on transactions, validate those transactions
and insert them into the database. PHP will NOT execute if no input is detected.*/

if(Input::exists())
{
	/*
	 Needed variables declared here:
		$accountname = name of the account selected by the user
		$amount = ARRAY value from HTML of ammounts text box
		$transaction = new transaction object to create transactions
		$account = new account object to access data on accounts
		$types = ARRAY value from HTML of transaction types
		$user = new user object to get current username
		$set = new set to create a new transaction set
	*/
	$accountname = Input::get('accountname');
	$amount = Input::get('amount');
	$transaction = new Transaction();
	$account = new Account();
	$types = Input::get('type');
	$user =  new User();
    date_default_timezone_set('America/New_York');
    $set = new Set();
   
      
    /*$file = 'userFile';
	$upload = Set::upload($file);
	$fileName = $upload['file_name'];
	$fileType = $upload['file_type'];
	$fileSize = $upload['file_size'];
	$fileData = $upload['file_data'];*/


    /*This validates the amounts in the transactions, and checks for duplicate account entries.
    If the amount of credit and debit transactions do NOT match OR there are duplicate account entries
    then the page will display an error window.*/
    if($transaction->balanced($types, $amount))
    {        
    	  $DB = mysqli_connect('localhost','host','test','test');
        
      
            
            $fileName = mysqli_real_escape_string($DB, $_FILES['userFile']["name"]);
            $fileSize = mysqli_real_escape_string($DB, $_FILES['userFile']['size']);
            $fileData = mysqli_real_escape_string($DB, file_get_contents($_FILES['userFile']["tmp_name"]));
            $fileType = mysqli_real_escape_string($DB, $_FILES['userFile']["type"]);
            $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf"/*, "txt"*/);
            $temp = explode(".", $_FILES['userFile']["name"]);
            //$ext = end($temp);
            $temp2 = end($temp);
            $ext = (string) $temp2;

            if ((($_FILES['userFile']["type"] == "image/gif")
            || ($_FILES['userFile']["type"] == "image/jpeg")
            || ($_FILES['userFile']["type"] == "image/jpg")
            || ($_FILES['userFile']["type"] == "image/pjpeg")
            //|| ($_FILES["upload"]["type"] == "text/plain")
            || ($_FILES['userFile']["type"] == "image/x-png")
            || ($_FILES['userFile']["type"] == "application/pdf")
            || ($_FILES['userFile']["type"] == "image/png"))
            && ($_FILES['userFile']["size"] < 1024000)
            && in_array($ext, $allowedExts))
            {
            	try
				{
					$set->create(array(
						'description' => Input::get('description'),
						'user_added' => $user->data()->username,
						'date_added' => date("Y-m-d H:i:s"),
						'type' => 1,
						'file_name'=>$fileName,
						'file_type'=>$fileType,
						'file_size'=>$fileSize,
						'file_data'=>$fileData
						));
				}
				catch(Exception $e)
				{
					Redirect::to('errors/500.php');
				}
		    }
		    else
		    	echo "Not acceptable file.";
		        
	
      	/*
		Create a set passing description text field in HTML
		user_added is a function call to $user to get current username
		type defaults to 1 'ONE' alias for OPEN TRANSACTION DO NOT CHANGE TYPE
		*/
		

		/*After set is created, an ID for that set is retrieved. This will be the linking variable for all inserted
		transactions.*/
		$set_id = $set->get_last_id();

        for($y = 0; $y < count($amount); $y++)
        {
        	$account->find($accountname[$y]);
        	$acct_number = $account->data()->number;
        	/*$account->update_balance($acct_number, $types[$y], floatval($amount[$y]));*/

        	try
            {
                $transaction->create(array(
                	'acct_id' => $acct_number,
                	'set_id' => $set_id,
                	'amount' => floatval($amount[$y]),
                	'type' => $types[$y], 
                    'user_added' => $user->data()->username,
                    'date_added' => date("Y-m-d H:i:s")
                    ));
            }
            catch(Exception $e)
            {
				Redirect::to('errors/500.php');
            }
        }
    }
    else
    {
    	Redirect::to('errors/500.php');
    }
}

?>

<head>
		<meta charset="utf-8">
		<title>Journalize Transaction</title>
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
<script type="text/javascript" src="js/script.js"></script> 
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
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
	                <li style="margin-left:190px"><a href="AccountantHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
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
					  <li><a href="Accountantchartofaccounts.php">Chart of Accounts</a></li>
					  <li class="active"><a href="JournalizeTransactions.php">Journalize Transactions</a></li>
					  <li><a href="ViewOpenTransactionsaccountant.php">View Open Transactions</a></li>
                      <li><a href="ViewFinalizedTransactionsaccountant.php">View Finalized Transactions</a></li>
                      
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8" spry:region="mulitple">
	        		<form enctype="multipart/form-data" action="" method="post">
	        		<input type="button" value="Add Account" onClick="addRow('account')"class="btn btn-med btn-success" /> 
					<input type="button" value="Remove Account" onClick="deleteRow('account')" class="btn btn-med btn-success" /> 
	        		<input name="Journalize" type="submit" value="Journalize" class="btn btn-med btn-success" />
		                 
		               	  
		            
			               	  <span id="sprytextarea1">
			               	  <label for="Transaction Description" style="color:#FFFFFF;">Transaction Description</label>
			               	  <textarea name="description" id="Transaction Description" cols="45" rows="5"></textarea>
			               	  <br/>
		              	 
		              	  
		              	  <!--first Account-->
		              	  <table id="account" class="form">
		              	  <tr>
		              	  		<td><input type="checkbox" required="required" name="chk[]" /></td>
		              	  		<td>
				              	  	<span id="spryselect2">
					             		<label for="accountname" style="color:#FFFFFF;">Account</label>
					            		<select name="accountname[]" id="account">
						            		<?php $con = mysql_connect("localhost","root","test"); 
												mysql_select_db('test');?> 
										   	<?php $result = mysql_query('SELECT * FROM accounts ORDER BY name'); ?> 
										   	<?php while($row = mysql_fetch_assoc($result)) { ?> 
										       	<option value="<?php echo htmlspecialchars($row['name']);?>"> 
										           	<?php echo htmlspecialchars($row['name']) . "-" . htmlspecialchars($row['type']); ?> 
										       	</option> 
										   	<?php } ?>
										   	<?php mysql_close();?> 
					            		</select>
					            		<!--error message-->
					            	<span class="selectRequiredMsg">Please select an account.</span></span>     
			            		</td>
			            		<!--Select a Side-->
			            		<td>
			            		<span id="spryselect3">
              					<label for="type" style="color:#FFFFFF;">Side</label>
              					<select name="type[]" id="type[]">
              						<option value="Select">Select one...</option>
              						<option value="debit">Debit</option>
              						<option value="credit">Credit</option>
              					</select>
              					<span class="selectRequiredMsg">Please select a side</span></span>
			            		</td>
			            		<td>
		             			<!--select first amount-->
		             			<span id="sprytextfield3">
				                <label for="amount[]" style="color:#FFFFFF;">Amount</label>
				                	<input type="text" name="amount[]" id="amount[]">
			          	 		<span class="textfieldRequiredMsg">A numeric value is required.</span></span> 
			            		<span id="spryselect2"></span>
			            		</td>
			            		</tr>
		            		<tr>							
		              <!--second Account-->
		              		<td><input type="checkbox" required="required" name="chk[]" /></td>
		              		<td>
		              	  <span id="spryselect2">
			             		<label for="accountname" style="color:#FFFFFF;">Account</label>
			            		<select name="accountname[]" id="account">
				            		<?php $con = mysql_connect("localhost","root","test"); 
										mysql_select_db('test');?> 
								   	<?php $result = mysql_query('SELECT * FROM accounts ORDER BY name'); ?> 
								   	<?php while($row = mysql_fetch_assoc($result)) { ?> 
								       	<option value="<?php echo htmlspecialchars($row['name']);?>"> 
								           	<?php echo htmlspecialchars($row['name']) . "-" . htmlspecialchars($row['type']); ?> 
								       	</option> 
								   	<?php } ?>
								   	<?php mysql_close();?> 
			            		</select>
			            		<!--error message-->
			            		<span class="selectRequiredMsg">Please select an account.</span></span>     
		             			</td>
		             			<td>
			            		<span id="spryselect3">
              					<label for="type" style="color:#FFFFFF;">Side</label>
              					<select name="type[]" id="type[]">
              						<option value="Select">Select one...</option>
              						<option value="debit">Debit</option>
              						<option value="credit">Credit</option>
              					</select>
              					<span class="selectRequiredMsg">Please select a side</span></span>
			            		</td>
		             			<td>
		             			<!--select second amount-->
		             			<span id="sprytextfield3">
				                <label for="amount[]" style="color:#FFFFFF;">Amount</label>
				                	<input type="text" name="amount[]" id="amount[]">
			          	 		<span class="textfieldRequiredMsg">A numeric value is required.</span></span> 
			            		<span id="spryselect2"></span> 
			            		</td>
			            		
			            	</tr>  
			            	<input type="file" size=50 name="userFile">      				
             		 </form>
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
<script>
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 10){							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Accounts per transaction is 10.");
			   
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 2) { 						// limit the user from removing all the fields
				alert("Cannot Remove all the Accounts.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}
</script>
<script type="text/javascript">
var sc_project=9046834; 
var sc_invisible=1; 
var sc_security="ec55ba17"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script scr="js/bootstrap.js">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>

