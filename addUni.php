<?php
	require_once 'inc/functions.php';
	if(isset($_POST['uniName']) && isset($_POST['uniAddress'])){
		$name = s($_POST['uniName']);
		$adr = s($_POST['uniAddress']);
		$query = "CALL check_uni('$adr');";
		$tags = $name;
		if(isset($_POST['tags'])){
			$tags = $tags.s($_POST['tags'])); 
		}
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) == 0){
			$result->close();
			$mysqli->next_result();
			$query = "CALL insert_uni('$name','$adr', '$tags');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
	}
?>