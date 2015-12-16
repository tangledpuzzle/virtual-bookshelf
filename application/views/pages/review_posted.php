<?php 
// disallow direct access.
if ($this->uri->uri_string()==="review_posted"){
	show_404();
}
else{ ?>
<h3 class="first-content-element">Review posted!</h3>
<?php }?>