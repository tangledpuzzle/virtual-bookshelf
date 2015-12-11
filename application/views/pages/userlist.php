<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/userlist.css'); ?>">

<h1 class="first-content-element">User List</h1>

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bsdev.css'); ?>">-->

<div id="userlist" ></div>

<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_users_display()) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/userlist.js'); ?>"></script>