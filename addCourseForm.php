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
		
		<label for="website">Website URL:</label>
		<input type="text" name="courseAddress" maxlength="150" id = "courseAddress"/>
		<input type="submit" value="Add Course" id="addCourse" class="button"/>
	</form>
</body>
</html>