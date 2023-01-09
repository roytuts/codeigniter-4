<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Codeigniter 4 MySQL AJAX CRUD Example</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	
	<link rel="stylesheet" href="table.css"/>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="product.js"></script>
</head>
<body>
	<div id="body">
		<div style="width: 600px; margin: auto;">
			<h1>Add a New Product</h1>
			
			<p><a href="<?php echo base_url(''); ?>">Back to Products</a></p>
			
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
			
			<?= form_open('product/save') ?>

				<h5>Name</h5>
				<input type="text" name="name" value="<?php echo set_value('name'); ?>" size="50" />

				<h5>Code</h5>
				<input type="text" name="code" value="<?php echo set_value('code'); ?>" size="50" />

				<h5>Price</h5>
				<input type="text" name="price" value="<?php echo set_value('price'); ?>" size="50" />

				<p/>
				<div><input type="submit" name="save" value="Save" /></div>

			</form>
		</div>
	</div>
</body>
</html>
