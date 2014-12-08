<?php
	require_once 'inc/functions.php';
	
	if(!arePostFilled(['email','pass'])){
		echo("Error: All fields are required");
		exit();
	}
		
	$login = s($_POST['email']);
	$pass = s($_POST['pass']);
	
	$out = User::login($login, $pass);
	
	if($out == User::$LOGIN_SUCCESS){
			header("Location: index.php");
		}
		else {
			switch ($out) {
				case User::$INCORRECT_LOGIN_OR_PASSWORD:
					header("Location: index.php?err=Incorrect login or password");
					break;

				case User::$INVALID_DATA:
					header("Location: index.php?err=Empty login or password");
					break;
				
				default:
					# code...
					break;
			}
		}
	
?>