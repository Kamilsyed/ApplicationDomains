<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);

require_once 'core/init.php';
$user = new User();
if($user->data()->groups!=1 || !$user->isLoggedIn())
{
  Redirect::to('index.php');
}
if(Input::exists())
{
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array('required' => true, 'min' => 2, 'unique' => 'accounts'),
            'description' => array(),
            'normal' => array('dropdown_not_default' => 'Select'),
            'type' => array('dropdown_not_default' => 'Select')
            
            ));

        if($validation->passed())
        {
            $account = new Account();
            $user = new User();
            $num = $account->get_number(Input::get('type'));
            //$u = $user->data()->username;
            date_default_timezone_set('America/New_York');
            $time = date("Y-m-d H:i:s");
            $bal = intval(Input::get('balance'));

            if($bal < 0)
            {
              $bal *= -1;
            }

            try
            {
                $account->create(array(
                    'user_added' => $user->data()->username,
                    'name' => Input::get('name'),
                    'number' => $num,
                    'description' => Input::get('description'),
                    'type' => Input::get('type'),
                    'normal' => Input::get('normal'),
                    'status' => 1,
                    'date_added' => $time,
                    'balance' => $bal
                    ));

                $event = new Event();

                $event->account_event(Input::get('name'), $num, $user->data()->username, $bal);
                Redirect::to('AdminHomepage.php');
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
        else
        {
            foreach($validation->errors() as $error)
            {
                echo $error, '<br>';
            }
        }
}

?>

<head>
		<meta charset="utf-8">
		<title>Create an Account</title>
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
			<h1><a href="#"><span class="center2" style="color:#5bb75b"\>Astute Software Solutions</span></a></h1>
			<!-- Navigation -->
		  <div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">
	                <li style="margin-left:190px"><a href="AdminHomepage.php">Home</a></li>
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
					  <li><a href="adminchartofaccounts.php">Chart of Accounts</a></li>
					  <li class="active"><a href="CreateAccount.php">Create Account</a></li>
					  <li><a href="accountdetails.php">Change Account Status</a></li>
					  <li><a href="CreateUsers.php">Create Users</a></li>
					  <li><a href="EditUsers.php">Edit Users</a></li>
            <li><a href="EventLogA.php">Event Log</a></li>
					  
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
                 <form name="form1" method="post" action="">
               	 <span id="sprytextfield1">
               	 <label for="Account Name" style="color:#FFF;">Account Name</label>
               	 <input type="text" name="name" id="name">
                 
                 
            	<label for="Account Description" style="color:#FFF;">Account Desription</label>
            	<textarea name="description" id="description" cols="45" rows="5"></textarea>
            	
                
                <span id="spryselect1">
                <label for="normal" style="color:#FFF;">Normal Side</label>
                <select name="normal" id="normal">
                <option>Select</option>
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
                </select>
          		
                
                <span id="spryselect2">
                <label for="type" style="color:#FFF;">Account Type</label>
                <select name="type" id="type">
                <option>Select</option>
                 <option value="Current Assets">Current Assets</option>
                 <option value="Long Term Assets">Long-Term Assets</option>
                <option value="Current Liabilities">Current Liabilities</option>
                 <option value="Long Term Liabilities">Long-Term Liabilites</option>
                <option value="Equity">Equity</option>
                <option value="Operating Revenue">Operating Revenue</option>
                <option value="Operating Expenses">Operating Expenses</option>
                <option value="Non-Operating Revenue">Non-Operating Revenue</option>
                <option value="Non-Operating Expenses">Non-Operating Expenses</option>
                </select>
          		<span class="selectRequiredMsg">Please select an type.</span></span>
                
                <span id="sprytextfield3">
                <label for="Account Total" style="color:#FFF;">Starting Balance</label>
                <input type="text" name="balance" id="Account Total">
          		<span class="textfieldRequiredMsg">A value is required.</span></span>
                 <br>
                 <br>
               	 <input name="Create" type="submit" value="Create" class="btn btn-large btn-success">
              </form>
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
