<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");
?>
<form id="searchUni">
    <div class="input-group">
      <input type="text" class="form-control" size="30" value="" id="suggestUni" placeholder="Search for university">
      <span class="input-group-btn">
        <button class="btn btn-info" type="button">Go!</button>
      </span>
    </div><!-- /input-group -->
</form>
<?php
	$query = "CALL show_uni()";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0) { // No universities yet
			echo "<div class='alert alert-danger margin'><span class=\"h4\">There are no universities in the database</span></div>";
	} else {
		echo "<ul id='universityList' class='list-group'>";
		while ($fetch = mysqli_fetch_row($result)){
			$uid = $fetch[0];
			$name = $fetch[1];
			$address = $fetch[2];
			$tags = $fetch[3];
			$courses = "courses.php?uid=".$uid;
			if(s($_SESSION['uType']) == 0){
				echo "<li class='list-group-item clearfix'>
				<a href=".$courses." class='listLink'>".$name."</a>
				<small>
				<div class='btn-group pull-right' style='margin: 0;'>
					<a href='deleteUni.php?uid=$uid' class='btn btn-xs btn-danger list-action'>
						<span class='glyphicon glyphicon-remove'></span>
						&nbsp;Delete
					</a>
				</div>
				</small>
			  </li>";
			}
			else
				echo "<li class='list-group-item'><a href=".$courses." class='listLink'>".$name."</a></li>";
		}
		echo "</ul>";
	}
	if(s($_SESSION['uType']) == 0) include('addUniForm.php');
	mysqli_free_result($result);
	mysqli_next_result($mysqli);
?>
<script type="text/javascript" src="inc/getUni.php"></script>
