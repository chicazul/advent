<div class="row">
<?php 

$itemsperrow = 4;
$newrow = 1;
foreach ($products as $product): ?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 thumbnail">


	<?php if(count($product->image->all) > 0) { ?>
	<a href="<?php echo $product->slug; ?>">
	<img class="img-responsive img-rounded center-block" src="<?php echo $product->image->image ?>" alt="<?php echo 'Photo by ' . $product->image->artist . ' - ' . $product->image->description ?>" width="300" />
	</a>
	<?php } //end if ?>
	<a href="<?php echo $product->slug; ?>">
		<h2><?php echo $product->productname; ?></h2>
	</a>
	<!--<p><?php echo $product->description; ?></p>-->

	<a class="pull-right" href="<?php echo $product->slug; ?>"><strong>$<?php echo number_format($product->price,0) ?></strong> and up</a>
</div>
<?php 
	if($newrow % $itemsperrow == 0)
	{
		echo '</div>';
		echo '<div class="row">';
	}
	$newrow += 1;
endforeach ?>
</a>
</div>