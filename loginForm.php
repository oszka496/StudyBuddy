<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="inc/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>


	<form class="navbar-form navbar-right" role="form" method="post" action="login.php" id="loginForm">
      <div class="form-group">
        <input type="text" placeholder="Email" class="form-control" name="email" maxlength="50" id = "email">
      </div>
      <div class="form-group">
        <input type="password" placeholder="Password" class="form-control" name="pass" id="pass">
      </div>
      <button type="submit" class="btn btn-success" id="login">Sign in</button>
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
			}
		});

		$('#loginForm').ajaxForm(function(data){
			var msg = $('<div role="alert"></div>');
			var sp = $('<span></span>');
			sp.addClass("h4");
			msg.append(sp);
			if(data.lastIndexOf("Error",0) === 0) msg.addClass("alert alert-danger");
			if(data.lastIndexOf("Success",0) === 0) msg.addClass("alert alert-success");
			sp.text(data);
			if(data.lastIndexOf("Hidden",0) !== 0) $("#loginForm").before(msg);
		});
	});
	</script>
</body>
</html>