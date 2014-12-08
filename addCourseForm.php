<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="courseform" action="addCourse.php" method="post" id="courseform" role="form">		
		<h4>Add course: </h4>
		<div class="form-group">
		<label for="courseName">Name:</label>
		<input type="text" name="courseName" maxlength="100" id = "courseName" class="form-control input-sm" >
		</div>

		<div class="form-group">
		<label for="courseAddress">Website URL:</label>
		<input type="url" name="courseAddress" maxlength="150" id = "courseAddress" class="form-control input-sm" >
		</div>

		<div class="form-group">
		<label for="sdate">Course start:</label>
		<input type="text" placeholder="" name="sdate" id="sdate" value="" class="form-control input-sm datepicker" >
		</div>

		<div class="form-group">
		<label for="edate">Course end:</label>
		<input type="text" placeholder="" name="edate" id="edate" value="" class="form-control input-sm datepicker" >
		</div>

		<input type="hidden" value="<?php echo $uid ?>" name="uniId" id="uniId"/>
		<input type="submit" value="Add Course" id="addCourse" class="btn btn-success"/>
	</form>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').each(function(){
			$(this).datepicker({
				showWeek: true,
				dateFormat: "dd/mm/yy"
			});
		});

		$('#courseform').ajaxForm(function(data){
			var msg = $('<div role="alert"></div>');
			var sp = $('<span></span>');
			sp.addClass("h4");
			msg.append(sp);
			if(data.lastIndexOf("Error",0) === 0) msg.addClass("alert alert-danger");
			if(data.lastIndexOf("Success",0) === 0) msg.addClass("alert alert-success");
			sp.text(data);
			$("#courseform").before(msg);
		})
	});
	</script>
</body>
</html>
