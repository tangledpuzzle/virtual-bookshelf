<link rel="stylesheet" type="text/css" href="../../../css/userview.css">
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/userview.js"></script>

<div id="userview"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("user_json", JSON.stringify(<?php echo $user ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var user_json = JSON.stringify(' . $user . ');' ;?>
	}
	createUserView();
</script>