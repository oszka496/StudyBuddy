<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="inc/jquery.validate.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>


	<form class="navbar-form navbar-right" role="form" method="post" action="login.php">
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
	});
	</script>
</body>
</html>