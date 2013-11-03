<div class="row">
	<div class="col-lg-offset-4 col-md-offset-2 col-md-8 content">
		<?php
		echo '<h2>' . $product->productname . '</h2>';

		if(count($product->image->all) > 0) 
		{
		echo "<img class='center-block thumbnail' src='/advent/img/{$product->image->image}' alt='Photo by {$product->image->artist} - {$product->image->description}' width='300' />\n";

		echo "<h3>Description</h3>\n";
		} ?>

		<div class="content">
			<?php echo $product->description?>
		</div>
		<!-- form example -->
		
		<div id="subtotal" class="text-center col-lg-6 col-md-6 clearfix <?php echo ($product->price <= 0 ? 'hidden' : '') ?>" >
			<h2>$<span id="totalprice"><?php echo number_format($product->price,0) ?></span></h2>
		</div>
		<?php 
			if(count($product->productattribute->all) > 0)  
			{
				echo "<h3>Options</h3>\n";
			}
		?>
		<form class="col-lg-6 col-md-6" role="form" action="https://chicazul.foxycart.com/cart" method="post" accept-charset="utf-8">
			<input type="hidden" name="name" value="<?php echo $product->productname ?>" />
			<input type="hidden" class="price" name="price" id="price" value="<?php echo $product->price ?>" />
			<input type="hidden" name="category" value="<?php echo $product->shippingcategory ?>" />
			<?php
			foreach ($product->productattribute as $attribute)
			{
				echo "<div class='form-group'>\n";
					echo "<label for='{$attribute->attribute->name}'>{$attribute->attribute->name}</label>\n";
					

					if(count($attribute->option->all) > 0) { 
						echo "<select class='form-control option' name='{$attribute->attribute->name}'>\n";
						$optionsfields = '';
						foreach ($attribute->option as $option)
						{
					    	echo "<option value='{$option->optionname}'>{$option->optionname}" . (($option->surcharge > 0) ? " + $" . number_format($option->surcharge,0) : "") . "</option>\n";
					    	$optionsfields .= "<input type='hidden' id='". str_replace(' ','', $attribute->attribute->name . '-' .$option->optionname) ."' value='{$option->surcharge}' />\n";
					    }
						echo "</select>\n";
						echo $optionsfields;
					} else 
					{
						$placeholder = $attribute->attribute->name;
						if($placeholder == 'Donation amount')
						{
							$attribute->attribute->name = 'price';
						}
						echo "<input type='text' name='{$attribute->attribute->name}' class='form-control' placeholder='Enter {$placeholder}' />\n";
					}
				echo '</div>'. "\n";
			} ?>
			<a href="https://chicazul.foxycart.com/cart?cart=view" class="btn btn-default pull-right" role="button" name="View Cart">View Cart</a>
			<input id="submit-product" type="submit" class="btn pull-right" name="Add to Cart" value="Add to Cart" class="submit" />
		</form>
	</div>
</div>

<div class="row">
	<div id="alert_placeholder" class="clearfix"></div>
</div>
