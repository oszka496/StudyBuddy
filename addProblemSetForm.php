<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="psform" action="addProblemSet.php" method="post" id="psform">		
		<h4>Add Problem Set: </h4>

		<label for="psName">Name:</label>
		<input type="text" name="psName" maxlength="100" id = "psName"/>

		<label for="psAddress">Problem Set URL:</label>
		<input type="url" name="psAddress" maxlength="150" id = "psAddress"/>

		<label for="sday">Problem Set deadline:</label>
		<input type="number" placeholder="DD" name="dday" id="dday" min="1" max="31" value="">
		<input type="number" placeholder="MM" name="dmonth" min="1" max="12" value="">
		<input type="number" placeholder="YYYY" name="dyear" min="2013" max="2015">

		<input type="hidden" value="<?php echo $cid ?>" name="courseId" id="courseId"/>
		<input type="submit" value="Add Problem Set" id="addPs" class="button"/>
	</form>
</body>
</html>