<link rel="stylesheet" type="text/css" href="../../../css/booklist.css">

<h1>Book List</h1>

<div id="productlist" class="list-group"></div>

<?php echo '<script type="text/javascript"> var json = ' . json_encode($this->r2pdb_model->get_products_display()) . ';</script>' ;?>
<script type="text/javascript" src="../../../js/booklist.js"></script>