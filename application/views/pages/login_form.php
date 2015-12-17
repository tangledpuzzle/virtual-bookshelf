<?php
/**
 * The user login page.
 * @author Community Auth
 */

// disallow direct access.
if ($this->uri->uri_string()==="login_form"){
	show_404();
}
else
{ 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2015, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if( ! isset( $optional_login ) )
{
	echo '<h1 class="first-content-element">Login</h1>';
}

if( ! isset( $on_hold_message ) )
{
	if( isset( $login_error_mesg ) )
	{
		echo '<div id="login-failed"><p>Invalid login name or password. Please note that both are case sensitive.</p></div>';
	}

	if( $this->input->get('logout') )
	{
		echo '<div id="logged-out"><p>You have successfully logged out.</p></div>';
	}

	echo form_open( $login_url, array( 'class' => 'std-form form-horizontal' ) ); 
?>

		<div class="form-group required">
			<label for="login_string" class="control-label col-md-2 required">Login Name</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="login_string" name="login_string" autocomplete="off" maxlength="<?php echo config_item('max_chars_for_user_name'); ?>" required>
			</div>
		</div>
		
		<div class="form-group required">
			<label for="login_pass" class="control-label col-md-2 required">Password</label>
			<div class="col-md-3">
				<input type="password" class="form-control" id="login_pass" name="login_pass" required maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" onfocus="this.removeAttribute('readonly');">
			</div>
		</div>

		<?php
			if( config_item('allow_remember_me') )
			{
		?>

			<div class="form-group">
				<div class="col-xs-offset-2 col-md-3">
					<div class="checkbox">
						<label for="remember_me" class="form_label"><input type="checkbox" id="remember_me" name="remember_me" value="yes"> Remember Me</label>
					</div>
				</div>
			</div>

		<?php
			}
		?>

		<div class="form-group last-content-element">
			<div class="col-md-offset-2 col-md-1">
				<input class="btn btn-primary" name="submit" id="submit_button" value="Login" type="submit">
			</div>
		</div>
</form>

<?php

	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div style="border:1px solid red;">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				</p>
				<p>
					Please use the ' . secure_anchor('examples/recover','Account Recovery') . ' after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
	}
}