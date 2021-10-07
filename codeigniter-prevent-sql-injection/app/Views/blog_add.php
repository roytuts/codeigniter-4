<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter 4 and MySQL 8 - Prevent SQL Injections</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
</head>
<body>

	<div style="width: 600px; margin: auto;">
		<p><a href="<?php echo site_url('home') ?>">Blog Home</a></p>
	
		<?php
			if(isset($errors)):
		?>
			<ul style="list-style: none; color: red;">
				<?php foreach ($errors as $error) : ?>
				<li><?= esc($error) ?></li>
				<?php endforeach ?>
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

		<?= form_open('home/create') ?>

			<h5>Title</h5>
			<input type="text" name="title" value="<?php echo set_value('title'); ?>" />

			<h5>Content</h5>
			<textarea type="text" name="content"><?php echo set_value('content'); ?></textarea>

			<p/>
			<div><input type="submit" name="submit" value="Submit" /></div>

		</form>
	</div>

</body>
</html>