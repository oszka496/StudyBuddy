<?php
	require_once 'inc/functions.php';
	require_once 'inc\password_compat-master\lib\password.php';
	
	if (isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname'])  && isset($_POST['utype'])){
		$fname = s($_POST['fname']);
		$lname = s($_POST['lname']);
		$pass = s($_POST['pass1']);
		$cpass = s($_POST['pass2']);
		$email = s($_POST['email']);
		$utype = s($_POST['utype']);
		
		register($email, $pass, $cpass, $fname, $lname, $utype)
	} else {				//insufficient data
		echo "All fields are required";
	}
?>