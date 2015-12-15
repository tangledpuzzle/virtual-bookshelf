<link rel="stylesheet" type="text/css" href="../../../css/bookview.css">
<link rel="stylesheet" type="text/css" href="../../../css/bsdev.css">
<script type="text/javascript" src="../../../js/bookview.js"></script>

<div id="productview"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("book_json", JSON.stringify(<?php echo $book; ?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var book_json = JSON.stringify(' . $book . ');' ;?>
	}
	
	createBookView(<?php
					// In an attempt to improve security the user id is echoed here instead of being stored in sessionStorage.
					echo (int) $logged_in_user_id;
				   ?>);
</script>
