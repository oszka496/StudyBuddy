<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="uniform" action="addUni.php" method="post" id="uniform">		
		<h3>Add university: </h3>

		<div class="form-group">
		<label for="uniName">Name:</label>
		<input type="text" name="uniName" maxlength="100" id = "uniName" class="form-control input-sm">
		</div>
		
		<div class="form-group">
		<label for="website">Website URL:</label>
		<input type="text" name="uniAddress" maxlength="150" id = "uniAddress" class="form-control input-sm">
		</div>

		<div class="form-group">
		<label for="tags">Tags:</label>
		<input type="text" name="tags" id = "tags" class="form-control input-sm">
		</div>

		<div class="form-group">
		<label for="uniMail">Mail:</label>
		<input type="text" name="uniMail" id = "uniMail" placeholder="@example.com" class="form-control input-sm">
		</div>
		<input type="submit" value="Add University" id="addUni" class="btn btn-success">
	</form>

		<script type="text/javascript">
	$(document).ready(function(){
		$('#uniform').ajaxForm(function(data){
			var msg = $('<div role="alert"></div>');
			var sp = $('<span></span>');
			sp.addClass("h4");
			msg.attr("id", "msg-uniadd")
			msg.append(sp);
			if(data.lastIndexOf("Error",0) === 0) msg.addClass("alert alert-danger");
			if(data.lastIndexOf("Success",0) === 0) msg.addClass("alert alert-success");
			sp.text(data);
			$("#uniform").before(msg);
			setTimeout(function() {
				msg.hide(1500, function() {
					msg.remove();
					$("#unis").load("university.php");
				});
			}, 3000);
		});
	});
	</script>
</body>
</html>