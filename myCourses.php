<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");
	$id = s($_SESSION['id']);

	if($_SESSION['uType'] == 1)
		include_once "lecturerCourses.php";

	?>
	<h4>Courses you're enrolled on</h4>
	<?php
	$query = "CALL show_my_courses($id)";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	
	if(mysqli_num_rows($result) == 0)
	{
		echo "<div class='alert alert-danger margin'><span class=\"h4\">You aren't enrolled on any course.</span></div>";
		mysqli_free_result($result);
		mysqli_next_result($mysqli);
		return;
	}
	echo "<ul id='userCourses' class='list-group accordion'>";
	while ($fetch = mysqli_fetch_row($result)){
		$name = $fetch[0];
		$cid = $fetch[1];
		$url = $fetch[2];
		echo "<li class='list-group-item clearfix'>
				<a href='problemSets.php?cid=$cid' class='listLink'>".$name."</a>
				<small>
				<div class='btn-group pull-right' style='margin: 0;'>
					<a href='$url' class='btn btn-xs btn-info'>
						<span class='glyphicon glyphicon-link'></span>
						&nbsp;Visit
					</a>
					<a href='resign.php?cid=$cid' class='btn btn-xs btn-danger list-action'>
						<span class='glyphicon glyphicon-remove'></span>
						&nbsp;Withdraw
					</a>
				</div>
				</small>
			  </li>
			  <div></div>";
	}
	echo "</ul>";
	mysqli_free_result($result);
	mysqli_next_result($mysqli);
?>