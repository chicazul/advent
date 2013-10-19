<div class="row">
	<?php foreach ($posts as $post_item): ?>

	<div class="col-lg-3 col-sm-4 col-6 item">
			<h2 class="pink"><?php echo $post_item['title'] ?></h2>
			<p></php echo $post_item['blurb'] ?></p>
			<p><a href="posts/<?php echo $post_item['slug'] ?>">View</a></p>
	</div>
	<?php endforeach ?>
</div>