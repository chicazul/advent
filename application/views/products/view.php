<div class="row">
	<div class="col-lg-offset-4 col-md-offset-2 col-md-8 content">
		<?php
		echo '<h2>' . $product->productname . '</h2>';

		if(count($product->image->all) > 0) { ?>
		<img class="center-block thumbnail" src="/advent/img/<?php echo $product->image->image ?>" alt="<?php echo 'Photo by ' . $product->image->artist . ' - ' . $product->image->description ?>" width="300" />

		<?php } //end if ?>

		<h3>Description</h3>
		<div class="content">
			<?php echo $product->description?>
		</div>
		<!-- form example -->
		<h3>Options</h3>
		<form class="col-lg-6 col-md-6" role="form" action="https://chicazul.foxycart.com/cart" method="post" accept-charset="utf-8">
			<input type="hidden" name="name" value="<?php echo $product->productname ?>" />
			<input type="hidden" class="price" name="price" id="price" value="<?php echo $product->price ?>" />
			<?php
			if($product->attribute) {
				echo '<h3 class="blue">Options</h3>';
			}
			foreach ($product->productattribute as $attribute)
			{
				echo "<div class='form-group'>\n";
					echo "<label for='{$attribute->attribute->name}'>{$attribute->attribute->name}</label>\n";
					
					if(count($attribute->option->all) > 0) { 
						echo "<select class='form-control option' name='{$attribute->attribute->name}'>\n";
						$optionfields = '';
						foreach ($attribute->option as $option)
						{
					    	echo "<option value='{$option->surcharge},{$option->optionname}'>{$option->optionname}" . (($option->surcharge > 0) ? " + $" . number_format($option->surcharge,0) : "") . "</option>\n";
					    	$optionsfields .= "<input type='hidden' name='{$attribute->attribute->name}-{$option->optionname}' value='{$option->surcharge}' />\n";
					    }
						echo "</select>\n";
						echo $optionsfields;
					} else 
					{
						echo "<input type='text' name='{$attribute->attribute->name}' class='form-control' placeholder='Enter {$attribute->attribute->name}' />\n";
					}
				echo '</div>'. "\n";
			} ?>
			<input id="submit-product" type="submit" class="btn pull-right" name="Add to Cart" value="Add to Cart" class="submit" />
		</form>
		<div id="subtotal">
			<h2>$<span id="totalprice"><?php echo number_format($product->price,0) ?></span></h2>
		</div>
		<div id="alert_placeholder" class="clearfix"></div>
	</div>
</div>
