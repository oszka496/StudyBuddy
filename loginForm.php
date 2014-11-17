<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="inc/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="loginform" action="login.php" method="post" id="loginform">		
		<h1>Zaloguj się: </h1>
		<label for="user">Email:</label>
		<input type="email" name="email" maxlength="50" id = "email" />
		
		<label for="pass">Hasło:</label>
		<input type="password" name="pass" id = "pass"/>
		<input type="submit" value="Login" id="login" class="button"/>
		
	</form>
	
	<script type="text/javascript">
	$(document).ready( function() {
		$('#loginform').validate({
			rules:{
				email: {
					required: true
				},
				pass: {
					required: true
				},
			},
			messages:{
				email: {
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