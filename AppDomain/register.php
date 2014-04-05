<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);

require_once 'core/init.php';

/*if(Input::exists())
{
	echo 'submitted';
}
*/
if(Input::exists())
{
	if(Token::check(Input::get('token')))
	{
		$validate = new Validate();
	
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true, 'min' => 5, 'max' => 20, 'unique' => 'users'),
			'password' => array('required' => true, 'min' => 6, 'max' => 20),
			'password_again' => array('required' => true, 'matches' => 'password'),
			'first' => array('required' => true, 'max' => 25),
			'last' => array('required' => true, 'max' => 25)
		));

		if($validation->passed())
		{
			$user = new User();

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
				Redirect::to('index.php');
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

<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="password">Choose a password (Between 6-12 characters)</label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password">Enter password again.</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<div class="field">
		<label for="first">Enter first name</label>
		<input type="text" name="first" id="first" value="<?php echo escape(Input::get('first')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="last">Enter last name</label>
		<input type="text" name="last" id="last" value="<?php echo escape(Input::get('last')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="last">Enter User Group</label>
		<input type="text" name="groups" id="groups" value="" autocomplete="off">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Register User">
</form>