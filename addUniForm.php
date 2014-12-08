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
		<input type="text" name="uniName" maxlength="100" id = "uniName" />
		
		<label for="website">Website URL:</label>
		<input type="text" name="uniAddress" maxlength="150" id = "uniAddress"/>

		<label for="tags">Tags:</label>
		<input type="text" name="tags" id = "tags"/>

		<label for="uniMail">Mail:</label>
		<input type="text" name="uniMail" id = "uniMail" placeholder="@example.com"/>

		<input type="submit" value="Add University" id="addUni" class="button"/>
	</form>

		<script type="text/javascript">
	$(document).ready(function(){
		$('#uniform').ajaxForm(function(data){
			var msg = $('<div role="alert"></div>');
			var sp = $('<span></span>');
			sp.addClass("h4");
			msg.append(sp);
			if(data.lastIndexOf("Error",0) === 0) msg.addClass("alert alert-danger");
			if(data.lastIndexOf("Success",0) === 0) msg.addClass("alert alert-success");
			sp.text(data);
			$("#uniform").before(msg);
		});
	});
	</script>
</body>
</html>