<?php
include 'functions.php';
  $q = "SELECT `name` FROM `university`";
  $sql = mysqli_query($mysqli,$q) or die(__FILE__." (".__LINE__.")".": ".mysqli_error($mysqli));
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
    echo "\"".$r[0]."\",";
    $i++;
  }
  echo "\"\"";
  mysqli_free_result($sql);
  mysqli_next_result($mysqli);
?> 
    ];
    $( "#suggestUni" ).autocomplete({
      source: availableTags
    });
    $("#suggestUni").on("keyup", function(e) {
        var pattern = $(this).val().toLowerCase();
        $("#universityList li").each(function() {
          var self = $(this);
          if (self.text().toLowerCase().indexOf(pattern) == -1)
          {
            self.hide();
          }
          else
          {
            self.show();
          }
        });
      if (e.which == 13)
      {
        e.preventDefault();
      }
    });
  });