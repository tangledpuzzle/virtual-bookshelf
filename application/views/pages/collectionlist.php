<?php 
/**
 * A page listing the collections ("shelves") of a single user.
 * This is a view that is to be added at the bottom of userview pages and must not be used as a "standalone" page.
 * @author Jose
 */

// disallow direct access.
if ($this->uri->uri_string()==="collectionlist"){
	show_404();
}
else
{
?>
<script type="text/javascript" src="../../../lib/sorttable.js"></script>
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../js/userscollections.js"></script>

<hr>

<div id="userscollections"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("collections_json", JSON.stringify(<?php echo $collections ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var collections_json = JSON.stringify(' . $collections . ');' ;?>
	}
	createUsersCollections();
</script>
<?php } ?>