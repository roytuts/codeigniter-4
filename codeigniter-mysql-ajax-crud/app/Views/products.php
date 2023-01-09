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
	<div>
	<h1>Products</h1>

	<div id="body">
		<p><a href="<?php echo base_url('product/create'); ?>">Create a New Product</a></p>
		<?php
			if ($product_list) {
		?>
		<div id="msg"></div>
        <table class="datatable">
            <thead>
				<tr>
					<th>ID</th>
					<th>Code</th>
					<th>Name</th>
					<th>Price</th>
					<th>Actions</th>
                </tr>
            </thead>
			<tbody>
				<?php
					$i = 0;
					foreach ($product_list as $p) {
						$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
						$i++;
					?>
					<tr class="<?php echo $col_class; ?>">
						<td><?php echo $p->id; ?></td>
						<td><?php echo $p->code; ?></td>
						<td><?php echo $p->name; ?></td>
						<td><?php echo $p->price; ?></td>
						<td><button class='edit'>Edit</button>&nbsp;&nbsp;<button class='delete' id='<?php echo $p->id; ?>'>Delete</button></td>
					</tr>
					<?php
				}
				?>
			</tbody>
        </table>
		<?php
			} else {
				echo '<div style="color:red;"><p>No Record Found</p></div>';
			}
		?>
		</div>
	</div>
</body>
</html>
