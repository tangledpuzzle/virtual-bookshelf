<script type="text/javascript" src="../../../js/userlist.js"></script>
<script type="text/javascript" src="../../../js/r2p.js"></script>
<script type="text/javascript" src="../../../lib/sorttable.js"></script>

<h1 class="first-content-element">User List</h1>

<div id="userlist"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("users_json", JSON.stringify(<?php echo $users ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var users_json = JSON.stringify(' . $users . ');' ;?>
	}
	createUserList();
</script>