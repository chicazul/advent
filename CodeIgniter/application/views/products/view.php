<div class="row">
	<div class="col-lg-offset-4 item">
		<?php
		echo '<h2 class="blue">' . $product->productname . '</h2>';
		echo $product->description;
		?>
		<!-- form example -->
		<form class="clearfix" role="form" action="https://chicazul.foxycart.com/cart" method="post" accept-charset="utf-8">
			<input type="hidden" name="name" value="<?php echo $product->productname ?>" />
			<input type="hidden" name="price" value="<?php echo $product->price ?>" />
			<?php
			if($product->attribute) {
				echo '<h3 class="blue">Options</h3>';
			}
			foreach ($product->attribute as $attribute) : ?>
				<div class="form-group col-lg-4 col-md-6">
					<label for="<?php echo $attribute->attributename ?>"><?php echo $attribute->attributename ?></label>
					<select class="form-control" name="<?php echo $attribute->attributename ?>">

						<?php foreach ($attribute->option as $option) : ?>
					    	<option value="<?php echo $option->optionname ?>"><?php echo $option->optionname ?></option>
					    <?php endforeach ?>
					</select>
				</div>
			<?php endforeach ?>
			<input type="submit" class="btn pull-right" name="Add to Cart" value="Add to Cart" class="submit" />
		</form>
		<div id="alert_placeholder"></div>
	</div>
</div>
