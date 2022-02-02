<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Codeigniter 4 MongoDB CRUD Example</title>
		<meta name="description" content="The small framework with powerful features">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
<body>
	<div>
		<h1>Codeigniter 4 MongoDB Create Read Update Delete Example</h1>

		<div>
			<?php echo anchor('/usercontroller/create', 'Create User');?>
		</div>

		<div id="body">
			<?php
			if ($users) {
			?>
			<table class="datatable">
				<thead>
					<tr>
					  <th>Name</th>
					  <th>Email</th>
					  <th>Acions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					  $i = 0;
					  foreach ($users as $user) {
						 $col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
						 $i++;
					  ?>
					  <tr class="<?php echo $col_class; ?>">
						 <td>
						   <?php echo $user->name; ?>
						 </td>
						 <td>
						   <?php echo $user->email; ?>
						 </td>
						 <td>
						   <?php echo anchor('/usercontroller/update/' . $user->_id, 'Update'); ?>
							
						   <?php echo anchor('/usercontroller/delete/' . $user->_id, 'Delete', array('onclick' => "return confirm('Do you want delete this record')")); ?>
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
