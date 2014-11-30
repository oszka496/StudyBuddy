<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	
	if(filled($_POST['courseName']) && filled($_POST['courseAddress']) && filled($_POST['uniId'])){
		$name = s($_POST['courseName']);
		$adr = s($_POST['courseAddress']);
		$uni = s($_POST['uniId']);
		
		$starts = '0000-00-00';
		$ends = '0000-00-00';
		if(isset($_POST['courseStart']) && isset($_POST['courseEnd'])){
			$starts = s($_POST['courseStart']);
			$ends = s($_POST['courseEnd']);
		}
		createCourse($name,$starts,$ends,$adr,$uni);
	}
?>