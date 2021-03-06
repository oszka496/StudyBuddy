<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="inc/jquery-ui.js"></script>
	<script type="text/javascript" src="inc/jquery.form.js"></script>
	<script type="text/javascript" src="inc/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="regform" action="register.php" method="post" id="regform">		
		<div class="input-group">
			<span class="input-group-addon input-light">Email</span>
			<input type="text" class="form-control" placeholder="john.doe@example.com" name="email" id="email">
		</div>
		<div class="input-group">
			<span class="input-group-addon input-light">Password</span>
			<input type="password" class="form-control" placeholder="At least 8 characters" name="pass1" id="pass1">
		</div>
		<div class="input-group">
			<span class="input-group-addon input-light">Retype</span>
			<input type="password" class="form-control" placeholder="Retype the above one" name="pass2" id="pass2">
		</div>
		<div class="input-group">
			<span class="input-group-addon input-light">First name</span>
			<input type="text" class="form-control" placeholder="Your first name" name="fname" id="fname">
		</div>
		<div class="input-group">
			<span class="input-group-addon input-light">Surname</span>
			<input type="text" class="form-control" placeholder="Your surname" name="lname" id="lname">
		</div>
		<div class="btn-group" id="utype" data-toggle="buttons">
			<label class="btn btn-sm btn-info active" for="utype1">
				<input type="radio" name="utype" id="utype1" value="1" autocomplete="off" checked> Teacher
			</label>
			<label class="btn btn-sm btn-info" for="utype2">
		    	<input type="radio" name="utype" id="utype2" value="2" autocomplete="off"> Student
			</label>
		</div>
		<br>
		<input type="submit" class="btn btn-lg btn-success" value="Register" id="validate" class="button"/>
	</form>
	
	<script type="text/javascript">
	$(document).ready( function() {
		$('.btn').button();
		/*$('#utype input[type="radio"]').click(function() {
			$('#utype label.active').removeClass('active');
			$(this).parent('label').addClass('active');
		});*/

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

		$('#regform').ajaxForm(function(data){
			var msg = $('<div role="alert"></div>');
			var sp = $('<span></span>');
			sp.addClass("h4");
			msg.append(sp);
			if(data.lastIndexOf("Error",0) === 0) msg.addClass("alert alert-danger");
			if(data.lastIndexOf("Success",0) === 0) msg.addClass("alert alert-success");
			sp.text(data);
			$("#regform").before(msg);
		});
	});
	</script>
</body>
</html>