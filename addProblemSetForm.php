<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="psform" action="addProblemSet.php" method="post" id="psform" role="form">		
		<h4>Add problem set: </h4>

		<div class="form-group">
		<label for="psName">Name:</label>
		<input type="text" name="psName" maxlength="100" id = "psName" class="form-control input-sm datepicker">
		</div>

		<div class="form-group">
		<label for="psAddress">Problem Set URL:</label>
		<input type="url" name="psAddress" maxlength="150" id = "psAddress" class="form-control input-sm datepicker">
		</div>

		<div class="form-group">
		<label for="sday">Problem Set deadline:</label>
		<input type="text" placeholder="" name="eday" id="eday" value="" class="form-control input-sm datepicker" >
		</div>

		<input type="hidden" value="<?php echo $cid ?>" name="courseId" id="courseId"/>
		<input type="submit" value="Add Problem Set" id="addPs" class="btn btn-success"/>
	</form>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').each(function(){
			$(this).datepicker({
				showWeek: true,
				dateFormat: "dd/mm/yyyy"
			});
		});
	});
	</script>
</body>
</html>