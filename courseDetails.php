<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(!isset($_GET['cid'])){
		return;
	}
	$msg = "";

	try {
		$cid = s($_GET['cid']);
		$out = Course::getCourseDetails($cid);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
	if($out == Course::$COURSE_NOT_FOUND){
		echo "Error: Course not found";
		return;
	}
	echo "Course name: $out[1]<br>";
	echo "Lecturer: $out[2]<br>";
	echo "Start date: $out[3]<br>";
	echo "End date: $out[4]<br>";
	echo "Site: $out[5]<br>";
?>
<a href=<?php echo $out[5] ?> title="Add to Calendar" class="addthisevent">
	Add to Calendar
	<span class="arrow">&nbsp;</span>
	<span class="_start"><?php echo $out[3] ?></span>
	<span class="_end"><?php echo $out[4] ?></span>
	<span class="_summary">Summary of the event</span>
	<span class="_description">Description of the event</span>
	<span class="_all_day_event">true</span>
	<span class="_date_format">YYYY-MM-DD</span>
</a>