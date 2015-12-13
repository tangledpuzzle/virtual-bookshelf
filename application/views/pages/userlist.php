<h1 class="first-content-element">User List</h1>

<div id="userlist" ></div>

<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_users_display()) . ';</script>' ;?>
<script type="text/javascript" src="../../../js/userlist.js"></script>
<script type="text/javascript" src="../../../lib/sorttable.js"></script>