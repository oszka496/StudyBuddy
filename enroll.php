<?php
	require_once 'inc/functions.php';
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['cid'])){
		try {
			Course::enrollToCourse(s($_GET['cid']));
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
?>