<?php
  require_once 'functions.php';
  $id = s($_GET['id']);
  $id = intval($id);
  $query = "CALL show_my_courses($id);";
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
?> 
    ];
    $( "#suggestCourse" ).autocomplete({
      source: availableTags,
      select: function(event, ui) {
        $('#suggestCourse').attr("cid", ui.item.id);
      }
    });
  });