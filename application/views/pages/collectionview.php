<link rel="stylesheet" type="text/css" href="../../../css/collectionview.css">
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/collectionview.js"></script>

<div id="collectionview"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("collection_json", JSON.stringify(<?php echo $collection ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var collection_json = JSON.stringify(' . $collection . ');' ;?>
	}
	createCollectionView();
</script>