<?php
require_once 'core/init.php';
$user = new User();
if(!$user->data()->groups==3)
{
	Redirect::to('index.php');
}
?>

<head>
		<meta charset="utf-8">
		<title>Homepage</title>
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
			<h1><a href="#"><span class="center2" style="color:#5bb75b"\>Astute Software Solutions</span></a></h1>
			<!-- Navigation -->
		  <div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">
	               <li class="active" style="margin-left:190px"><a href="AccountantHomepage.html">Home</a></li>
	                <li style="margin-left:25px"><a href="aboutus.html" >About Us</a></li>
                    <li  style="margin-left:25px"><a href="services.html">Services</a></li>
	                <li  style="margin-left:25px"><a href="contactus.html">Contact Us</a></li>
                    <li style="margin-left:25px"><a href="logout.php">Log out</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
	     	<form name="form1" method="post" action="accountantsearchpage.php" style="margin-left:650px">
	        	  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
	        	    <input type="text" name="searchid" id="Username">
	        	    <span class="textfieldRequiredMsg">A value is required.</span></span>
        	  
              <input name="Sumbit" type="submit" value="Search" class="btn btn-small btn-success" style="margin-top:-10px;">
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
                      <li><a href="viewreportsaccountant.php">Reports</a></li>
                      
					  
					</ul>
	        	</div>
                
	        	<!-- Right side Content Vertical Area -->
	        	<div class="span8">
            
                 <div class="scrollbox" style="margin-left:-140px;" >
            <h1  style="color:#5bb75b; margin:auto;">Hello, world!</h1>
            <p >This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique. Let’s look at an example from the consumer point of view that we will show how red tape and lack of communication can lead to problems. In the beginning of this semester, I talked with my advisor about my candidacy for graduation. After talking with her, I was informed that I need two more courses to graduate this semester. At that time, I was currently registered for fourteen course hours and two courses would put me at twenty hours. Following the correct procedures, I filled out a course overload form which would allow me to override into the two courses.  After I received the department chair’s signature and the form was processed, I believed that my issue was solved. Contrary to my belief, my issue was not solved. After talking to the department chair, I was informed that I was not put into my two designated classes. He said that he forgot to tell an administrative assistant to add me into my desired classes. This shows the lack of communication between the department chair and administrative assistants.  I asked him if they could put me in the class now, but he said no because the add/drop period was over.  I tried to plead with him, but he kept informing me that there was nothing he could do in my situation.  This shows how red tape policies can interfere with objectives.  Although I followed the correct procedures ahead of time, the lack of communication between departments caused my issue to go unresolved. Due to their red tape, he was not able to correct their mistake and used it as an excuse.</p>
            
          </div>
                


        	  </div>
          </div>

	        <!-- Footer Section -->
	  
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
