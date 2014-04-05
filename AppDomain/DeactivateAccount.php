<?php

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
	Redirect::to('index.php');
}

if(Input::exists())
{
	if(Token::check(Input::get('token')))
	{	
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'status' => array('required' => true),

			));
	}

	if($validation->passed())
	{
		try
		{
			$account->update(array(
				'status' => Input::get('status'),
				));
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
		<title>Deactivate Accounts</title>
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
	                <li class="nav-header">Features</li>
					<li style="margin-left:190px"><a href="adminHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li class="active" style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
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
					  <li><a href="CreateAccount.php">Create Account</a></li>
					  <li class="active"><a href="DeactivateAccount.php">Deactivate Account</a></li>
					  <li><a href="CreateUsers.php">Create Users</a></li>
					  <li><a href="EditUsers.php">Edit Users</a></li>
					  
					</ul>
	        	</div>
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
               <form name="form1" method="post" action="" style="margin-left:175px">
	        	<span id="spryselect1">
	        	<label for="Account ID:" style="color:#FFF;">Account Name</label>
	        	<select name="name" id="name">
	              	  	<?php $con = mysql_connect("localhost","host","test"); 
						mysql_select_db('test')?> 
					   	<?php $result = mysql_query('SELECT * FROM accounts'); ?> 
					   	<?php while($row = mysql_fetch_assoc($result)) { ?> 
					       	<option value="<?php echo htmlspecialchars($row['name']);?>"> 
					           	<?php echo htmlspecialchars($row['name']); ?> 
					       	</option> 
					   	<?php } ?>
					   	<?php mysql_close();
					   	?> 
           	      </select>
           	      <input type="checkbox" name="status">
                <br/>
	        	<span class="selectRequiredMsg">Please select an item.</span></span>
	        	<input name="Deactivate" type="submit" value="Deactive" class="btn btn-large btn-success" style="margin-top:-10px;">
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
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
</body>

