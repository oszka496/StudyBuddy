<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	if(filled($_GET['cid'])){
		$cid = s($_GET['cid']);
		deleteCourse($cid);
	}
?>