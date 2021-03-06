<h2><?php echo $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open($url) ?>

	<div class="form-group">
		<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $post->title ?>">
	</div>

	<div class="form-group">
		<label for="blurb">Blurb</label>
		<textarea class="form-control" name="blurb" id="blurb"><?php echo $post->blurb ?></textarea>
	</div>

	<div class="form-group">
		<label for="content">Content</label>
		<textarea class="form-control" name="content" id="content"><?php echo $post->content ?></textarea>
	</div>

	<?php foreach ($groups as $g): 
			$checked = "";

			if($g->id == $post->group->id)
			{
				$checked = " checked";
			}
	?>
	<label class="radio-inline">
  		<?php echo '<input type="radio" name="group" id="' . $g->name . '" value="'. $g->id .'"'. $checked .'>' . $g->name ?>
	</label>
	<?php endforeach ?>
	<input class="btn btn-primary" type="submit" name="submit" value="Save" />
</form>