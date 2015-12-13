<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reviewlist.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/reviewlist.js'); ?>"></script>
<hr>
<h3 class="first-content-element">Reviews</h3>
<div id="reviewlist"></div>

<script type="text/javascript">
	// Check for sessionStorage availability.
	if (typeof(sessionStorage) !='undefined')
	{
		sessionStorage.setItem('reviews_json', JSON.stringify(<?php echo $reviews ;?>));   
		if (sessionStorage.getItem('reviews_json') == null)
		{
			// Somehow the session storage value was not set, fall back to old fashioned way.
			<?php echo 'var reviews_json = ' . $reviews . ';' ;?>
		}
		// Else: Session storage was set.
	}
	else
	{
		// Do it the old fashioned way.
		<?php echo 'var reviews_json = ' . $reviews . ';' ;?>
	}
	createReviewList();
</script>