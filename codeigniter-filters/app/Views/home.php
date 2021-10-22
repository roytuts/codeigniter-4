<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to CodeIgniter 4 Login Logout Example</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
</head>
<body>
	<div id="container">
		<div id="body">
			<p>
				<?php
					$session = session();
					$config = new \Config\CustomConfig();
					$key = $config->msgKey;
						
					if($session->getFlashdata($key)) {
						echo $session->getFlashdata($key);
					}
				?>
			</p>
			<p>Welcome to Dashboard</p>
			<p>
				Last login: <strong><?php echo $session->get('last_login') == NULL ? 'First Time' : $session->get('last_login'); ?></strong>
				Welcome,</span> <strong><?php echo $session->get('user_name'); ?></strong> 
				<?php echo anchor('auth/logout', '[ Logout ]', 'title="Logout"'); ?>
			</p>
		</div>
	</div>
</body>
</html>