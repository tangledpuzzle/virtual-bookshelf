
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/userview.js"></script>
<?php 
	if(isset($success_message))
	{
		echo '<div class="success-msg-box"><h4>Success</h4>' . $success_message . '</div>';
	}
	else if(isset($error_message))
	{
		echo '<div class="error-msg-box"><h4>Error</h4>' . $success_message . '</div>';
	}
?>
<div id="userview"></div>
<script type="text/javascript">
	if (!putIntoSessionStorage("user_json", JSON.stringify(<?php echo $user ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var user_json = JSON.stringify(' . $user . ');' ;?>
	}
	createUserView(<?php
					// In an attempt to improve security the user id is echoed here instead of being stored in sessionStorage.
					echo (int) $logged_in_user_id;
				   ?>, "<?php echo $source_page ?>");
</script>