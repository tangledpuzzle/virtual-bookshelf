<link rel="stylesheet" type="text/css" href="../../../css/commentlist.css">
<link rel="stylesheet" type="text/css" href="../../../css/bsdev.css">

<hr>

<div id="commentlist"></div>

<script type="text/javascript" src="../../../js/commentlist.js"></script>
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../lib/sorttable.js"></script>



<script type="text/javascript">
	if (!putIntoSessionStorage("comments_json", JSON.stringify(<?php echo $comments ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var comments_json = JSON.stringify(' . $comments . ');' ;?>
	}
	createCommentList();
</script>