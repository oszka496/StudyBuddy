<?php
	require_once 'inc/functions.php';
	
	if (arePostFilled(['email','pass'])){
		echo("Error: All fields are required");
		exit();
	}
		
	$login = s($_POST['email']);
	$pass = s($_POST['pass']);
	$msg = "";
	try {
		$msg = User::login($login, $pass);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}

	switch ($msg) {
		case User::$LOGIN_SUCCESS:
			echo "Hidden: login success";
			break;

		case User::$INCORRECT_LOGIN_OR_PASSWORD:
			echo "Error: Incorrect login or password";
			break;

		case User::$INVALID_DATA:
			echo "Error: Not enough data";
			break;
		
		default:
			# code...
			break;
	}
	
?>