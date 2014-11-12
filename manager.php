<?php
	include 'inc/functions.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id='study-buddy-manager'>
		<h1>StudyBuddy</h1>
		<?php
			$user = getUser();
			$id = $name = $surname = "";
			if ($user == "None")
			{
				echo "<p>You're not logged in.</p>";
				echo "<a href='index.php'>Log in</a>";
			}
			else
			{
				$id = $user[0];
				$name = $user[1];
				$surname = $user[2];
			}
		?>
	</div>
</body>
</html>
