<?php 
// 
$itemsperrow = 4;
$newrow = $itemsperrow;
foreach ($products as $product_item): 
	if($newrow % $itemsperrow == 0)
	{	
		echo '<div class="row">';
	}
?>
<div class="col-lg-3 col-sm-4 col-6 thumbnail">
	<h2 class="green"><?php echo $product_item->productname; ?></h2>
	<img src="<?php echo $product_item->thumbnailsrc; ?>" />
	<p><?php echo $product_item->description; ?></p>
	<p><a href="<?php echo $product_item->slug; ?>">View</a></p>
</div>
<?php 

	if($newrow % $itemsperrow == 0)
	{
		echo '</div>';
		$newrow = 1;
	}
endforeach ?>