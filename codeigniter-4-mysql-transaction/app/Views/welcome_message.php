<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter 4 MySQL Transaction Example</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
</head>
<body>
	
	<div style="width: 600px; margin: auto;">
		<?php
			if(isset($error)):
		?>
			<ul style="list-style: none; color: red;">
				<li><?= esc($error) ?></li>
			</ul>
		<?php
			endif;
		?>
		
		<?php
			if(isset($success)):
		?>
			<ul style="list-style: none; color: green;">
				<li><?= esc($success) ?></li>
			</ul>
		<?php
			endif;
		?>
	</div>
	
</body>
</html>
