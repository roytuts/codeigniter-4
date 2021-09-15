<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter 4 and MySQL 8 CRUD Example - List of Products</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<!-- STYLES -->

	<style>
	#products {
	  font-family: Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	#products td, #products th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#products tr:nth-child(even){background-color: #f2f2f2;}

	#products tr:hover {background-color: #ddd;}

	#products th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: black;
	  color: white;
	}
	</style>
</head>
<body>

<div>
	<h1>CodeIgniter 4 and MySQL 8 CRUD Example</h1>

	<div id="body">
		<p><a href="<?php echo site_url('productcontroller/create') ?>">Add New Product</a></p>
	
		<?php
			if ($product_list) {
		?>
        <table id="products">
            <thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Price</th>
					<th>Sale Price</th>
					<th>Sale Count</th>
					<th>Sale Date</th>
					<th>Actions</th>
                </tr>
            </thead>
			<tbody>
				<?php
					foreach ($product_list as $product) {
					?>
					<tr>
						<td>
							<?php echo $product->id; ?>
						</td>
						<td>
							<?php echo $product->name; ?>
						</td>
						<td>
							<?php echo $product->price; ?>
						</td>
						<td>
							<?php echo $product->sale_price; ?>
						</td>
						<td>
							<?php echo $product->sales_count; ?>
						</td>
						<td>
							<?php echo $product->sale_date; ?>
						</td>
						<td>
							<a href="<?php echo site_url('productcontroller/update?id=' . $product->id) ?>">Edit</a>&nbsp;|&nbsp;<a onclick="return confirm('Delete Product with id - <?php echo $product->id; ?>?')" href="<?php echo site_url('productcontroller/delete_product?id=' . $product->id) ?>">Delete</a>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
        </table>
    <?php
        } else {
            echo '<div style="color:red;"><p>No Record Found!</p></div>';
        }
    ?>
	</div>
</div>

</body>
</html>