<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Consume REST API in CodeIgniter 4</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

</head>
<body>
	<h1>Consume REST API in CodeIgniter 4</h1>
	
	<h3>GET - List Of Users</h3>
	<?php
		echo $users;
	?>
	
	<h3>GET - Single User</h3>
	<?php
		echo $user;
	?>
	
	<h3>POST - Create New User</h3>
	<?php
		echo $new_user;
	?>
	
	<h3>PUT - Update User</h3>
	<?php
		echo $update_user;
	?>
</body>
</html>
