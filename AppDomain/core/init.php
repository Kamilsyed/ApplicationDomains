<?php

//Initialization file for website functions

session_start();

//CONFIG VARIABLES FOR INIT LOAD
$GLOBALS['config'] = array(
	'mysql' => array( 'host' => 'localhost', 'username' => 'mmollica', 'password' => 'Thepw164', 'db' => 'app_domain'),
	'remember' => array( 'cookie_name' => 'hash', 'cookie_expiry' => 604800),
	'session' => array( 'session_name' => 'user', 'token_name' => 'token')
	);

//LOAD REQUIRED CLASSES
spl_autoload_register(function($class) {require_once 'classes/' . $class . '.php';});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
{
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if($hashCheck->count())
	{
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}