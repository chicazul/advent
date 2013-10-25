<?php
echo '<h2>' . $product->productname . '</h2>';
echo $product->description;
?>
<!-- form example -->
<form action="https://chicazul.foxycart.com/cart" method="post" accept-charset="utf-8">
<input type="hidden" name="name" value="<?php echo $product->productname ?>" />
<input type="hidden" name="price" value="<?php echo $product->price ?>" />
<label class="label_left">Size</label>
<select name="size">
    <option value="small">Small</option>
    <option value="medium">Medium</option>
    <option value="large">Large</option>
</select>
<input type="submit" name="Add to Cart" value="Add to Cart" class="submit" />
</form>