<div class="row">
	<div class="col-lg-offset-4 item">
		<?php
		echo '<h2 class="blue">' . $product->productname . '</h2>';

		if(count($product->image->all) > 0) { ?>
		<p class="container">
		<img src="/advent/img/<?php echo $product->image->image ?>" alt="<?php echo 'Photo by ' . $product->image->artist . ' - ' . $product->image->description ?>" width="300" />
		</p>
		<?php } //end if

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
			foreach ($product->productattribute as $attribute) : ?>
				<div class="form-group col-lg-4 col-md-4 col-sm-4">
					<label for="<?php echo $attribute->attribute->name ?>"><?php echo $attribute->attribute->name ?></label>
					
					<?php if(count($attribute->option->all) > 0) { ?>
					<select class="form-control" name="<?php echo $attribute->attribute->name ?>">

						<?php foreach ($attribute->option as $option) : ?>
					    	<option value="<?php echo $option->optionname ?>"><?php echo $option->optionname . (($option->surcharge > 0) ? " + $" . number_format($option->surcharge,0) : "") ?></option>
					    <?php endforeach ?>
					</select>
					<?php } else { ?>
					<input type="text" name="<?php echo $attribute->attribute->name ?>" class="form-control" placeholder="Enter <?php echo $attribute->attribute->name ?>" />
					<?php } ?>
				</div>
			<?php endforeach ?>
			<input type="submit" class="btn pull-right" name="Add to Cart" value="Add to Cart" class="submit" />
		</form>
		<div id="alert_placeholder"></div>
	</div>
</div>
