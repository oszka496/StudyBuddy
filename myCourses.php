<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	$query = "CALL show_my_courses($id);";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0) // No universities yet
		die("<span class='label label-danger'>You have no courses yet.</span>");
	
	echo "<ul id='userCourses' class='list-group'>";
	while ($fetch = mysqli_fetch_row($result)){
		$name = $fetch[0];
		$cid = $fetch[1];
		echo "<li class='list-group-item clearfix'>
				$name
				<small>
				<div class='btn-group pull-right' style='margin: 0;'>
					<a href='problemSets.php?cid=$cid' class='btn btn-xs btn-success listLink'>
						<span class='glyphicon glyphicon-list'></span>
						&nbsp;View Problem Sets
					</a>
					<a href='#' class='btn btn-xs btn-danger'>
						<span class='glyphicon glyphicon-remove'></span>
						&nbsp;Forget it
					</a>
				</div>
				</small>
			  </li>";
	}
	echo "</ul>";
?>