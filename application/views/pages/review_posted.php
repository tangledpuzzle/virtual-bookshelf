<?php
/**
 * Message page for a successful review.
 * TODO: Change controller to use the generic message page or a success message.
 * @author Jose
 */

// disallow direct access.
if ($this->uri->uri_string()==="review_posted"){
	show_404();
}
else
{
?>
<h3 class="first-content-element">Review posted!</h3>
<?php
}
?>