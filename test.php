<?php
	include 'inc/functions.php';
	$query = "INSERT INTO `courses` (`name`, `lecturerId`, `courseAddress`, `uniId`) VALUES ('Obliczenia naukowe', '69', 'http://obliczenia', '1')";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	$result->close();
	$mysqli->next_result();
?>