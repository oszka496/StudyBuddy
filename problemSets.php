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
			echo "<ul id='problemSets' class='list-group' style='margin-top: 10px;'>";
			while($fetch = mysqli_fetch_row($result)){
				$psid = $fetch[0];
				$psname = $fetch[1];
				$psdd = $fetch[2];
				$psadr = $fetch[3];
				echo "<li class='list-group-item'>";
				echo "$psname $psdd";
				echo "<small>
						<div class='btn-group pull-right' style='margin: 0;'>
							<a href=\"$psadr\" class='btn btn-xs btn-info'>
								View&nbsp;<span class='glyphicon glyphicon-chevron-right'></span>
					  		</a>
					  	</div>
					  </small>";
				echo "</li>";
			}
			echo "</ul>";
		}
		include("addProblemSetForm.php");
	}

?>