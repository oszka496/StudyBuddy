<?php
	require_once 'functions.php';
	
	if (isset($_POST['username']) && isset($_POST['password'])){
		
		$login = s($_POST['username']);
		$pass = s($_POST['password']);
		
		$query = "SELECT id, password, salt FROM user WHERE username = '$login'";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		
		
	}
?>