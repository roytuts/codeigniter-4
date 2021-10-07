<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter 4 and MySQL 8 - Prevent SQL Injections</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<!-- STYLES -->

	<style>
	#blogs {
	  font-family: Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	#blogs td, #blogs th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#blogs tr:nth-child(even){background-color: #f2f2f2;}

	#blogs tr:hover {background-color: #ddd;}

	#blogs th {
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
	<h1>CodeIgniter 4 and MySQL 8 - Prevent SQL Injections</h1>

	<div id="body">
		<p><a href="<?php echo site_url('home/create') ?>">Add New Blog</a></p>
	
		<?php
			if ($blog_list) {
		?>
        <table id="blogs">
            <thead>
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Content</th>
					<th>Created</th>
                </tr>
            </thead>
			<tbody>
				<?php
					foreach ($blog_list as $blog) {
					?>
					<tr>
						<td>
							<?php echo $blog->blog_id; ?>
						</td>
						<td>
							<?php echo $blog->blog_title; ?>
						</td>
						<td>
							<?php echo $blog->blog_content; ?>
						</td>
						<td>
							<?php echo $blog->blog_date; ?>
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