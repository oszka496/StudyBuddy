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
  
    <!-- AddThisEvent -->
    <link type="text/css" href="css/add-event.css" rel="stylesheet">
    <script type="text/javascript" src="https://addthisevent.com/libs/1.5.8/ate.min.js"></script>
    <!-- AddThisEvent Settings -->
    <script type="text/javascript">
    addthisevent.settings({
      mouse   : false,
      css     : false,
      outlook   : {show:true, text:"Outlook Calendar"},
      google    : {show:true, text:"Google Calendar"},
      yahoo   : {show:true, text:"Yahoo Calendar"},
      ical    : {show:true, text:"iCal Calendar"},
      hotmail   : {show:true, text:"Hotmail Calendar"},
      facebook  : {show:true, text:"Facebook Calendar"}
    });
    </script>

    <script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="inc/jquery-ui.js"></script>
    <script type="text/javascript" src="inc/jquery.validate.min.js"></script>
    <script type="text/javascript" src="inc/jquery.form.js"></script>
    <script type="text/javascript" src="inc/scripts.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.min.js"></script>-->
  
    <link type="text/css" rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success" role="alert"><span class="h4"><?php echo s($_GET['msg']); ?></span></div>
      <?php endif; ?>
      <?php if (isset($_GET['err'])): ?>
        <div class="alert alert-danger" role="alert"><span class="h4"><?php echo s($_GET['err']); ?></span></div>
      <?php endif; ?>
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
                    <li><a href="settings.php">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
          
        <?php endif; ?>
      </div>
      </nav>
      <div class="content">
      <?php
        if ($user === null):
      ?>
        <div class="jumbotron" style="text-align: left;">
          <h1>Register</h1>
          <p>
            StudyBuddy is your best buddy at University!<br>
            We keep track of your latest assignments and problem sets to help you schedule your duties.<br>
            <span class="h5">Just drag a link to your bookmarks bar and then click it whenever you are on lecturer's
            website to add link to your course or find it in our database.</span>
            <br>
            <br>
            Study, buddy!
          </p>
          <?php
            include 'registerForm.php';
          ?>
        </div>
      <?php
        else:
          include "home.php";
        endif;
      ?>
      </div>
      <footer class="footer">
        <p>© Zuzanna Gniewaszewska, Piotr Staniów 2014</p>
      </footer>

    </div> <!-- /container -->
    <script src="inc/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".dropdown-menu a").click(function(e) {
        var t = $(this);
        var href = t.attr("href");
        if (href == "logout.php")
          window.location.href="logout.php";
        $(".content").load(href);
        e.preventDefault();
      });
    });
    </script>
</body>
</html>