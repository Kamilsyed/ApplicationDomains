
<html>	

<h2>Search</h2> 
 <form  method="post"> <!--name="find"-->
 Search for:<input type="text" id="find" name="find" /> in 
 <Select NAME="field" id ="field">
 <Option VALUE="number">Chart of Account: Number</option>
 <Option VALUE="name">Chart Of Accounts: Name</option>
  <Option VALUE="type">Chart of Accounts: Type</option>
 <Option VALUE="status">Status</option>
 <Option VALUE="balance">Balance</option>
 <Option VALUE="type">Type</option>
 </Select>
<!-- <input type="hidden" name="searching" value="yes" />-->
 <input type="submit" name="search" value="Search" />
 </form>
 
<?php 
 require_once 'core/init.php';
 if (Input:: get('find') == "")        //($_POST['find'] == "") 
 { 
 echo "<p>You forgot to enter a search term"; 
 exit; 
 } 
 // Otherwise we connect to our Database 
 mysql_connect("localhost", "root","test") or die(mysql_error()); 
 mysql_select_db("test") or die(mysql_error()); 
 
 //Now we search for our search term, in the field the user specified 
 $field = Input::get('field'); $find = Input::get('find');
  
 $query_accounts = "SELECT DISTINCT a.number,a.name,a.type,a.status,a.balance,t.type, a.user_added FROM accounts a LEFT JOIN transactions t ON a.number = t.acct_id WHERE $field LIKE '%$find%'";
 $data_accounts = mysql_query($query_accounts);
 
 //while ($result_accounts = mysql_num_fields($data_accounts))
 while($result_accounts = mysql_fetch_assoc($data_accounts)) 
 { 
 echo $result_accounts['number']; 
 echo "<br>"; 
 echo $result_accounts['name']; 
 echo "<br>";
 echo $result_accounts['type']; 
 echo "<br>"; 
 echo $result_accounts['type']; 
 echo "<br>"; 
 echo $result_accounts['status']; 
 echo "<br>"; 
 echo $result_accounts['balance']; 
 echo "<br>"; 
 echo $result_accounts['type']; 
 echo "<br>"; 
 echo $result_accounts['user_added']; 
 echo "<br>"; 
 echo "<br>"; 
 } 
 if (!$result_accounts)
 die(mysql_error());
 
 
 
$anymatches = mysql_num_rows($result_accounts); 
 if ($anymatches == 0)
 { 
 echo "Sorry, but we can not find an entry to match your query<br><br>"; 
 } 
 
 
 ?>
 

 </html>