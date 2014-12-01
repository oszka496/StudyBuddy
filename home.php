<?php
  require_once 'inc/functions.php';
  if (User::getUser() === null)
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
      <div class="col-lg-12">
        <div class="input-group">
          <input type="text" class="form-control" size="30" value="" id="suggest" placeholder="Search for university">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->    </form>
    <?php 
    $mysqli->next_result();
    $result->close();
    include("university.php");?>
  </div>
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
