<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="src/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="loginform" action="login.php" method="post" id="loginform">		
		<h1>Log in: </h1>
		<label for="user">Username:</label>
		<input type="text" name="user" maxlength="20" id = "user" />
		
		<label for="pass">Password:</label>
		<input type="password" name="pass" id = "pass"/>
		
	</form>
	
	<script type="text/javascript">
	$(document).ready( function() {
		$('#loginform').validate({
			rules:{
				user: {
					required: true
				},
				pass: {
					required: true
				},
			},
			messages:{
				user: {
					required: "Podaj login"
				},
				pass: {
					required: "Podaj hasło"
				}
			}
		});
	});
	</script>
</body>
</html>