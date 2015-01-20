<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}

	if(isset($_GET['uid'])){
		$uid = s($_GET['uid']);
		$query = "CALL show_course('$uid')";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) == 0) { // No universities yet
		} else {
			echo "<ul id='courseList' class=\"list-group\">";
			while ($fetch = mysqli_fetch_row($result)){
				$cid = $fetch[0];
				$name = $fetch[1];
				$lid = $fetch[2];
				$cstart = $fetch[3];
				$cend = $fetch[4];
				$address = $fetch[5];
				?>
					<li class="list-group-item clearfix">
						<?php echo $name . " (". substr($address, 0, 50) .")"; ?>
						<small>
						<div class='btn-group pull-right' style='margin: 0;'>
							<a href="enroll.php?cid=<?php echo $cid; ?>" class='btn btn-xs btn-success list-action'>
								<span class='glyphicon glyphicon-star-empty'></span>
								&nbsp;Enroll
							</a>
							<a href="deleteCourse.php?cid=<?php echo $cid; ?>" class='btn btn-xs btn-danger list-action'>
								<span class='glyphicon glyphicon-remove'></span>
								&nbsp;Delete
							</a>
						</div>
						</small>
					</li>
				<?php
			}
			echo "</ul>";
		}
		mysqli_free_result($result);
		mysqli_next_result($mysqli);
		include('addCourseForm.php');
	}
?>