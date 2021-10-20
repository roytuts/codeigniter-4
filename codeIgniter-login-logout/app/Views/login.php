<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to CodeIgniter 4 Login Logout Example</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	
	<link rel="stylesheet" href="/css/login.css"/>
</head>
<body>
	<div class="wrap">
		<div id="content">
			<div id="main">
				<div class="full_w">
					<?php
						if (isset($msg) && !empty($msg)) {
							echo '<div class="n_ok"><p>';
							if(is_array($msg)) {
								foreach ($msg as $m) :
									echo esc($m);
								endforeach;
							} else {
								echo $msg;
							}
							echo '</p></div>';
						}
					?>
					<?php
						helper('form');
						
						echo form_open(current_url(true));
						if (isset($errors) && !empty($errors)) {
							echo '<div class="n_error">';
							foreach ($errors as $error) :
								echo esc($error);
							endforeach;
							echo '</div><div class="sep"></div>';
						}
					?>
						<label for="username">Username:</label>
						<input id="username" name="username" class="text" type="text"
							   maxlength="100"/>
						<label for="password">Password:</label>
						<input id="password" name="password" type="password"
							   class="text" maxlength="25"/>
						<div class="sep"></div>
						<input type="submit" name="login" id="login" value="Login"/>
					<?php
					echo form_close();
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
