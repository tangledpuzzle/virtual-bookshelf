<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/commentlist.css'); ?>">





<div id="commentlist"></div>




<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_user_comments_display(1)) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/commentlist.js'); ?>"></script>


