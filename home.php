<?php
  require_once 'inc/functions.php';
  if (getUser() == "None")
    header("Location: index.php");
?>
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" class="active"><a href="#observed" aria-controls="observed" role="tab" data-toggle="tab">Observed courses</a></li>
  <li role="presentation"><a href="#available" aria-controls="available" role="tab" data-toggle="tab">Search for university</a></li>
  <li role="presentation"><a href="#universities" aria-controls="universities" role="tab" data-toggle="tab">Universities</a></li>
  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"></a></li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="observed">
    Observed courses:<br>
    <?php include("myCourses.php");?>
  </div>
  <div role="tabpanel" class="tab-pane" id="available">
    Your university: <strong>My UNI</strong>
    <form id="searchUni">
      <div>
        <input type="text" size="30" value="" id="suggest" placeholder="Search for people">
      </div>
   </form>
  </div>
  <div role="tabpanel" class="tab-pane" id="universities">
    <?php $mysqli->next_result();
      $result->close();
      include("university.php");?>
  </div>
  <div role="tabpanel" class="tab-pane" id="settings">stg...</div>
</div>

<script>
  $(function () {
    $('#myTab a:first').tab('show')
  })
</script>
<script type="text/javascript" src="inc/getUni.php"></script>
