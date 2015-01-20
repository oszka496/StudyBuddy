<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");
?>
<h4>Your courses</h4>
<?php
	$lid = s($_SESSION['id']);

	$msg = "";
	
	//$lid = s($_GET['lid']);
	$query = "CALL get_course_by_lecturer($lid)";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0)
		return;
	echo "<ul id='userCourses' class='list-group'>";
	while ($fetch = mysqli_fetch_row($result)){
		$name = $fetch[1];
		$cid = $fetch[0];
		$url = $fetch[2];
		echo "<li class='list-group-item clearfix'>
				$name
				<small>
				<div class='btn-group pull-right' style='margin: 0;'>
					<a href='problemSets.php?cid=$cid' class='btn btn-xs btn-success listLink'>
						<span class='glyphicon glyphicon-list'></span>
						&nbsp;Problem Sets
					</a>
					<a href='$url' class='btn btn-xs btn-info'>
						<span class='glyphicon glyphicon-link'></span>
						&nbsp;Visit
					</a>
				</div>
				</small>
			  </li>";
	}
	echo "</ul>";
	mysqli_free_result($result);
	mysqli_next_result($mysqli);
	
?>