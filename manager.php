<?php
	include 'inc/functions.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="inc/jquery-ui.js"></script>
	<script type="text/javascript" src="inc/getCourses.php"></script>
	<script src="inc/bootstrap.min.js"></script>
</head>
<body>
	<div id='study-buddy-manager'>
		<h1>StudyBuddy</h1>
		<?php
			$user = User::getUser();
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
				echo $name." ".$surname;
			}
		?>
		<form>
		<h4>Adding problem set...</h4>
		<div class="input-group input-group-sm">
			<input type="text" class="form-control" placeholder="Name of Problem set">
		</div>

		<div class="input-group input-group-sm">
			<input type="text" class="form-control" placeholder="Name of course" id="suggestCourse">
		</div>

		<div class="input-group input-group-sm">
			<select id="links" class="form-control" />
		</div>
		<button type="submit" class="btn btn-primary">Add problem set</button>
		</form>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var list = $("#links");
		window.addEventListener("message", receiveMessage, false);

		function receiveMessage(event)
		{
			for (var i=0; i<event.data.length; i+=1) {
				var link = $("<option />", {
					class: 'link'
				});
				link.text(event.data[i]);
				link.appendTo(list);
			}
		}
	});
	</script>
</body>
</html>
