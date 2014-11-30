<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="courseform" action="addCourse.php" method="post" id="courseform">		
		<h1>Add course: </h1>
		<label for="courseName">Name:</label>
		<input type="text" name="courseName" maxlength="100" id = "courseName" />

		<label for="courseAddress">Website URL:</label>
		<input type="url" name="courseAddress" maxlength="150" id = "courseAddress"/>

		<label for="sday">Course start:</label>
		<input type="number" placeholder="DD" name="sday" id="sday" min="1" max="31" value="">
		<input type="number" placeholder="MM" name="smonth" min="1" max="12" value="">
		<input type="number" placeholder="YYYY" name="syear" min="2013" max="2015">

		<label for="eday">Course end:</label>
		<input type="number" placeholder="DD" name="eday" id="eday" min="1" max="31" value="">
		<input type="number" placeholder="MM" name="emonth" min="1" max="12" value="">
		<input type="number" placeholder="YYYY" name="eyear" min="2013" max="2015">

		<input type="hidden" value="1" name="uniId" id="uniId"/>
		<input type="submit" value="Add Course" id="addCourse" class="button"/>
	</form>
</body>
</html>
