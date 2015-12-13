<link rel="stylesheet" type="text/css" href="../../../css/bookview.css">

<div id="productview"></div>

<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_product_by_id_display($productid)) . ';</script>' ;?>
<script type="text/javascript" src="../../../js/bookview.js"></script>