<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}

	if(isset($_GET['uid'])){
		$uid = s($_GET['uid']);
		$query = "CALL show_course('$uid', '$id')";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) == 0) { // No universities yet
		} else {
			echo "<ul id='courseList' class=\"list-group\">";
			while ($fetch = mysqli_fetch_row($result)){
				$cid = $fetch[0];
				$name = $fetch[1];
				$address = $fetch[2];
				$lid = $fetch[3];
				$isEnrolled = $fetch[4];
				$courseInfo = "courseDetails.php?cid=".$cid;
				?>
					<li class="list-group-item clearfix">
						<a href="<?php echo $courseInfo ?>" class='listLink'><?php echo $name ?></a>
						<small>
						<div class='btn-group pull-right' style='margin: 0;'>
							<?php if ($isEnrolled == 'N'): ?>
							<a href="enroll.php?cid=<?php echo $cid; ?>" class='btn btn-xs btn-success list-action'>
								<span class='glyphicon glyphicon-star-empty'></span>
								&nbsp;Enroll 
							</a>
							<?php else: ?>
							<a href='resign.php?cid=<?php echo $cid; ?>' class='btn btn-xs btn-warning list-action'>
								<span class='glyphicon glyphicon-remove'></span>
								&nbsp;Withdraw
							</a>
							<?php
							endif;
							if($_SESSION['uType'] == 1 && $id != $lid)
								echo "<a href='confirmCourse.php?cid=$cid' class='btn btn-xs btn-success list-action'>
								<span class='glyphicon glyphicon-star-empty'></span>
								&nbsp;Adopt
								</a>"
							?>
							<a href='<?php echo $address; ?>' class='btn btn-xs btn-info'>
								<span class='glyphicon glyphicon-link'></span>
								&nbsp;Visit
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