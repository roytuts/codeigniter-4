<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Check username availability using CodeIgniter 4, MySQL, jQuery, AJAX</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
</head>
<body>
	<div style="margin: 10px 0 0 10px;width: 600px">
		<h3>Codeigniter 4, MySQL, AJAX - Username Availability Check</h3>
		<div style="padding: 10px;">
			<fieldset>
				<legend>Check Username Availability</legend>
				<div>
					<label>Username</label><br/>
					<input type="text" name="username" id="username"/>
					<div id="msg"></div>
				</div>
			</fieldset>
		</div>
	</div>
	
	<!-- below jquery things triggered on on input event and checks the username availability in the database -->
	<script type="text/javascript">
		$(document).ready(function() {
			$("#username").on("input", function(e) {
				$('#msg').hide();
				if ($('#username').val() == null || $('#username').val() == "") {
					$('#msg').show();
					$("#msg").html("Username is a required field.").css("color", "red");
				} else {
					$.ajax({
						type: 'post',
						url: "<?= site_url('check-username-availability')//site_url('user/check_username_availability') ?>",
						data: JSON.stringify({username: $('#username').val()}),
						contentType: 'application/json; charset=utf-8',
						dataType: 'html',
						cache: false,
						beforeSend: function (f) {
							$('#msg').show();
							$('#msg').html('Checking...');
						},
						success: function(msg) {
							$('#msg').show();
							$("#msg").html(msg);
						},
						error: function(jqXHR, textStatus, errorThrown) {
							$('#msg').show();
							$("#msg").html(textStatus + " " + errorThrown);
						}
					});
				}
			});
		});
	</script>
</body>
</html>