<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);

require_once 'core/init.php';
$user = new User();
if($user->data()->groups!=1 && !$user->isLoggedIn())
{
  Redirect::to('index.php');
}
if(Input::exists())
{
	if(Token::check(Input::get('token')))
	{
		$validate = new Validate();
	
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true, 'min' => 6, 'max' => 25, 'unique' => 'users', /*'user' => true*/),
			'password' => array('required' => true, 'min' => 6, 'max' => 25, 'password' => true),
			'password_again' => array('required' => true, 'matches' => 'password'),
			'first' => array('required' => true, 'min' => 1, 'max' => 25, 'name' => true),
			'last' => array('required' => true, 'max' => 25, 'name' => true),
			'groups' => array('required' => true)
		));

		if($validation->passed())
		{
			

			$salt = Hash::salt(32);

			try
			{
				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'fname' => Input::get('first'),
					'lname' => Input::get('last'),
					'groups' => Input::get('groups')
					));

				Session::flash('home', 'You have registered a user');
				Redirect::to('AdminHomepage.html');
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
}

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
					  <li><a href="DeactivateAccount.php">Deactivate Account</a></li>
					  <li class="active"><a href="CreateUsers.php">Create Users</a></li>
					  <li><a href="EditUsers.php">Edit Users</a></li>					  
					</ul>
	        	</div>






	        	<!-- Right side Content Vertical Area -->
	         <div class="span8">
 				<form name="form1" method="post" action="" style="margin:auto;":>

                <span id="sprytextfield1">
	        	 <label for="Username" style="color:#FFF;">Username</label>
	        	 <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	        	 <span class="textfieldRequiredMsg">A Username is required.</span></span>  

                <span id="sprytextfield2">
          		 <label for="Password" style="color:#FFF;">Password</label>
          		 <input type="password" name="password" id="password" value="<?php echo escape(Input::get('password')); ?>" autocomplete="off">         		
          		 <span class="textfieldRequiredMsg">A Password is required.</span></span>

          		<span id="sprytextfield3">
          		 <label for="Password" style="color:#FFF;">Confirm Password</label>
          		 <input type="password" name="password_again" id="password_again" value="<?php echo escape(Input::get('password_again')); ?>" autocomplete="off">          		
                 <span class="textfieldRequiredMsg">Enter Password again.</span></span>


	        	 <span id="spryselect1">
          			<label for="groups" style="color:#FFF;">User Type</label>
          			<select name="groups" id="groups">
           				<option value="1">Admin</option>
          	  			<option value="3">Accountant</option>
              			<option value="2">Manager</option>
          			</select>
          <span class="selectRequiredMsg">Please select a user type.</span></span>

	        	<span id="sprytextfield5">
	        	 <label for="fname" style="color:#FFF;">First Name</label>
	        	 <input type="text" name="first" id="first" value="<?php echo escape(Input::get('first')); ?>" autocomplete="off">
	        	 <span class="textfieldRequiredMsg">A First Name is required.</span></span>

	        	<span id="sprytextfield6">
	        	 <label for="lname" style="color:#FFF;">Last Name</label>
	        	 <input type="text" name="last" id="last" value="<?php echo escape(Input::get('last')); ?>" autocomplete="off">
	        	 <span class="textfieldRequiredMsg">A Last Name is required.</span></span>

                <br/>   
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<input type="submit" value="Add User"class="btn btn-large btn-success"></td>
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
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
</body>

