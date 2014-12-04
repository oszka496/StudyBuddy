<?php
require_once dirname(__FILE__).'\..\inc\password_compat-master\lib\password.php';
require_once dirname(__FILE__).'\..\inc\functions.php';
class User
{
	public static $LOGIN_SUCCESS = 0;
	public static $INVALID_DATA = 1;
	public static $INCORRECT_LOGIN_OR_PASSWORD = 2;

	public static $REGISTER_SUCCESS = 3;
	public static $INSUFFICIENT_PRIVILEGE = 5;

	public static $USERTYPE_ADMIN = 0;
	public static $USERTYPE_TEACHER = 1;
	public static $USERTYPE_STUDENT = 2;

	public static function login($login, $password)
	{	
		global $mysqli;
		if(!filled($login) || !filled($password)){
			return User::$INVALID_DATA;
		}

		$query = "CALL get_user('$login');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) == 0) { // User not found.
			return User::$INCORRECT_LOGIN_OR_PASSWORD;
		} else {
			$fetch = mysqli_fetch_row($result);
			$id = $fetch[0];
			$hash = $fetch[1];
			$fname = $fetch[2];
			$lname = $fetch[3];
			$mysqli->next_result();
			$result->close();
			
			if(password_verify( $password, $hash )) { 
				$_SESSION['id'] = $id;
				$_SESSION['firstName'] = $fname;
				$_SESSION['lastName'] = $lname;
				return User::$LOGIN_SUCCESS;
			}
			else
			{
				return User::$INCORRECT_LOGIN_OR_PASSWORD;
			}
		}
	}

	public static function register($email, $password, $password1, $firstName, $lastName, $utype)
	{
		global $mysqli;
		if(User::validate($email,$password,$password1,$firstName,$lastName,$utype))
		{
			$ph = password_hash($password, PASSWORD_DEFAULT);
			$query = "CALL insert_user('$email', '$ph', '$firstName', '$lastName', '$utype');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			return User::$REGISTER_SUCCESS;
		} else { 			//invalid data
			return User::$INVALID_DATA;
		}
	}

	public static function logout()
	{
		if(isset($_SESSION))
			session_destroy();
		else
			die("<span class='label label-danger'>You're not logged in.</span>");
	}

	public static function getUser()
	{
		if(!(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])))
			return null;
		
		$tab[0] = $_SESSION['id'];
		$tab[1] = $_SESSION['firstName'];
		$tab[2] = $_SESSION['lastName'];
		return $tab;
	}

	private static function validate($email,$pass,$cpass,$fname,$lname, $utype){
			global $mysqli;
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
			
			//Checking email
			$query = "CALL get_user('$email');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_num_rows($result) != 0) { 									//email not unique
				$status = False;
			}
			$result->close();
			$mysqli->next_result();
			// TODO: regex
			
			//Checking type
			if($utype != 0 and $utype != 1  and $utype != 2){
				$status = False;
			}
			
			return $status;
		}
}

?>