	<legend class="first-content-element">Register an Account</legend>
	<form accept-charset="UTF-8" class="form-horizontal" id="register_account" role="form" action="<?php echo base_url(); ?>index.php/register" method="POST">
		<div class="form-group required">
			<label for="loginnameinput" class="control-label col-md-2 required">Login Name</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="loginnameinput" name="loginname" min="3" placeholder="Secret Login Name" required="true">
			</div>
		</div>

		<div class="form-group required">
			<label for="passwordinput" class="control-label col-md-2 required">Password</label>
			<div class="col-md-3">
				<input type="password" class="form-control" id="passwordinput" name="password" min="3" required="true">
			</div>
		</div>

		<div class="form-group required">
			<label for="screenname" class="control-label col-md-2 required">Screen Name</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="screennameinput" name="screenname" min="1" placeholder="Public Screen Name" required="true">
			</div>
		</div>
		
		<div class="form-group  last-content-element">
			<div class="col-md-offset-2 col-md-1">
				<input class="btn btn-primary" name="submit" value="Register" type="submit">
			</div>
		</div>
	</form>