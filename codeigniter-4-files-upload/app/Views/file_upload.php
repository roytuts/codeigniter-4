<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter 4 Single File Upload Example</title>
	<meta name="description" content="CodeIgniter 4 Single File Upload">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<style type="text/css">
		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		#body{
			margin: 0 15px 0 15px;
		}
		#container {
			width: 600px;
			margin: auto;
		}
		.error {
			color: #E13300;
		}
		.info {
			color: gold;
		}
		.success {
			color: darkgreen;
		}
	</style>
</head>
<body>
	<div id="container">
		<div class="message_box">
			<?php
				if (isset($success) && strlen($success)) {
					echo '<div class="success">';
					echo '<p>' . esc($success) . '</p>';
					echo '</div>';
				}

				if (isset($error) && strlen($error)) {
					echo '<div class="error">';
					echo '<p>' . esc($error) . '</p>';
					echo '</div>';
				}
			?>
		</div>
		<div>
			<div><?php echo anchor('filesupload/upload_multiple_files', 'Upload Multiple Files', 'title="Upload Multiple Files"'); ?></div>
			<?php
			echo form_open_multipart('filesupload/upload_single_file', array('id' => 'upload-single-file'));
			?>
				<fieldset>
					<legend>Upload Single File</legend>
					<section>
						<label>Browse a file</label>
						<label>
							<input type="file" name="single_file" id="single_file" readonly="true"/>
						</label>
						<p>
							<input type="submit" name="file_upload" value="Upload File"/>
						</p>
					</section>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>
