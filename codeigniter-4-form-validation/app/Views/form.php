<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter 4 Form Validation Example</title>
</head>
<body>

	<div style="width: 600px; margin: auto;">
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

		<?= form_open('form') ?>

			<h5>Username</h5>
			<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

			<h5>Password</h5>
			<input type="password" name="password" value="" size="50" />

			<h5>Password Confirm</h5>
			<input type="password" name="passconf" value="" size="50" />

			<h5>Email Address</h5>
			<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

			<p/>
			<div><input type="submit" name="submit" value="Submit" /></div>

		</form>
	</div>

</body>
</html>