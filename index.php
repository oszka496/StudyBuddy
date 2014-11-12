<?php
	include 'inc/functions.php';
?>
<!DOCUMENT HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<h1></h1>
		<form action="login.php" method="post" id="login-form">
		</form>
	</header>
	<section>
		<aside></aside>
		<article>
			<a title="Save to StudyBuddy" href="javascript:document.getElementsByTagName('body')[0].appendChild(document.createElement('script')).setAttribute('src','http://localhost/StudyBuddy/inc/manager.js');">Save to StudyBuddy</a>
		</article>
	</section>
	<script type="text/javascript">
		$(document).ready(function(e) {

		});
	</script>
</body>
</html>