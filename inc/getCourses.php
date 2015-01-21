<?php
  require_once 'functions.php';
  if (isset($_GET['id']) && isset($_GET['login']))
  {
    $userid = s($_GET['id']);
    $userlogin = s($_GET['login']);
    $autho = User::authenticate($userlogin, $userid);
    if ($autho != User::$AUTHENTICATION_SUCCESS) {
      header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
      header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
      header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
      header ("Pragma: no-cache"); // HTTP/1.0
      header("Content-Type: application/x-javascript; charset=utf-8");
      echo "alert('Malformed credentials.');";
      exit();
    }
  }
  else {
      header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
    header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header ("Pragma: no-cache"); // HTTP/1.0
    header("Content-Type: application/x-javascript; charset=utf-8");
    echo "alert('Insufficent data to verify user. Link is malformed.');";
    exit();
  }
  $uid = User::getUserIdByMail($userlogin);
  $uid = intval($uid[0]);
  $query = "CALL show_my_courses($uid)";
  $sql = mysqli_query($mysqli, $query) or die(__FILE__." (".__LINE__.")".": ".mysqli_error($mysqli));
  $i=0;
  $results = array();
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header ("Pragma: no-cache"); // HTTP/1.0
  header("Content-Type: application/x-javascript; charset=utf-8");
?>
  $(function() {
   
      var availableTags = [
<?php
  while ($r = mysqli_fetch_row($sql)) {
    echo "{ value: \"".$r[0]."\", id: \"".$r[1]."\"},";
    $i++;
  }
  echo "\"\"";
  mysqli_free_result($sql);
  mysqli_next_result($mysqli);
?> 
    ];
    $( "#suggestCourse" ).autocomplete({
      source: availableTags,
      select: function(event, ui) {
        $('#suggestCourse').attr("cid", ui.item.id);
      }
    });
  });