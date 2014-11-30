<?php
	require_once 'inc/functions.php';
	if(filled($_POST['uniName']) && filled($_POST['uniAddress'])){
		$name = s($_POST['uniName']);
		$adr = s($_POST['uniAddress']);
		$tags = $name;
		$tags = $tags.s($_POST['tags']);
		createUniversity($name, $adr, $tags);
	}
?>