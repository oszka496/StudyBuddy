<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="src/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="regform" action="register.php" method="post" id="regform">		
		<h1>Register: </h1>
		<label for="user">Username*:</label>
		<input type="text" name="user" maxlength="20" id = "user" />
		
		<label for="user">First name*:</label>
		<input type="text" name="fname" maxlength="20" id = "fname" />
		
		<label for="user">Last name*:</label>
		<input type="text" name="lname" maxlength="40" id = "lname" />
		
		<label for="pass1">Password*:</label>
		<input type="password" name="pass1" id = "pass1"/>
		
		<label for="pass2">Confirm Password*:</label>
		<input type="password" name="pass2" id = "pass2"/>
		
		<label for="email">Email*:</label>
		<input type="email" name="email" id="email"/>

		<input type="submit" value="Register" id="validate" class="button"/>
	</form>
	
	<script type="text/javascript">
	$(document).ready( function() {
		var ok = true;
		jQuery.validator.addMethod("check_login", function(value, element){
			$.get( "check_login.php", {'user' :value}).done( function( data ) {
				if(data == "false") ok = false;
				else ok = true;
			});
			return ok;
		});
		
		$('#regForm').validate({
			rules:{
				user: {
					required: true,
					check_login: true
				},
				fname:{
					required: true,
				},
				lname:{
					required: true,
				},
				pass1: {
					required: true,
					rangelength: [8, 32]
				},
				pass2: {
					equalTo: "#pass1"
				},
				email: {
					required: true,
					email:true
				},
			}, 
			messages: {
				user: {
					check_login: 'zajete'
				}
			}
		});
	});
	</script>
</body>
</html>