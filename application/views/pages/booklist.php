<?php
/**
 * A page listing books in the database.
 * @author Jose
 * @package view
 * @namespace view
 */
// phpDocumentor has a bug that requires you to use namespaces for it to recognize PHP pages that have no PHP "nodes".
namespace view;
?>
<link rel="stylesheet" type="text/css" href="../../../css/booklist.css">
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/booklist.js"></script>
<?php 
	// TODO: This could be split into a separate function somehow.
	if(isset($success_message))
	{
		echo '<div class="success-msg-box"><h4>Success</h4>' . $success_message . '</div>';
	}
	else if(isset($error_message))
	{
		echo '<div class="error-msg-box"><h4>Error</h4>' . $success_message . '</div>';
	}
?>
<h1 id="first-content-element">Book List</h1>

<div id="productlist" class="list-group"></div>

<script type="text/javascript">
	// TODO: This could also be made into a generic function.
	if (!putIntoSessionStorage("books_json", JSON.stringify(<?php echo $books ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var books_json = JSON.stringify(' . $books . ');' ;?>
	}
	createBookList();
</script>