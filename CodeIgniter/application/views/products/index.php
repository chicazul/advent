<div class="row">
	<?php foreach ($products as $product_item): ?>

	<div class="col-lg-3 col-sm-4 col-6 item">
			<h2 class="green"><?php echo $product_item['productname'] ?></h2>
			<img src="<?php echo $product_item['thumbsrc'] ?>" />
			<p><?php echo $product_item['description'] ?></p>
			<p><a href="products/<?php echo $product_item['slug'] ?>">View</a></p>
	</div>
	<?php endforeach ?>
</div>