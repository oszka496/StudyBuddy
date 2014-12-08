<?php
	include 'inc/functions.php';
	if (isset($_GET['id'])) {
		$id = s($_GET['id']);
		$id = intval($id);
		if (is_int($id)){
			$_SESSION['id'] = $id;
		}
	}
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
	<script type="text/javascript" src="inc/jquery.form.js"></script>
	<script type="text/javascript" src="inc/getCourses.php?id=<?php echo $id; ?>"></script>
	<script src="inc/bootstrap.min.js"></script>
</head>
<body>
	<div id='study-buddy-manager'>
		<span>
		<h1>StudyBuddy</h1>
		<?php
			$user = User::getUserById($id);
			if ($user == null)
			{
				echo "<p>You're not logged in.</p>";
				echo "<a href='index.php'>Log in</a>";
			}
			else
			{
				$name = $user[0];
				$surname = $user[1];
				echo "<p style='text-align: center;'>Working as: ".$name." ".$surname."</p>";
			}
		?>
		</span>
		<form id="mgrform" method="post" action="addProblemSet.php">
		<h4>Add assignment to course</h4>
		<div class="alert alert-warning" style="display: none;" id="mgrresult"></div>
		<div class="input-group input-group-sm">
			<input type="text" class="form-control" placeholder="Name of Problem set" name="psName">
		</div>

		<div class="input-group input-group-sm">
			<input type="text" class="form-control" placeholder="Name of course" id="suggestCourse" name="courseId">
		</div>

		<div class="input-group input-group-sm">
			<select id="links" class="form-control" name="psAddress"/>
		</div>
		<input type="submit" class="btn btn-success" value="Add problem set">
		</form>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var list = $("#links");
		window.addEventListener("message", receiveMessage, false);

		$("#mgrform").ajaxForm(function(data) {
			$("#mgrresult").text(data).show(5000);//.hide(4000);
		});

		function receiveMessage(event)
		{
			for (var i=0; i<event.data.length; i+=1) {
				var link = $("<option />", {
					class: 'link'
				});
				link.text(event.data[i][1]);
				link.attr("value", event.data[i][0]);
				link.appendTo(list);
			}
		}
	});
	</script>
</body>
</html>
