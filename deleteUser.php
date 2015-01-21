<?php
require_once 'inc/functions.php';
if(!isSessionSet())
	throw new Exception("Session wasn't set.");
$id = s($_SESSION['id']);
$msg = User::deleteUserById($id);
switch ($msg){
	case User::$INSUFFICIENT_PRIVILEGE: 
		echo "Error: You don't have enough privileges";
		break;
	case User::$DELETE_SUCCESS:
		echo "Success: User deleted";
		break;
	}
?>