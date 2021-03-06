<?php
require_once 'core/init.php';
$user = new User();
if($user->data()->groups!=2 || !$user->isLoggedIn())
{
    Redirect::to('index.php');
}
?>
<head>
        <meta charset="utf-8">
        <title>View Finalized Transactions</title>
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
<script language="JavaScript">
            function download (id)
            {
                window.open ("download.php?fileId="+id, "hiddenFrame");
            }
</script>
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
                     <li style="margin-left:190px"><a href="ManagerHomepage.php">Home</a></li>
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
                      <li><a href="managerchartofaccounts.php">Chart of Accounts</a></li>
                      <li><a href="PostTransactions.php">Post Transactions</a></li>
                      <li><a href="edittransactions.php">Edit Transactions</a></li>
                      <li><a href="ViewOpenTransactions.php">View Open Transactions</a></li>
                      <li class="active"><a href="ViewFinalizedTransactions.php">View Finalized Transactions</a></li>
                      <li><a href="viewreportsmanager.php">Reports</a></li>
                      <li><a href="RatiosManager.php">Ratios</a></li>
                      <li><a href="EventLogM.php">Event Log</a></li>
                      
                      
                    </ul>
                </div>
                <!-- Right side Content Vertical Area -->
                <div class="span8">
<!--                <form name="form1" method="post" action="" style="margin-left:175px">
                  <span id="sprytextfield1" title="Please Enter An Valid Account ID" >
                    <label for="Username"><h4 style="color:#FFF;">Search:</h4></label>
                    <input type="text" name="Username" id="Username">
                    <span class="textfieldRequiredMsg">A value is required.</span></span>
              
              <input name="Sumbit" type="submit" value="Sumbit" class="btn btn-small btn-success" style="margin-top:-10px;">
              </form>  -->
                
    <form method='post'>          
    <table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <input type='date' name='date' style="margin-left:190px">
    <input type='submit' value='Search' class="btn btn-small btn-success" style="margin-left:190px"></input>
    <br>
    <thead> <h3 style="margin-left:190px; color:#FFFFFF">Posted Transaction Log</h3>
    <br> 
    </thead>
        
    <tbody>
        <?php
            $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

            

            if (!$con)
            {
                 die('SERVER ERROR');
            }

            if(Input::exists())
            {
                $date = Input::get('date');
                $result = mysqli_query($con, "SELECT * FROM sets WHERE type='2' AND date_added LIKE '{$date}%'");
            }
            else
            {
                $result = mysqli_query($con, "SELECT * FROM sets WHERE type='2'");
            }

            if(!$result)
            {
                die(mysqli_error($con));
            }


            if(mysqli_num_rows($result) == 0)
            {
                echo '<h3 style="margin-left:190px; color:#FFFFFF">Cannot find Posted Transactions for this date.</h3>';
            }
            else
            {
                echo "<th scope='col' class='rounded-company'>Set Description</th>";
            echo "<th scope='col' class='rounded-q1'>User Added</th>";
            echo "<th scope='col' class='rounded-q3'>Date Added</th>";
            echo "<th scope='col' class='rounded-q4'>Modified By</th>";
            echo "<th scope='col' class='rounded-q5'>Date Modified</th>";
            echo "<th scope='col' class='rounded-q6'>Comments</th>";

            while($row = mysqli_fetch_assoc($result))
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
                echo "<th scope='col' class='rounded-q1' colspan='2' align='center'>DR</th>";
                echo "<th scope='col' class='rounded-q1' colspan='2' align='center'>CR</th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "</tr>"; 
                 
                $q = mysqli_query($con, "SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row2 = mysqli_fetch_assoc($q))
                {
                    if($row2['type'] == 'debit' || $row2['type'] == 'Debit')
                    {
                    $account1 = new Account();
                    $account1->findByNumber($row2['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account1->data()->name . "</td>";
                    echo "<td colspan='2' align='center'>" . $row2['amount'] . "</td>";
                    echo "<td colspan='2'></td>";
                    echo "<td><a href='javascript:download(".$row2['trans_id'].")'> ".$row2['file_name']."</a></td>";
                    echo "</tr>";
                    }
                }

                $q2 = mysqli_query($con, "SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row3 = mysqli_fetch_assoc($q2))
                {
                    if($row3['type'] == 'credit' || $row3['type'] == 'Credit')
                    {
                    $account2 = new Account();
                    $account2->findByNumber($row3['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account2->data()->name . "</td>";
                    echo "<td colspan='2'></td>";
                    echo "<td colspan='2' align='center'>" . $row3['amount'] . "</td>";
                    echo "<td><a href='javascript:download(".$row3['trans_id'].")'> ".$row3['file_name']."</a></td>";
                    }
                }
                 
                 echo "</tr>";
                }

            }

            ?>        
    </tbody>
</table>


<table id="rounded-corner">
  <thead> <h3 style="margin-left:190px; color:#FFFFFF"> Rejected Transaction Log</h3>
<!--         <tr>
            <th scope="col" class="rounded-company">Set Description</th>
            <th scope="col" class="rounded-q1">User Added</th>
            <th scope="col" class="rounded-q3">Date Added</th>
            <th scope="col" class="rounded-q4">Modified By</th>
            <th scope="col" class="rounded-q5">Date Modified</th>
            <th scope="col" class="rounded-q6">Comments</th>
            
        </tr> -->
    </thead>
        
    <tbody>
           <?php
            $con = mysqli_connect("localhost","mmollica","Thepw164", "app_domain");

            if (!$con)
            {
                 die('Could not connect: ' . mysql_error());
            }


            
            if(Input::exists())
            {
                $date = Input::get('date');
                $result = mysqli_query($con, "SELECT * FROM sets WHERE type='3' AND date_added LIKE '{$date}%'");
            }
            else
            {
                $result = mysqli_query($con, "SELECT * FROM sets WHERE type='3'");
            }

            if(!$result)
            {
                die(mysqli_error($con));
            }

            if(mysqli_num_rows($result) == 0)
            {
                echo '<h3 style="margin-left:190px; color:#FFFFFF">Cannot find Posted Transactions for this date.</h3>';
            }
            else
            {
                echo "<th scope='col' class='rounded-company'>Set Description</th>";
            echo "<th scope='col' class='rounded-q1'>User Added</th>";
            echo "<th scope='col' class='rounded-q3'>Date Added</th>";
            echo "<th scope='col' class='rounded-q4'>Modified By</th>";
            echo "<th scope='col' class='rounded-q5'>Date Modified</th>";
            echo "<th scope='col' class='rounded-q6'>Comments</th>";

            while($row = mysqli_fetch_assoc($result))
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
                echo "<th scope='col' class='rounded-q1' colspan='2' align='center'>DR</th>";
                echo "<th scope='col' class='rounded-q1' colspan='2' align='center'>CR</th>";
                echo "<th scope='col' class='rounded-q1'></th>";
                echo "</tr>"; 
                 
                $q = mysqli_query($con, "SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row2 = mysqli_fetch_assoc($q))
                {
                    if($row2['type'] == 'debit' || $row2['type'] == 'Debit')
                    {
                    $account1 = new Account();
                    $account1->findByNumber($row2['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account1->data()->name . "</td>";
                    echo "<td colspan='2' align='center'>" . $row2['amount'] . "</td>";
                    echo "<td colspan='2'></td>";
                    echo "<td><a href='javascript:download(".$row2['trans_id'].")'> ".$row2['file_name']."</a></td>";
                    echo "</tr>";
                    }
                }

                $q2 = mysqli_query($con, "SELECT * FROM transactions WHERE set_id='" . $row['id'] . "'");

                while($row3 = mysqli_fetch_assoc($q2))
                {
                    if($row3['type'] == 'credit' || $row3['type'] == 'Credit')
                    {
                    $account2 = new Account();
                    $account2->findByNumber($row3['acct_id']);

                    echo "<tr>";
                    echo "<td>" . $account2->data()->name . "</td>";
                    echo "<td colspan='2'></td>";
                    echo "<td colspan='2' align='center'>" . $row3['amount'] . "</td>";
                    echo "<td><a href='javascript:download(".$row3['trans_id'].")'> ".$row3['file_name']."</a></td>";
                    }
                }
                 
                 echo "</tr>";
                }

            }

                ?>
        
    </tbody>
</table>
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
</script>
</body>
</html>
