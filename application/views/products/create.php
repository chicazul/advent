<h2>Create a product</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('products/create') ?>
	<div class="form-group">
		<input type="text" class="form-control" name="productname" id="productname" placeholder="Product Name" value="<?php echo $product->productname ?>">
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $product->price ?>">
	</div>


	<div class="form-group">
		<textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo $product->description ?></textarea>
	</div>

	<div class="input-group">
		<input type="text" class="form-control" name="attribute" id="attribute" placeholder="Add an attribute" value="">
	      <span class="input-group-btn">
	        <button class="btn btn-default" id="add-attribute" type="button">+</button>
	      </span>
	</div>

	<input class="btn btn-default" type="submit" name="submit" value="Save" />
</form>