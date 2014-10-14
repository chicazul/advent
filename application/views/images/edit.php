<h2><?php echo $title ?></h2>

<?php echo validation_errors(); 
?>

<?php echo form_open($url) ?>

	<img class='center-block thumbnail' src='<?php echo $image->image ?>' alt='Photo by <?php echo $image->artist ?> - <?php echo $image->description ?>' width='300' />

	<div class="form-group">
		<input type="text" class="form-control" name="image" id="image" placeholder="Image URI" value="<?php echo $image->image ?>" disabled />
		<input type="hidden" name="image" value="<?php echo $image->image ?>" />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="artist" id="artist" placeholder="Artist" value="<?php echo $image->artist ?>" />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="source" id="source" placeholder="Source" value="<?php echo $image->source ?>" />
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $image->description ?>" />
	</div>

	<input class="btn btn-primary" type="submit" name="submit" value="Save" />
</form>