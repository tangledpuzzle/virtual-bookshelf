<script type="text/javascript" src="../../../lib/sorttable.js"></script>
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/usersreviews.js"></script>

<hr>

<div id="usersreviews"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("reviews_json", JSON.stringify(<?php echo $reviews ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var reviews_json = JSON.stringify(' . $reviews . ');' ;?>
	}
	createUsersReviews();
</script>