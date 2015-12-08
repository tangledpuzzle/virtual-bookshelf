<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/productlist.css'); ?>">

<h1>Book List</h1>

<div id="productlist"></div>

<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_products_display()) . ';</script>' ;?>
<script type="text/javascript" src="<?php echo base_url('js/productlist.js'); ?>"></script>