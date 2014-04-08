<?php
require_once 'core/init.php';
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
            <h1><a href="#"><span class="center2" style="color:#5bb75b"\>Astute Software Solutions</span></a></h1>
            <!-- Navigation -->
          <div class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <ul class="nav">
                    <li class="active" style="margin-left:285px"><a href="#">Home</a></li>
                    <li style="margin-left:25px"><a href="#" >About Us</a></li>
                    <li style="margin-left:25px"><a href="#">Contact Us</a></li>
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
                      <li<a href="JournalizeTransactions.php">Journalize Transactions</a></li>
                      <li><a href="ViewOpenTransactionsaccountant.php">View Open Transactions</a></li>
                      <li class="active"><a href="ViewFinalizedTransactionsaccountant.php">View Finalized Transactions</a></li>
                      
                    </ul>
                </div>
                <!-- Right side Content Vertical Area -->
                <div class="span8">
               <form name="form1" method="post" action="" style="margin-left:175px">
                  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
                    <label for="Username"><h4 style="color:#FFF;">Search:</h4></label>
                    <input type="text" name="Username" id="Username">
                    <span class="textfieldRequiredMsg">A value is required.</span></span>
              
              <input name="Sumbit" type="submit" value="Sumbit" class="btn btn-small btn-success" style="margin-top:-10px;">
              </form> 
                
                
<table id="rounded-corner">
  <thead> <h3 style="margin-left:190px; color:#FFFFFF">Posted Transaction Log</h3>
        <tr>
            <th scope="col" class="rounded-company">Set Description</th>
            <th scope="col" class="rounded-q1">User Added</th>
            <th scope="col" class="rounded-q3">Date Added</th>
            <th scope="col" class="rounded-q4">Modified By</th>
            <th scope="col" class="rounded-q5">Date Modified</th>
            <th scope="col" class="rounded-q6">Comments</th>            
        </tr>
    </thead>
        
    <tbody>
        <?php
            $con = mysql_connect("localhost","host","test");

            if (!$con)
            {
                 die('Could not connect: ' . mysql_error());
            }

            mysql_select_db('test'); 
            $result = mysql_query("SELECT * FROM sets WHERE type='2'");

            if(!$result)
            {
                die(mysql_error());
            }

            while($row = mysql_fetch_assoc($result))
                {

                echo "<tr>";
                echo "<th scope='col' class='rounded-company'>". $row['description'] . "</th>";
                echo "<th scope='col' class='rounded-q2'>". $row['user_added'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['date_added'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['user_changed'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['date_changed'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['comment'] . "</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th scope='col' class='rounded-q1'>Account Name</th>";
                echo "<th scope='col' class='rounded-q1'>DR</th>";
                echo "<th scope='col' class='rounded-q1'>CR</th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "</tr>"; 
                 
                $q = mysql_query("SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row2 = mysql_fetch_assoc($q))
                {
                    if($row2['type'] == 'debit' || $row2['type'] == 'Debit')
                    {
                    $account1 = new Account();
                    $account1->findByNumber($row2['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account1->data()->name . "</td>";
                    echo "<td>" . $row2['amount'] . "</td>";
                    echo "<td>---</td>";
                    echo "</tr>";
                    }
                }

                $q2 = mysql_query("SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row3 = mysql_fetch_assoc($q2))
                {
                    if($row3['type'] == 'credit' || $row3['type'] == 'Credit')
                    {
                    $account2 = new Account();
                    $account2->findByNumber($row3['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account2->data()->name . "</td>";
                    echo "<td>---</td>";
                    echo "<td>" . $row3['amount'] . "</td>";
                    echo "</tr>";
                    }
                }
                 
                 echo "</tr>";
                }

                ?>        
    </tbody>
</table>


<table id="rounded-corner">
  <thead> <h3 style="margin-left:190px; color:#FFFFFF"> Rejected Transaction Log</h3>
        <tr>
            <th scope="col" class="rounded-company">Set Description</th>
            <th scope="col" class="rounded-q1">User Added</th>
            <th scope="col" class="rounded-q3">Date Added</th>
            <th scope="col" class="rounded-q4">Modified By</th>
            <th scope="col" class="rounded-q5">Date Modified</th>
            <th scope="col" class="rounded-q6">Comments</th>
            
        </tr>
    </thead>
        
    <tbody>
           <?php
            $con = mysql_connect("localhost","root","test");

            if (!$con)
            {
                 die('Could not connect: ' . mysql_error());
            }

            mysql_select_db('test'); 
            $result = mysql_query("SELECT * FROM sets WHERE type='3'");

            if(!$result)
            {
                die(mysql_error());
            }

            while($row = mysql_fetch_assoc($result))
                {

                echo "<tr>";
                echo "<th scope='col' class='rounded-company'>". $row['description'] . "</th>";
                echo "<th scope='col' class='rounded-q2'>". $row['user_added'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['date_added'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['user_changed'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['date_changed'] . "</th>";
                echo "<th scope='col' class='rounded-q1'>". $row['comment'] . "</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th scope='col' class='rounded-q1'>Account Name</th>";
                echo "<th scope='col' class='rounded-q1'>DR</th>";
                echo "<th scope='col' class='rounded-q1'>CR</th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "</tr>"; 
                 
                $q = mysql_query("SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row2 = mysql_fetch_assoc($q))
                {
                    if($row2['type'] == 'debit' || $row2['type'] == 'Debit')
                    {
                    $account1 = new Account();
                    $account1->findByNumber($row2['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account1->data()->name . "</td>";
                    echo "<td>" . $row2['amount'] . "</td>";
                    echo "<td>---</td>";
                    echo "</tr>";
                    }
                }

                $q2 = mysql_query("SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row3 = mysql_fetch_assoc($q2))
                {
                    if($row3['type'] == 'credit' || $row3['type'] == 'Credit')
                    {
                    $account2 = new Account();
                    $account2->findByNumber($row3['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account2->data()->name . "</td>";
                    echo "<td>---</td>";
                    echo "<td>" . $row3['amount'] . "</td>";
                    echo "</tr>";
                    }
                }
                 
                 echo "</tr>";
                }

                ?>
        
    </tbody>
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

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script scr="js/bootstrap.js">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>
