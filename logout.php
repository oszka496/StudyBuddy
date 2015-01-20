<?php
require_once 'inc/functions.php';
$result = User::logout();
if ($result == User::$LOGOUT_SUCCESS) {
	echo "<span class='label label-success'>You've been logged out.</span>";
}
else {
	die("<span class='label label-danger'>You're not logged in.</span>");
}
header('Location: index.php');
?>