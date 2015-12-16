<link rel="stylesheet" type="text/css" href="../../../css/collectionview.css">
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/collectionview.js"></script>
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
<div id="collectionview"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("collection_json", JSON.stringify(<?php echo $collection ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var collection_json = JSON.stringify(' . $collection . ');' ;?>
	}
	createCollectionView();
</script>