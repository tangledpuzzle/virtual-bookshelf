<?php 
// disallow direct access.
if ($this->uri->uri_string()==="comment"){
	show_404();
}
else{ ?>
<link rel="stylesheet" type="text/css" href="../../../css/comment.css" >
	

	
	 <form accept-charset="UTF-8" class="form col-md-6" id="write_comment" role="form" action="" method="POST">
  

	
	<div class="form-group">
			
				<textarea class="form-control" id="inputProductCons" name="comment-text"  required cols="75" rows="5" placeholder="Your comment here"></textarea>
			
		</div>

		<div class=" last-content-element">
			
				<input  class="btn btn-primary pull-right" name="submit" value="Post Comment" type="submit">
			
		</div>
</form> 
<?php } ?>