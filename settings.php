<h2>Settings</h2>
<form name="editDataForm" role="form" method="post" action="changePassword.php" id="editDataForm">
      <div class="form-group">
        <input type="password" placeholder="Old password" class="form-control" name="oldPass" id = "oldPass">
      </div>
      <div class="form-group">
        <input type="password" placeholder="New password" class="form-control" name="pass0" id="pass0">
      </div>
      <div class="form-group">
        <input type="password" placeholder="Retype" class="form-control" name="pass1" id="pass1">
      </div>
      <button type="submit" class="btn btn-success" id="login">Change password</button>
</form>

<script type="text/javascript">
$(document).ready( function() {
	$('#editDataForm').validate({
			rules:{
				oldPass: {
					required: true
				},
				pass0: {
					required: true,
					rangelength: [8, 32]
				},
				pass1: {
					equalTo: "#pass0"
				},
			}
		});
});
</script>