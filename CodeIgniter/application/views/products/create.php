<h2>Create a product</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('products/create') ?>
	<label for="productname">Name</label>
	<input type="input" name="productname" /><br />

	<label for="price">Price</label>
	<input type="input" name="price" /><br />

	<label for="description">Description</label>
	<textarea name="description"></textarea><br />

	<label for="thumbsrc">Thumbnail link</label>
	<input type="input" name="thumbsrc"><br />

	<input type="submit" name="submit" value="Save" />
</form>