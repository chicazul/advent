<div class="row">
	<div class="col-lg-offset-4 col-md-offset-2 col-md-8 content">
		<h2><?php echo $post->title ?></h2>
		<div name="content">
		<?php echo eval("?>".$post->content."<?"); ?>
		</div>
	</div>
</div>