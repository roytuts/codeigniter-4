<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sort Table Data in Ascending or Descending Order in CodeIgniter 4 and MySQL 8</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/css/table.css"/>

	<!-- STYLES -->

	<style {csp-style-nonce}>
		* {
			transition: background-color 300ms ease, color 300ms ease;
		}
		*:focus {
			background-color: rgba(221, 72, 20, .2);
			outline: none;
		}
		html, body {
			color: rgba(33, 37, 41, 1);
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
			font-size: 16px;
			margin: 0;
			padding: 0;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-rendering: optimizeLegibility;
		}
		footer {
			background-color: rgba(221, 72, 20, .8);
			text-align: center;
		}
		footer .environment {
			color: rgba(255, 255, 255, 1);
			padding: 2rem 1.75rem;
		}
		footer .copyrights {
			background-color: rgba(62, 62, 62, 1);
			color: rgba(200, 200, 200, 1);
			padding: .25rem 1.75rem;
		}
	</style>
</head>
<body>

<div>
	<h1>Sort Table Data in Ascending or Descending Order in CodeIgniter 4 and MySQL 8</h1>

	<div id="body">
		<?php
			if ($item_list) {
		?>
        <table class="datatable">
            <thead>
				<tr>
					<th <?php echo($sort_by == 'name' ? 'class="sort_'.$sort_order.'"' : ''); ?>>
						<?php
                            echo anchor("item/item_list/name/" .
                                    (($sort_order == 'ASC' && $sort_by == 'name') ? 'DESC' : 'ASC'), 'Name');
                        ?>
					</th>
					<th <?php echo($sort_by == 'desc' ? 'class="sort_'.$sort_order.'"' : ''); ?>>
						<?php
                            echo anchor("item/item_list/desc/" .
                                    (($sort_order == 'ASC' && $sort_by == 'desc') ? 'DESC' : 'ASC'), 'Description');
                        ?>
                    </th>
					<th <?php echo($sort_by == 'price' ? 'class="sort_'.$sort_order.'"' : ''); ?>>
						<?php
                            echo anchor("item/item_list/price/" .
                                    (($sort_order == 'ASC' && $sort_by == 'price') ? 'DESC' : 'ASC'), 'Price');
                        ?>
                    </th>
                </tr>
            </thead>
			<tbody>
				<?php
					$i = 0;
					foreach ($item_list as $item) {
						$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
						$i++;
					?>
					<tr class="<?php echo $col_class; ?>">
						<td>
							<?php echo $item->name; ?>
						</td>
						<td>
							<?php echo $item->desc; ?>
						</td>
						<td>
							<?php echo $item->price; ?>
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

<!-- FOOTER: DEBUG INFO -->

<footer>
	<div class="environment">

		<p>Page rendered in {elapsed_time} seconds</p>

		<p>Environment: <?= ENVIRONMENT ?></p>

	</div>
</footer>

</body>
</html>
