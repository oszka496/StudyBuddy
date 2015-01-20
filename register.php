<?php
	require_once 'inc/functions.php';
	
	if (!arePostFilled(['pass1','pass2','email','fname','lname','utype'])){
		echo("Error: All fields are required");
		exit();
	}

	$fname = s($_POST['fname']);
	$lname = s($_POST['lname']);
	$pass = s($_POST['pass1']);
	$cpass = s($_POST['pass2']);
	$email = s($_POST['email']);
	$utype = s($_POST['utype']);

	if($utype != 1 && $utype != 2){
		echo("Error: Incorrect user type");
		exit();
	}
	$msg = "";
	try {
		$msg = User::register($email, $pass, $cpass, $fname, $lname, $utype);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}

	switch ($msg) {
		case User::$INVALID_DATA:
			echo("Error: Invalid data");
			break;
		case User::$REGISTER_SUCCESS:
			header("Success: Registration complete");
			break;
		default:
			# code
			break;
	}
?>