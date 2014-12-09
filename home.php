<?php
  require_once 'inc/functions.php';
  if (User::getUser() === null)
    header("Location: index.php");
?>
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation"><a href="#manager" aria-controls="manager" role="tab" data-toggle="tab">Getting started</a></li>
  <li role="presentation" class="active"><a href="#observed" aria-controls="observed" role="tab" data-toggle="tab">Observed courses</a></li>
  <li role="presentation"><a href="#unis" aria-controls="unis" role="tab" data-toggle="tab">Universities</a></li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane" id="manager">
    <h2>Getting started</h2>
    <p>
    If you want to keep track of your recent assignments and problem sets simply drag this link to your bookmarks bar
    and click it whenever you are at lecturer's website.<br>
    Our magnificent manager will pop up and you'll be able to add course to your <i>Observed list</i>.
    </p>
    <a title="Save to StudyBuddy"
      href="javascript:document.getElementsByTagName('body')[0]
            .appendChild(document.createElement('script'))
            .setAttribute('src','http://studybuddy-atpwr.rhcloud.com/inc/manager.js');"
      class="btn btn-warning" style="margin: 10px auto; display: block; width: auto;">Save to StudyBuddy</a>
  </div>
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
  $(function() {
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

    $(document).on("click", ".course-action", function(e){
      var t = $(this);
      var d = $("<div></div>");
      var href = $(this).attr("href");
      d.load(href, function(data){
        var msg = $('<div role="alert"></div>');
        var sp = $('<span></span>');
        sp.addClass("h4");
        msg.append(sp);
        if(data.lastIndexOf("Error",0) === 0) msg.addClass("alert alert-danger");
        if(data.lastIndexOf("Success",0) === 0) msg.addClass("alert alert-success");
        sp.text(data);
        t.closest(".list-group").before(msg);
        msg.delay(3000).slideUp(5000);
      });
      e.preventDefault();
    });

  });
</script>
<script type="text/javascript" src="inc/getUni.php"></script>
