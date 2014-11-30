<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}

	if(filled($_GET['cid'])){
		$cid = s($_GET['cid']);
		$query = "CALL check_enroll($id, $cid);";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) != 0){
			$result->close();
			$mysqli->next_result();
			$query = "CALL show_ps($cid);";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			echo "<table id='problemSets'>";
			while($fetch = mysqli_fetch_row($result)){
				$psid = $fetch[0];
				$psdd = $fetch[1];
				$psadr = $fetch[2];
				echo "<tl>";
				echo "<td>".$psadr."</td>";
				echo "<td>".$psdd."</td>";
			}
			echo "</table>";
		}
		include("addProblemSetForm.php");
	}

?>