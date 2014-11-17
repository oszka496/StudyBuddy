<?php
	require_once 'inc/functions.php';
	
	if (isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname'])  && isset($_POST['utype'])){
		$fname = s($_POST['fname']);
		$lname = s($_POST['lname']);
		$pass = s($_POST['pass1']);
		$cpass = s($_POST['pass2']);
		$email = s($_POST['email']);
		$utype = s($_POST['utype']);
		
		if(validate($email,$pass,$cpass,$fname,$lname,$utype)){
			$salt = createSalt();
			$hash = hash('sha256', $pass);
			$password = hash('sha256', $salt . $hash);
			$query = "INSERT INTO `user` ( `email`, `password`, `salt`, `fname`, `lname`, `status`) VALUES ('$email', '$password', '$salt', '$fname', '$lname', '$utype')";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			header('Location: index.php');
		} else { 			//invalid data
			echo "Not enough data";
		}
	} else {				//insufficient data
		echo "All fields are required";
	}
?>