<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");
	$id = s($_SESSION['id']);
	$query = "CALL show_my_courses($id)";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0)
	{
		echo "<h2 class='center-block'><span class='label label-danger'>You have no courses yet.</span></h2>";
		mysqli_free_result($result);
		mysqli_next_result($mysqli);
		return;
	}
	mysqli_free_result($result);
	mysqli_next_result($mysqli);
	echo "<ul id='userCourses' class='list-group'>";
	while ($fetch = mysqli_fetch_row($result)){
		$name = $fetch[0];
		$cid = $fetch[1];
		$url = $fetch[2];
		echo "<li class='list-group-item clearfix'>
				$name
				<small>
				<div class='btn-group pull-right' style='margin: 0;'>
					<a href='problemSets.php?cid=$cid' class='btn btn-xs btn-success listLink'>
						<span class='glyphicon glyphicon-list'></span>
						&nbsp;View Problem Sets
					</a>
					<a href='$url' class='btn btn-xs btn-info'>
						<span class='glyphicon glyphicon-link'></span>
						&nbsp;Visit website
					</a>
					<a href='resign.php?cid=$cid' class='btn btn-xs btn-danger course-action'>
						<span class='glyphicon glyphicon-remove'></span>
						&nbsp;Forget it
					</a>
				</div>
				</small>
			  </li>";
	}
	echo "</ul>";
?>