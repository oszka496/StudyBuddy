<?php
	require_once 'inc/functions.php';
	require_once 'inc\password_compat-master\lib\password.php';
	
	if (isset($_POST['email']) && isset($_POST['pass'])){
		
		$login = s($_POST['email']);
		$pass = s($_POST['pass']);
		$query = "CALL get_user('$login');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		if(mysqli_num_rows($result) == 0) { // User not found.
			echo "Incorrect login or password";
		} else {
			$fetch = mysqli_fetch_row($result);
			$id = $fetch[0];
			$hash = $fetch[1];
			$fname = $fetch[2];
			$lname = $fetch[3];
			$mysqli->next_result();
			$result->close();
			
			if(password_verify( $pass, $hash )) { 
				$_SESSION['id'] = $id;
				$_SESSION['firstName'] = $fname;
				$_SESSION['lastName'] = $lname;
				header('Location: index.php');
			} else {			 // Incorrect password:
				echo "Incorrect login or password";
			}
		}	
	} else { //No username/password
		echo "All fields are required";
	}
?>