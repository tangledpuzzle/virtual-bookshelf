<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/productview.css'); ?>">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bsdev.css'); ?>">




<div id="productview"></div>




<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_product_by_id(1)) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/productview.js'); ?>"></script>


<button type="button" class="btn-lg btn-primary pull-right">Add to collection</button>
<button type="button" class="btn-lg btn-success pull-right">Review</button>