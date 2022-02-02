<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Codeigniter MongoDB Create Read Update Delete Example</title>
    </head>
    <body>
        <div id="container">
            <h1>Codeigniter 4 MongoDB Create Read Update Delete Example</h1>
                                          
		   <div>
			  <?php echo anchor('/usercontroller', 'Back to Users');?>
		   </div>
                                          
            <div id="body">
				<?php
					if(isset($errors)):
				?>
					<ul style="list-style: none; color: red;">
					<?php foreach ($errors as $err) : ?>
						<li><?= esc($err) ?></li>
					<?php endforeach ?>
					</ul>
				<?php
					endif;
				?>
				
                <?php
					if (isset($error)) {
					  echo '<p style="color:red;">' . $error . '</p>';
					}
                ?>
 
                <?php
					$attributes = array('name' => 'form', 'id' => 'form');
					echo form_open(uri_string(), $attributes);
                ?>
 
                <h5>Full Name</h5>
                <input type="text" name="name" value="<?php echo isset($user)?$user->name:set_value('name'); ?>" size="50" />
 
                <h5>Email Address</h5>
                <input type="text" name="email" value="<?php echo isset($user)?$user->email:set_value('email'); ?>" size="50" />
 
                <p><input type="submit" name="submit" value="Submit"/></p>
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </body>
</html>
