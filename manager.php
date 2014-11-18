<?php
	include 'inc/functions.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
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
				echo $name." ".$surname;
			}
		?>
		<ul id="links">
		</ul>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var list = $("#links");
		window.addEventListener("message", receiveMessage, false);

		function receiveMessage(event)
		{
			for (var i=0; i<event.data.length; i+=1) {
				var link = $("<li />", {
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
