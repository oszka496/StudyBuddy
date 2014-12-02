<?php
	require_once 'inc/functions.php';
	
	if (arePostFilled(['email','pass'])){
		$login = s($_POST['email']);
		$pass = s($_POST['pass']);
		
		$out = User::login($login, $pass);
		if($out = User::$LOGIN_SUCCESS){
			header("Location: index.php");
		}
	} else { //No username/password
		echo "All fields are required";
	}
?>