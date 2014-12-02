<?php
	require_once 'inc/functions.php';
	
	if (filled($_POST['email']) && filled($_POST['pass'])){
		$login = s($_POST['email']);
		$pass = s($_POST['pass']);
		
		$out = User::login($login, $pass);
	} else { //No username/password
		echo "All fields are required";
	}
?>