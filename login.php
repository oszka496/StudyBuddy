<?php
	require_once 'inc/functions.php';
	
	if (isset($_POST['username']) && isset($_POST['password'])){
		
		$login = s($_POST['username']);
		$pass = s($_POST['password']);
		
		$query = "SELECT `id`, `password`, `salt`, `firstName`, `lastName` FROM `user` WHERE `username` = '$login'";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		if(mysqli_num_rows($result) == 0) { // User not found.
			echo "Nieprawidłowy login lub hasło";
		} else {
			$fetch = mysqli_fetch_row($result);
			$id = $fetch[0];
			$password = $fetch[1];
			$salt = $fetch[2];
			$fname = $fetch[3];
			$lname = $fetch[4];

			$hash = hash('sha256', $pass);
			$hash = hash('sha256', $salt . $hash ); 
			$mysqli->next_result();
			$result->close();
			
			if($hash != $password) { // Incorrect password:
				echo "Nieprawidłowy login lub hasło";
			} else {
				$_SESSION['id'] = $id;
				$_SESSION['firstName'] = $fname;
				$_SESSION['lastName'] = $lname;
				header('Location: index.php');
			}
		}	
	} else { //No username/password
		echo "Należy uzupełnić wszystkie pola";
	}
?>