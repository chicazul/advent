<?php 
// 
$itemsperrow = 3;
$newrow = $itemsperrow;
foreach ($posts as $post_item): 
	if($newrow % $itemsperrow == 0)
	{	
		echo '<div class="row">';
	}
?>
<div class="col-lg-4 col-sm-4 thumbnail">
	<h2 class="blue"><?php echo $post_item->title; ?></h2>
	<p><?php echo $post_item->blurb; ?></p>
	<p><a href="<?php echo $post_item->slug; ?>">View</a></p>
</div>
<?php 

	if($newrow % $itemsperrow == 0)
	{
		echo '</div>';
		$newrow = 1;
	}
endforeach ?>