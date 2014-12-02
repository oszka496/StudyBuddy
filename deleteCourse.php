<?php
	require_once 'inc/functions.php';
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
	$id = s($_SESSION['id']);	

	if(filled($_GET['cid'])){
		$cid = s($_GET['cid']);
		
		try {
			Course::deleteCourse($cid);
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
?>