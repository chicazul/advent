<div class="row">
<?php 

$itemsperrow = 4;
$newrow = 1;
foreach ($products as $product): ?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 thumbnail">
	<?php if(count($product->image->all) > 0) { ?>
	<img class="img-responsive img-rounded" src="/advent/img/<?php echo $product->image->image ?>" alt="<?php echo 'Photo by ' . $product->image->artist . ' - ' . $product->image->description ?>" width="300" />
	<?php } //end if ?>
	<h2 class="text-primary"><?php echo $product->productname; ?></h2>
	<p><?php echo $product->description; ?></p>
	<div class="panel-footer"><span class="blue strong">$<?php echo number_format($product->price,0) ?> and up</strong> <a class="pull-right" href="<?php echo $product->slug; ?>">View</a></div>
</div>
<?php 
	if($newrow % $itemsperrow == 0)
	{
		echo '</div>';
		echo '<div class="row">';
	}
	$newrow += 1;
endforeach ?>
</div>