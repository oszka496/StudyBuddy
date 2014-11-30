<?php
  require_once 'inc/functions.php';
  if (getUser() == "None")
    header("Location: index.php");
?>
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" class="active"><a href="#observed" aria-controls="observed" role="tab" data-toggle="tab">Observed courses</a></li>
  <li role="presentation"><a href="#unis" aria-controls="unis" role="tab" data-toggle="tab">Universities</a></li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="observed">
    Observed courses:<br>
    <?php include("myCourses.php");?>
  </div>
  <div role="tabpanel" class="tab-pane" id="unis">
    <form id="searchUni">
      <input type="text" size="30" value="" id="suggest" placeholder="Search for people">
    </form>
    <?php 
    $mysqli->next_result();
    $result->close();
    include("university.php");?>
  </div>
  <div role="tabpanel" class="tab-pane" id="settings">stg...</div>
</div>

<script>
  $(function () {
    $('#myTab a:first').tab('show');
    $('.uniLink').click(function(e){
      var self = $(this);
      if (!self.next().hasClass('uniCourses'))
      {
        var uni = $("<div class='uniCourses'></div>");
        var href = self.attr('href');
        uni.load(href, function() {
          self.after(uni);  
        });
      }
      else
      {
        self.next().toggle();
      }
      e.preventDefault();
    });
  })
</script>
<script type="text/javascript" src="inc/getUni.php"></script>
