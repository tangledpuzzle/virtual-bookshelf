<link rel="stylesheet" type="text/css" href="../../../css/review.css" >
	<legend>Write a Book Review</legend>
	<form accept-charset="UTF-8" class="form-horizontal" id="write_review" role="form" action="<?php echo base_url(); ?>index.php/review" method="POST">

		<input type="hidden" name="user_id" value='<?php echo $user_id; ?>' />
		
		<div class="form-group required">
			<label for="inputProductID" class="control-label col-md-1 required">Book ID</label>
			<div class="col-md-2">
				<input type="number" value='<?php echo $product_id ?>' class="form-control" id="inputProductID" name="product_id" min="1" placeholder="ID" required="true" disabled="true">
			</div>
		</div>

		<div class="form-group required">
			<label class="col-md-1 required control-label">Rating</label>
			<div class="col-md-3">
				<label class="radio-inline" for="inputRating">
					<input type="radio" id="inputRating" name="rating" value=1 required="true">1
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=2 required="true">2
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=3 required="true">3
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=4 required="true">4
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=5 required="true">5
				</label>
			</div>
		</div>

		<div class="form-group required">
			<label for="inputProductReview" class="control-label col-md-1 required">Review</label>
			<div class="col-md-5">
				<textarea class="form-control" id="inputProductReview" name="review" rows="15" required="true"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="inputProductPros" class="control-label col-md-1 required">Pros</label>
			<div class="col-md-5">
				<textarea class="form-control" id="inputProductPros" name="pros" rows="5"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="inputProductCons" class="control-label col-md-1 required">Cons</label>
			<div class="col-md-5">
				<textarea class="form-control" id="inputProductCons" name="cons" rows="5"></textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-offset-1 col-md-1">
				<input class="btn btn-primary" name="submit" value="Post Review" type="submit">
			</div>
		</div>
	</form>