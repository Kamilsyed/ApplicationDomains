<?php
require_once 'core/init.php';
ini_set('display_errors',1); 
error_reporting(E_ALL);


if(Input::exists())
{
/*   if(Token::check(Input::get('token')))
   {*/
       $validate = new Validate();
       $validation = $validate->check($_POST, array(
           'username' => array('required' => true),
           'password' => array('required' => true)
           ));

       if($validation->passed())
       {
           $user = new User();

           $remember = (Input::get('remember') === 'on') ? true : false;
           $login = $user->login(Input::get('username'), Input::get('password'), $remember);

           if($login)
           {
               $level = $user->data()->groups;

               switch($level)
               {
               	case '1':
               		Redirect::to('AdminHomepage.html');
               	break;
               	case '2':
               		Redirect::to('ManagerHomepage.html');
               	break;
               	case '3':
               		Redirect::to('AccountantHomepage.html');
               	default:
               		//DISPLAY POP UP ERROR
               	break;
               }
           }
           else
           {
               echo "<p>Sorry, logging in failed!</p>";
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
		<title>Welcome to Astute Software! Please Log in.</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css">
	</head>
    <style>
	body{
		background-color:#000000;
		
	}
	h1{
	
	margin:auto;
	text-align:center;	
	}
	form {
		
	margin-left:200px;	
		
	}
	
	</style>
	<body>
		
		<!-- The Main wrapper div starts -->
		<div class="container">
			<!-- header content -->
			<h1><a href="#"><span class="center2" style="color:#5bb75b"\>Astute Software Solutions</span></a></h1>
			<!-- Navigation -->
			<div class="navbar">
	          
	        </div>
                      <!-- Marketing area -->
	        <div class="hero-unit">
	        	<h3><blockquote>Welcome To Astute Accounting Software</blockquote></h3>
        	  <form name="form1" method="post" action="" style="margin:auto;":>
	        	  <span id="sprytextfield1" style="margin-left:345px" >
	        	    <label for="username">Username:</label>
	        	    <input type="text" name="username" id="username">
	        	    <span class="textfieldRequiredMsg">A value is required.</span></span>
        	  
              <span id="sprypassword1" style="margin-left:345px">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password">
              <span class="passwordRequiredMsg">A value is required.</span></span>
              
            <span id="sprycheckbox1">
            <input type="checkbox" name="remember" id="remember">
            <label for="Remember Me">Remember Me</label>
            
              
              <br/>   
              <input name="Sign-In" type="submit" value="Sign-In" class="btn btn-large btn-success">
              </form> 
              </div>
	        <!-- Footer Section -->
	        <hr>
	        <div class="row">
				<div class="span4" style="margin-left:50x">
					<h4 class="muted text-center">About Us</h4>
					<p> We are software firm that specializes in Accounting based software. During our five years of operation, We have developed quality pratices, prinicples and protocols which allows us to create efficient and effective software.</p>
					<a href="#" class="btn"><i class="icon-user"></i> Our Staff</a>
				</div>
				<div class="span4">
					<h4 class="muted text-center">Know Our Services</h4>
					<p> We offer many services pertaining to Accounting. Admin personnel will be able to create and update accounts. Accountants will be able to journalize transactions. Managers will be able to post transaction and view reports such as trial balance, balance and income sheet, etc </p>
					<a href="#" class="btn btn-success"><i class="icon-star icon-white"></i> Services</a>
				</div>
				<div class="span4">
					<h4 class="muted text-center">Contact Us</h4>
					<p>We currently have one location in Cobb County.<br>
                    <i>1100 South Marietta Parkway, Marietta, Ga 30060</i></p>
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
		<script scr="bootstrap.js">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
        </script>
	</body>
