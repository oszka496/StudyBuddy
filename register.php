<?php
	require_once 'functions.php';
	
	if (isset($_POST['user']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname'])){
		$login = s($_POST['user']);
		$fname = s($_POST['fname']);
		$lname = s($_POST['lname']);
		$pass = s($_POST['pass1']);
		$cpass = s($_POST['pass2']);
		$email = s($_POST['email']);
		
		if(validate($login,$pass,$cpass,$email,$fname,$lname)){
			$salt = createSalt();
			$hash = hash('sha256', $pass);
			$password = hash('sha256', $salt . $hash);
			$query = "INSERT INTO user ( username, password, salt, firstName, lastName) VALUES ('$login', '$password', '$salt', '$fname', 'lname')";
		} else { 			//invalid data
		
		}
	} else {				//insufficient data
	
	}
?>