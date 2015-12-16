<?php
if (isset($error_message))
{
	echo '<div class="error-msg-box">';
	if (isset($header))
	{
		echo '<h3 class="first-content-element">' . $header . '</h3>';
		echo '<p class="last-content-element">' . $error_message . '</p>';
	}
	else
	{
		echo '<p class="first-content-element last-content-element">' . $error_message . '</p>';
	}
	echo '</div>';
}
else
{
	show_404();
}
?>