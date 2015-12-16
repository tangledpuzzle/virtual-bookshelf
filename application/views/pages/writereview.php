<?php 
// disallow direct access.
if ($this->uri->uri_string()==="writereview"){
	show_404();
}
else
{
	if(isset($success_message))
	{
		echo '<div class="success-msg-box"><h4>Success</h4>' . $success_message . '</div>';
	}
	else if(isset($error_message))
	{
		echo '<div class="error-msg-box"><h4>Error</h4>' . $success_message . '</div>';
	}
?>
<link rel="stylesheet" type="text/css" href="../../../css/review.css" >

	<h1 class="first-content-element">Write a Book Review</h1>
	<form accept-charset="UTF-8" class="form-horizontal" id="write_review" action="<?php echo base_url() . 'index.php/writereview/' . $productid ?>" method="POST">
		
		<div class="form-group required">
			<label class="control-label col-md-1">Book ID</label>
			<div class="col-md-2">
				<div class="label-left-aligned"><?php echo $productid ?></div>
			</div>
		</div>

		<div class="form-group required">
			<label class="col-md-1 required control-label">Rating</label>
			<div class="col-md-3">
				<label class="radio-inline" for="inputRating">
					<input type="radio" id="inputRating" name="rating" value=1 required>1
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=2 required>2
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=3 required>3
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=4 required>4
				</label>
				<label class="radio-inline">
					<input type="radio" id="inputRating" name="rating" value=5 required>5
				</label>
			</div>
		</div>

		<div class="form-group required">
			<label for="inputProductReview" class="control-label col-md-1 required">Review</label>
			<div class="col-md-5">
				<textarea class="form-control fixed-horizontal-size" id="inputProductReview" name="review" rows="15" required></textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="inputProductPros" class="control-label col-md-1 required">Pros</label>
			<div class="col-md-5">
				<textarea class="form-control fixed-horizontal-size" id="inputProductPros" name="pros" rows="5"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="inputProductCons" class="control-label col-md-1 required">Cons</label>
			<div class="col-md-5">
				<textarea class="form-control fixed-horizontal-size" id="inputProductCons" name="cons" rows="5"></textarea>
			</div>
		</div>

		<div class="form-group  last-content-element">
			<div class="col-md-offset-1 col-md-1">
				<input class="btn btn-primary" name="submit" value="Post Review" type="submit">
			</div>
		</div>
	</form>
<?php }?>