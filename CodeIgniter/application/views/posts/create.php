<h2>Create a post</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('posts/create') ?>
	<label for="title">Title</label>
	<input type="input" name="title" /><br />

	<label for="author">Author</label>
	<input type="input" name="author" /><br />

	<label for="blurb">Blurb</label>
	<textarea name="blurb"></textarea><br />

	<label for="content">Content</label>
	<textarea name="content"></textarea><br />

	<input type="submit" name="submit" value="Save" />
</form>