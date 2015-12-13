<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bookview.css'); ?>">





<div id="productview"></div>




<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_product_by_id_display($productid)) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/bookview.js'); ?>"></script>


