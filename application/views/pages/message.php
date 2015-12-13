<?php 
if (isset($header))
{
	echo '<h3 class="first-content-element">' . $header . '</h3>';
	echo '<p class="last-content-element">' . $message . '</p>';
}
else
{
	echo '<p class="first-content-element last-content-element">' . $message . '</p>';
}
?>