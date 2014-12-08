<?php
	require_once 'inc/functions.php';
	
	if (arePostFilled(['pass1','pass2','email','fname','lname','utype'])){
		$fname = s($_POST['fname']);
		$lname = s($_POST['lname']);
		$pass = s($_POST['pass1']);
		$cpass = s($_POST['pass2']);
		$email = s($_POST['email']);
		$utype = s($_POST['utype']);
		if($utype != 1 && $utype != 2) die();
		$out = User::register($email, $pass, $cpass, $fname, $lname, $utype);
		switch ($out) {
			case User::$INVALID_DATA:
				header("Location: index.php?msg=Invalid data");
				break;
			case User::$REGISTER_SUCCESS:
				header("Location: index.php?msg=Register success");
				break;
			default:
				# code
				break;
		}

	} else {				//insufficient data
		echo "All fields are required";
	}
?>