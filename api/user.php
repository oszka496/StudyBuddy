<?php
require_once dirname(__FILE__).'\..\inc\password_compat-master\lib\password.php';
require_once dirname(__FILE__).'\..\inc\functions.php';
class User
{
	public static $LOGIN_SUCCESS = 0;
	public static $INVALID_DATA = 1;
	public static $INSUFFICIENT_PRIVILEGE = 2;

	public static $INCORRECT_LOGIN_OR_PASSWORD = 3;
	public static $USER_NOT_FOUND = 4;
	public static $REGISTER_SUCCESS = 5;
	public static $DELETE_SUCCESS = 6;
	
	public static $USERTYPE_ADMIN = 0;
	public static $USERTYPE_TEACHER = 1;
	public static $USERTYPE_STUDENT = 2;

	public static function login($login, $password)
	{	
		global $mysqli;
		if(!filled($login) || !filled($password)){
			return User::$INVALID_DATA;
		}
		$data = User::getUserIdByMail($login);
		if($data == $USER_NOT_FOUND) return User::$INCORRECT_LOGIN_OR_PASSWORD;		
		$id = $data[0];
		$hash = $data[1];
		$fname = $data[2];
		$lname = $data[3];
		$utype = $data[4];
		if(password_verify( $password, $hash )) { 
			$_SESSION['id'] = $id;
			$_SESSION['firstName'] = $fname;
			$_SESSION['lastName'] = $lname;
			$_SESSION['uType'] = $utype;
			return User::$LOGIN_SUCCESS;
		} else {
			return User::$INCORRECT_LOGIN_OR_PASSWORD;
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
		if(!isset($_SESSION['id']))
			return null;
		
		$tab[0] = $_SESSION['id'];
		$tab[1] = $_SESSION['firstName'];
		$tab[2] = $_SESSION['lastName'];
		$tab[3] = $_SESSION['uType'];
		return $tab;
	}

	private static function validate($email,$pass,$cpass,$fname,$lname, $utype)
	{
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

	private static function getUserIdByMail($login){
		global $mysqli;
		$query = "CALL get_user('$login');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_num_rows($result) == 0) return User::$USER_NOT_FOUND;
		$fetch = mysqli_fetch_row($result);
		$id = $fetch[0];
		$hash = $fetch[1];
		$fname = $fetch[2];
		$lname = $fetch[3];
		$utype = $fetch[4];
		$mysqli->next_result();
		$result->close();
		$tab = [$id, $hash, $fname, $lname, $utype];
		return $tab;
	}

	private static function deleteUser($mail){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		if((s($SESSION_['uType']) != 0) && $id != getUserIdByMail($mail)[0]) return $INSUFFICIENT_PRIVILEGE;
		$query = "CALL delete_user('$mail');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return $DELETE_SUCCESS;
	}
}

?>