<?php
require_once 'core/init.php';
ini_set('display_errors',1); 
error_reporting(E_ALL);


if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
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
                Redirect::to('index.php');
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
}

?>

<head>
        <link type="text/css" rel="stylesheet" href="Style for login.css"/>
        <title>Login page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
</head>
<body>
       <div>Login page for App domain</div>

        <form action="" method="post">
        Username: <input type="text" name="username" id="username" autocomplete="off"><br>
        Password: <input type="password" name="password" id="password"><br>
        Remember Me: <input type="checkbox" name="remember" id="remember"><br>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Log In">
        
        </form>
</body>