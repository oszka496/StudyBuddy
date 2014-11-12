<?php
	include 'inc/functions.php';
	global $mysqli;
?>
<!DOCUMENT HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>StudyBuddy</title>
	<script type="text/javascript" src="inc/jQuery.js"></script>
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
			<a title="Save to StudyBuddy" href="javascript:document.getElementsByTagName('body')[0].appendChild(document.createElement('script')).setAttribute('src','http://localhost/inc/manager.js');">Save to studybuddy</a>
		</article>
	</section>
	<script type="text/javascript">
		$(document).ready(function(e) {

		});
	</script>
</body>
</html>