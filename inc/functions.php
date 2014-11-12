<?php
	header('Content-type: text/html; charset=utf-8');
	global $mysqli;
	$mysqli = mysqli_connect('db4free.net', 'adminer', 'axis!69', 'studybuddy') or die(mysqli_error($mysqli));
	if(!isset($_SESSION['id'])) {
	 	session_start();
	}
	
	function s($in) {
		$out = trim($in);
		$out = stripslashes($out);
		$out = htmlspecialchars($out);
		$out = strip_tags($out);
		$out = mysqli_real_escape_string($mysqli, $out);
		return $out;
	}
	
	function getUser(){
		if(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])){
			$tab[0] = $_SESSION['id'];
			$tab[1] = $_SESSION['firstName'];
			$tab[2] = $_SESSION['lastName'];
			return $tab;
		} else {
			return "None";
		}
	}
	
	function validate($login,$pass,$cpass,$email,$fname,$lname){
			//Checking password
			$status = True;
			if ($pass != $cpass){													//password different than confirmation
				$status = False;
			} else if (strlen($pass) < 8) {											//password too short
				$status = False;
			} else if (strlen($pass) > 32) {										//password too long
				$status = False;
			}
			
			//Checking name
			if (strlen($fname) == 0 or strlen($lname) == 0){						//empty first or last name
				$status = False;
			}
			
			//Checking login
			$query = "SELECT username FROM user WHERE username = '$login'";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_num_rows($result) != 0) { 									//username not unique
				$status = False;
			}
			$result->close();
			
			//Checking email
			$query = "SELECT email FROM user WHERE email = '$email'";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_num_rows($result) != 0) { 									//email not unique
				$status = False;
			}
			// TODO: regex
			return $status;
		}
?>