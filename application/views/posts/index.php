<div class="row">
<?php 
// 
$itemsperrow = 3;
$newrow = 1;
foreach ($posts as $post): 
?>
<div class="col-lg-4 col-md-4 col-sm-4 thumbnail">
	<a href="posts/<?php echo $post->slug; ?>"><h2><?php echo $post->title; ?></h2></a>
	<p><?php echo $post->blurb; ?></p>
	<p class="pull-right"><a href="posts/<?php echo $post->slug; ?>">Read More</a></p>
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