<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Multiple Table Rows Deletion in Codeigniter 4, AJAX, jQuery, MySQL</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	
	<link rel="stylesheet" href="table.css"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
	<script src="delete.js"></script>
</head>
<body>
	<div>
	<h1>Multiple Table Rows Deletion in Codeigniter 4, AJAX, jQuery, MySQL</h1>

	<div id="body">
		<?php
			if ($product_list) {
		?>
		<div id="msg"></div>
		<button id="delete_selected">Delete Selected Product(s)</button>
        <table class="datatable">
            <thead>
				<tr>
					<th><input id="check_all" type="checkbox"></th>
					<th>ID</th>
					<th>Code</th>
					<th>Name</th>
					<th>Price</th>
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
						<td><input type="checkbox" name="row-check" value="<?php echo $p->id;?>"></td>
						<td><?php echo $p->id; ?></td>
						<td><?php echo $p->code; ?></td>
						<td><?php echo $p->name; ?></td>
						<td><?php echo $p->price; ?></td>
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
