<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/userview.css'); ?>">





<div id="userview"></div>




<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_user_by_id_display($user_id)) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/userview.js'); ?>"></script>


