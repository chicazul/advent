<div class="container main-content">
	<div id="alert_nosale" class="alert alert-info" role="alert">Commissions are now closed. Thank you for your interest!</div>
	<div class="row">
<?php

$itemsperrow = 4;
$newrow = 1;
$storeURI = '';
if (substr($_SERVER['REQUEST_URI'], -1) != '/') {
	$storeURI = 'store/';
}
foreach ($products as $product): 
	$link = $storeURI . $product->slug; ?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 item">
	<div class="item-content clearfix">
		<?php if(count($product->image->all) > 0) { ?>
		<a href="<?php echo $link; ?>">
		<img class="img-responsive img-rounded center-block" src="<?php echo $product->image->image ?>" alt="<?php echo 'Photo by ' . $product->image->artist . ' - ' . $product->image->description ?>" width="300" />
		</a>
		<?php } //end if ?>
		
		<h2><a href="<?php echo $link; ?>"><?php echo $product->productname; ?></a></h2>
		
		<a class="pull-right" href="<?php echo $link; ?>"><strong>$<?php echo number_format($product->price,0) ?></strong> and up</a>
	</div>
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
</div>