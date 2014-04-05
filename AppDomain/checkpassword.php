<?php
/* 
filename: checkpassword.php
author:  Tariq AbuLaila 03/28/2014


The purpose of this file is to to read and filter 
bad input from users in the CreateUsers.php form. 
This includes checking the fields 'Username', 'Password', 
'Confirm Password', 'Account Type', 'First Name', and 'Last Name'.

The TESTING section at the beginning of this document is
simply for testing combinations of Usernames, Passwords, etc.
It can be commented out when finished testing. 

Following the TESTING section, there are functions that
determine the authenticity and complexity of input based on 
each field. 
*/


//************FOR TESTING***************
//See CreateUsers.php line 18-22.
//check switch statement in classes/Validate.php .
function testAllStuff() {
	if (!empty($_POST)) {
		$postData = $_POST;
		print_r($postData);
		//just demonstrates that the include works
		echo "</br></br>Working with file </br> checkpassword.php</br></br></br>";
		echo "</br>****************TO REMOVE THIS TESTING DATA, DELETE";
		echo " OR COMMENT-OUT LINES 18 - 22 IN CreateUsers.php***************</br></br>";
		//button to Redirect user to CreateUsers.php (basically an html button inside PHP).
		Print "<form action=\"CreateUsers.php\" method=\"get\">";
		Print "<input type=\"submit\" value=\"Create Users Page\" name=\"Submit\" id=\"back_submit\" />";
		Print "</form>";


	//TEST Username
		if (checkUsernameStrength($postData['username']) == true) {
			echo "</br><u>Valid Username:</u>";
			echo " {$postData['username']}";
		}
		else {
			echo "</br><strong>Invalid Username: </strong> ( {$postData['username']} ) --";
			echo "</br> -- Username <u>must contain</u> a minimum of 6 characters, a maximum of 25 characters,";
			echo "</br><u>and must contain</u> at least one lower case letter, capital letter, and one digit.";
		}

	//TEST Password
		if (checkPasswordStrength($postData['password']) == true) {
			echo "</br></br><u>Valid Password:</u>";
			echo " {$postData['password']}";
		}
		else {
			echo "</br></br><strong>Invalid Password: </strong> ( {$postData['password']} ) --";
			echo "</br> -- Password <u>must contain</u> a minimum of 6 characters, a maximum of 25 characters,";
			echo "</br><u>and must contain</u> at least one lower case letter, capital letter, and one digit.";
			echo "</br> Password cannot be the same as Username.";
		}

	//TEST Confirm Password
		if (confirmPassword($postData['password_again']) === true){
		echo "</br><u>Confirmed: Password Match</u>";
		}
		else {
		echo "</br>Password Mismatch!";
		}

	//TEST First Name and Last Name
		if (!empty($postData['first']) && !empty($postData['last'])) {
			if (checkName($postData['first']) && checkName($postData['last'])) {
				echo "</br></br><u>Valid Name:</u>";
				echo " {$postData['first']} {$postData['last']}</br></br></br>";
			}
			else {
				echo "</br></br><strong>Invalid Name: </strong> ( {$postData['first']} {$postData['last']} ) --";
				echo "</br>First and Last name must only consist of 1 to 25 letters (a - z and A - Z).</br>";
			}
		}
		else {
			echo "</br></br>A First and Last Name is required.</br>";
		}
	}
}
//Erase when done.
//***********FOR TESTING***************





//***********************MAIN FUNCTIONS**********************************

//regular expressions to significantly shorten code
function checkPasswordStrength($val) {
//$val string to be evaluated
	if (preg_match_all('$\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $val)) {
		//if string contains at least 6 characters, 1 uppercase, and 1 lower case:
		if (!preg_match('$(?=\S*[\W])$',  $val)) {
			//..and if string DOES NOT contain any special characters (underscores accepted),
			if (strlen($val) <= 25) {
				//....and if the string is 25 characters or less,
				if ($val != $_POST['username']) {
					return true;
				}
			}
		}
		else {
			//else if string does not match the above criteria, 
			return false;
		}
	}
}

function checkUsernameStrength($user) {
	if (preg_match_all('$\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $user)) {
		//if string contains at least 6 characters, 1 uppercase, and 1 lower case:
		if (!preg_match('$(?=\S*[\W])$',  $user)) {
			//..and if string DOES NOT contain any special characters (underscores accepted),
			if (strlen($user) <= 25) {
				//....and if the string is 25 characters or less,
				return true;
			}
		}
		else {
			//else if string does not match the above criteria, 
			return false;
		}
	}
}

function confirmPassword($pass) {
	if (!empty($pass)) {
		if ($pass === $_POST['password']) {
			return true;
		}
		else {
			return false;
		}
	}	
}


function checkName($str) {
	if (!empty($str)) {
		if (preg_match('/^[a-z]+$/i', $str)) {
			if (strlen($str) >= 1 && strlen($str) <= 25) {
				return true;
			}
		}
		else {
		return false;
		}
	}
}	
//*************************************************************************




/*
//Tariq AbuLaila - created 03/28/2014 - last updated 03/31/2014

Requirements for each Input field:

Any data entered into the CreateUsers.php
form must meet ALL requirements before the
entire form is considered valid.
Valid - means the data can be stored to the database. 

Data Fields - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
form1->label ::

'Username' +
'Password'
***************
- must be UNIQUE (password cannot match username);
-- only valid if the username and password match NO other database record. 
- letters, integers, and underscores only;
-- total (64) unique, valid characters: 
---- 'a' through 'z'  (26)
---- 'A' through 'Z' (26)
---- '0' through '9' (10)
---- '_' (1)

- minimum of 6 characters
- maximum of 25 characters
- minimum of one UPPERcase letter
- minumum of one lowercase letter
- maximum of 3 consecutive characters (not yet complete)
- Cannot contain special non-word characters (underscores allowed)
- ('Password' only) maximum of 6 months lifetime


Confirm Password
****************
- must EXACTY match 'Password' value.

Account Type
****************
- letters only;
-- 'a' through 'z'
-- 'A' through 'Z'
- minimum of 5 total characters
- maximum of 10 total characters
- limited 6 valid input combinations:
-- 'Admin' or 'admin'
-- 'Manager' or 'manager'
-- 'Accountant' or 'accountant'
----------------------------------------------------------
-- * 'IAuditor' , 'Iauditor' , 'iAuditor' , or 'iauditor' (not yet complete)
-- ** 'XAuditor' , 'Xauditor' , 'xAuditor' , or 'xauditor' (not yet complete)
---- * for Internal Auditor users
---- ** for External Auditor users

'First Name' +
'Last Name'
****************
- must contain only letters;
-- total (56) unique, valid characters: 
---- 'a' through 'z'  (26)
---- 'A' through 'Z' (26)
- minimum of 1 total character(s)
- maximum of 25 total characters
- maximum of 3 consecutive characters (not yet complete)


****************
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
*/

?>



