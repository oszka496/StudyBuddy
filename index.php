<?php
  require_once 'inc/functions.php';
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <title>StudyBuddy</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  
    <script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="inc/jquery-ui.js"></script>
    <script type="text/javascript" src="inc/jquery.validate.min.js"></script>
    <script type="text/javascript" src="inc/jquery.form.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.min.js"></script>-->
  
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/jquery-ui.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <nav class="navbar navbar-default" role="navigation">
        <a href="#" class="navbar-brand">StudyBuddy</a>
        <?php
          $user = User::getUser();
      
          if ($user === null):
          	include 'loginForm.php';
        ?>
        <?php else: ?>
          <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo "$user[1] $user[2]"; ?> <span class="glyphicon glyphicon-chevron-down"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
          
        <?php endif; ?>
      </div>
      </nav>
      <?php
        if ($user === null):
      ?>
      <div class="jumbotron">
        <?php
          include 'registerForm.php';
        ?>
      </div>
      <?php
        else:
          include "home.php";
        endif;
      ?>
      <footer class="footer">
        <p>© Zuzanna Gniewaszewska, Piotr Staniów 2014</p>
      </footer>

    </div> <!-- /container -->
    <script src="inc/bootstrap.min.js"></script>
</body>
</html>