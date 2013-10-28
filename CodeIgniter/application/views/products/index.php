<div class="row">
<?php 

$itemsperrow = 4;
$newrow = 1;
foreach ($products as $product_item): ?>
<div class="col-lg-3 col-sm-3 thumbnail">
	<h2 class="green"><?php echo $product_item->productname; ?></h2>
	<img src="<?php echo $product_item->thumbnailsrc; ?>" />
	<p><?php echo $product_item->description; ?></p>
	<p><a href="<?php echo $product_item->slug; ?>">View</a></p>
</div>
<?php 

	if($newrow % $itemsperrow == 0)
	{
			echo '</div>';
			echo '<div class="row">';
		$newrow = 1;
	}
endforeach ?>
</div>