<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	$query = "CALL show_uni();";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0) { // No universities yet
			echo "There's are no universities in the database";
	} else {
		echo "<ul id='universities'>";
		while ($fetch = mysqli_fetch_row($result)){
			$id = $fetch[0];
			$name = $fetch[1];
			$address = $fetch[2];
			$tags = $fetch[3];
			echo "<li><a href=''>".$name."</a></li>";
		}
		echo "</ul>";
	}

?>