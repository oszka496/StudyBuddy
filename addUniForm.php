<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="uniform" action="addUni.php" method="post" id="uniform">		
		<h1>Add university: </h1>
		<label for="uniName">Name:</label>
		<input type="text" name="uniName" maxlength="50" id = "uniName" />
		
		<label for="website">Website URL:</label>
		<input type="text" name="uniAddress" id = "uniAddress"/>
		<input type="submit" value="Add University" id="addUni" class="button"/>
	</form>
</body>
</html>