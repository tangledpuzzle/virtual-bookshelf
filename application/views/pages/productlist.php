

	<div id="productlist">
	
	</div>
	<?php echo '<script type="text/javascript"> var json = ' . <?php echo $this->r2pdb_model->get_rows_by_field_display('{"table_name":"products"}'); ?> . ';' ;?>
	<?php $data = $this->r2pdb_model->get_rows_by_field_display($array); ?>		
	<script type="text/javascript" src="<?php echo base_url('js/productlist.js'); ?>"></script>


