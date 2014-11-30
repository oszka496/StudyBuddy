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
				$psname = $fetch[1];
				$psdd = $fetch[2];
				$psadr = $fetch[3];
				echo "<tr>";
				echo "<td>".$psname."</td>";
				echo "<td>".$psadr."</td>";
				echo "<td>".$psdd."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		include("addProblemSetForm.php");
	}

?>