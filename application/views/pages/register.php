
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	echo '<legend class="first-content-element">Register an Account</legend>';

	if( isset( $validation_errors ) )
	{
		echo '<div class="error-msg-box">' . $validation_errors . '</div>';
	}
	else if( isset( $validation_ok ) )
	{
		echo '<div class="success-msg-box">' . $validation_ok . '</div>';
	}
?>
	<form accept-charset="UTF-8" class="std-form form-horizontal" action="<?php echo base_url(); ?>index.php/register" method="POST">

		<div class="form-group required">
			<label for="reg_name" class="control-label col-md-2 required">Login Name</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="reg_name" name="reg_name" min="3" placeholder="Secret Login Name" autocomplete="off" maxlength="<?php echo config_item('max_chars_for_user_name'); ?>" required="true">
			</div>
		</div>
		

		<div class="form-group required">
			<label for="reg_pass" class="control-label col-md-2 required">Password</label>
			<div class="col-md-3">
				<input type="password" class="form-control" id="reg_pass" name="reg_pass" min="8" required="true" maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" onfocus="this.removeAttribute('readonly');">
			</div>
		</div>

		<div class="form-group required">
			<label for="reg_screenname" class="control-label col-md-2 required">Screen Name</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="reg_screenname" name="reg_screenname" min="3" placeholder="Public Screen Name" required="true">
			</div>
		</div>
		
		<div class="form-group last-content-element">
			<div class="col-md-offset-2 col-md-1">
				<input class="btn btn-primary" name="submit" id="submit_button" value="Register" type="submit">
			</div>
		</div>
	</form>