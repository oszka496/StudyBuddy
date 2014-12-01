<?php
class User
{
	public static function login($login, $password)
	{
		return null;
	}

	public static function register()
	{

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
		if (!(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])))
			return null;
		
		$tab[0] = $_SESSION['id'];
		$tab[1] = $_SESSION['firstName'];
		$tab[2] = $_SESSION['lastName'];
		return $tab;
	}
}

?>