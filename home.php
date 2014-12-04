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
    <?php include("myCourses.php");?>
  </div>

  <div role="tabpanel" class="tab-pane" id="unis">
    <form id="searchUni">
        <div class="input-group">
          <input type="text" class="form-control" size="30" value="" id="suggestUni" placeholder="Search for university">
          <span class="input-group-btn">
            <button class="btn btn-info" type="button">Go!</button>
          </span>
        </div><!-- /input-group -->
    </form>
    <?php 
    $mysqli->next_result();
    $result->close();
    include("university.php");?>
  </div>  
</div>

<script>
  $(function () {
    $('#myTab a:first').tab('show');
    $('.listLink').click(function(e){
      var self = $(this);
      if (!self.next().hasClass('listContent'))
      {
        var uni = $("<div></div>").addClass('listContent');
        var href = self.attr('href');
        uni.load(href, function() {
          if (!self.hasClass("btn"))
            self.after(uni);  
          else
            self.parent().after(uni);
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
