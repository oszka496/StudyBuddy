<?php
	require_once 'inc/functions.php';
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
	}
	
	if(filled($_GET['cid'])){
		try {
			$cid = s($_GET['cid']);
			echo Course::enrollToCourse(Course::getAdressById($cid));
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
?>