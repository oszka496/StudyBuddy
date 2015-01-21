<?php
	header('P3P: CP="CAO PSA OUR"');
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
	<script type="text/javascript" src="inc/jquery.form.js"></script>
	<script src="inc/bootstrap.min.js"></script>
</head>
<body>
	<div id='study-buddy-manager'>
		<span>
		<h1>StudyBuddy</h1>
		<p id="name"></p>
		</span>
		<form id="mgrform" method="post" action="<?php echo LINK;?>/addProblemSet.php" target="manager">
		<h4>Add assignment to course</h4>
		<div class="alert alert-warning" style="display: none;" id="mgrresult"></div>
		<div class="input-group input-group-sm">
			<input type="text" class="form-control" placeholder="Name of Problem set" name="psName">
		</div>

		<div class="input-group input-group-sm">
			<input type="text" class="form-control" placeholder="Name of course" id="suggestCourse" name="courseId">
		</div>
		<div class="input-group input-group-sm">
			<input type="text" name="psdate" id="psdate" value="" class="form-control input-sm datepicker" placeholder="Problem set deadline" >
		</div>

		<div class="input-group input-group-sm">
			<select id="links" class="form-control" name="psAddress"/>
		</div>
		<input type="submit" class="btn btn-success" value="Add problem set">
		<input type="hidden" value="" name="userid" id="userid">
		<input type="hidden" value="" name="userlogin" id="userlogin">
		</form>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var list = $("#links");
		window.addEventListener("message", receiveMessage, false);
		
		$("#mgrform").ajaxForm({
			success: function(data) {
				$("#mgrresult").text(data).slideDown(5000).delay(5000).slideUp(4000);
			},
			beforeSerialize: function($form, options) { 
				options.data = {
					courseId: $("#suggestCourse").attr("cid")
				}
			}
		});
		
		$('.datepicker').each(function(){
			$(this).datepicker({
				showWeek: true,
				dateFormat: "dd/mm/yy"
			});
		});

		function receiveMessage(event)
		{
			var id = event.data[0][1];
			var login = event.data[0][0];
			$("#userid").val(id);
			$("#userlogin").val(login);
			$("#name").text(login);
			for (var i=1; i<event.data.length; i+=1) {
				var link = $("<option />", {
					class: 'link'
				});
				link.text(event.data[i][1]);
				link.attr("value", event.data[i][0]);
				link.appendTo(list);
			}

			$.get("inc/getCourses.php", {
				"id": id,
				"login": login
			}, function(data) {
				eval(data);
			});
		}
	});
	</script>
</body>
</html>
