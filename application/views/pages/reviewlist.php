<script type="text/javascript" src="../../../lib/sorttable.js"></script>
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/reviewlist.js"></script>

<hr>
<h3 class="first-content-element">Reviews</h3>
<div id="reviewlist"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("reviews_json", JSON.stringify(<?php echo $reviews ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var reviews_json = JSON.stringify(' . $reviews . ');' ;?>
	}
	createReviewList();
</script>