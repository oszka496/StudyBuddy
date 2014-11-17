<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="inc/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="regform" action="register.php" method="post" id="regform">		
		<h1>Register: </h1>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email"/>
		
		<label for="pass1">Password:</label>
		<input type="password" name="pass1" id = "pass1"/>
		
		<label for="pass2">Repeat password:</label>
		<input type="password" name="pass2" id = "pass2"/>
		
		
		<label for="user">First name:</label>
		<input type="text" name="fname" maxlength="20" id = "fname" />
		
		<label for="user">Last name:</label>
		<input type="text" name="lname" maxlength="40" id = "lname" />
		
		<input type="radio" name="utype" value="teacher">Teacher<br>
		<input type="radio" name="utype" value="student">Student
		
		<input type="submit" value="Register" id="validate" class="button"/>
	</form>
	
	<script type="text/javascript">
	$(document).ready( function() {
		var ok = true;
		jQuery.validator.addMethod("checkEmail", function(value, element){
			$.get( "checkEmail.php", {'email' :value}).done( function( data ) {
				if(data == "false") ok = false;
				else ok = true;
			});
			return ok;
		});
		
		$('#regform').validate({
			rules:{
				email: {
					required: true,
					email:true,
					checkEmail: true
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
				
				utype: {
					required: true
				}
			}, 
			messages: {
				email: {
					checkEmail: 'Email taken'
				}
			}
		});
	});
	</script>
</body>
</html>