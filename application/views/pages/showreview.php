<link rel="stylesheet" type="text/css" href="../../../css/review.css">

	<h1 class="first-content-element">Book Review of <a href="<?php echo "../bookview/" . $review["ProductID"]; ?>";><?php echo $review["Name"]; ?></a></h1>
	
	<div class="row">
		<div class="col-md-12">
			<p id="review-author">Written by <a href="<?php echo "../userview/" . $review["user_id"]; ?>";><?php echo $review["ScreenName"]; ?></a> in <?php echo $review["ReviewDate"]; ?></p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div id="star-div">
			<?php
				$stars = $review["Rating"];
				$i = 0;
				for ($i; $i < $stars; $i++)
				{
					echo '<span class="glyphicon glyphicon-star star"></span>';
				}
				for ($i; $i < 5; $i++)
				{
					echo '<span class="glyphicon glyphicon-star-empty star"></span>';
				}
			?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<p class="review"><?php echo $review["Text"]; ?></p>
		</div>
	</div>
	
	<?php 
		$pros = isset($review["Pros"]);
		$cons = isset($review["Cons"]);
		if ($pros || $cons)
		{
	?>
		<div class="row vdivide last-content-element">
			
		<?php 
			if ($pros)
			{
		?>
				<div class="col-md-5 col-md-offset-1 pros">
					<h2>Pros</h2>
					<p class="review"><?php echo $review["Pros"]; ?></p>
				</div>
		<?php 
			}
		?>

		<?php 
			if ($cons)
			{
				if (!$pros)
				{
					echo '<div class="col-md-5 col-md-offset-1 cons">';
				}
				else
				{
					echo '<div class="col-md-5 cons">';
				}
		?>
				<h2>Cons</h2>
				<p class="review"><?php echo $review["Cons"]; ?></p>
			</div>
		<?php
			}
		?>
		</div>
	<?php
		}
	?>
</div>