<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/productview.css'); ?>">





<div id="productview"></div>




<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_product_by_id_display(1)) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/productview.js'); ?>"></script>


