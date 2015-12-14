<link rel="stylesheet" type="text/css" href="../../../css/bookview.css">
<link rel="stylesheet" type="text/css" href="../../../css/bsdev.css">
<script type="text/javascript" src="../../../js/bookview.js"></script>

<div class="row">
	<div class="col-md-12">
			
		<form>
			<div class="form-group">
				<div class="form-group col-md-2 inline-form-col required">
					<input class="form-control required" placeholder="New or Existing Shelf" type="text">
				</div>
				<div class="form-group col-md-2 inline-form-col">
					<select class="form-control"><option value="0">0</option><option value="1">1</option><option value="2">2</option></select>
				</div>
				 <button type="submit" class="btn btn-default">Add to Shelf</button>
			</div>
		</form>
	</div>

</div>
<div id="productview"></div>

<script type="text/javascript">
	if (!putIntoSessionStorage("book_json", JSON.stringify(<?php echo $book ;?>)))
	{
		// Do it the old fashioned way.
		<?php echo 'var book_json = JSON.stringify(' . $book . ');' ;?>
	}
	createBookView();
</script>
