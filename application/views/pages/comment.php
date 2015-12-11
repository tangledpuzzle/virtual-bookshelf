<link rel="stylesheet" type="text/css" href="../../../css/comment.css" >


	<hr>

	
	 <form accept-charset="UTF-8" class="form col-md-6" id="write_comment" role="form" action="<?php echo base_url(); ?>index.php/comment" method="POST">
  
<?php echo $comment_type; ?>
	
	<div class="form-group">
			
				<textarea class="form-control" id="inputProductCons" name="cons" cols="75" rows="5" placeholder="Your comment here"></textarea>
			
		</div>

		<div class=" last-content-element">
			
				<input class="btn btn-primary pull-right" name="submit" value="Post Comment" type="submit">
			
		</div>
</form> 
