<?php
require_once 'inc/functions.php';
if(!isSessionSet())
	throw new Exception("Session wasn't set.");

if(!arePostFilled(['oldPass','pass0','pass1'])){
	echo("Error: All fields are required");
	exit();
}
$password = s($_POST['oldPass']);
$newPass = s($_POST['pass0']);
$conf = s($_POST['pass1']);
$user = User::getUserById($_SESSION['id']);
if($user == User::$USER_NOT_FOUND){
	echo "User not found";
	return;
}

if( !password_verify( $password, $user[2] )){
	header("Location: index.php?err=Incorrect password");
	return;
}

if($newPass != $conf || strlen($newPass) < 8 || strlen($newPass) > 32){
	header("Location: index.php?err=Invalid data");
	return;
}

$result = User::changePassword($newPass);
if($result == User::$CHANGE_PASSWORD_SUCCESS){
	header("Location: index.php?inf=Password changed");
}
?>