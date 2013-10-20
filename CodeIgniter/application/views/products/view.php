<?php
echo '<h2>' . $product_item['productname'] . '</h2>';
echo $product_item['description'];
?>
<!-- form example -->
<form action="https://chicazul.foxycart.com/cart" method="post" accept-charset="utf-8">
<input type="hidden" name="name" value="<?php echo $product_item['productname'] ?>" />
<input type="hidden" name="price" value="<?php echo $product_item['price'] ?>" />
<label class="label_left">Size</label>
<select name="size">
    <option value="small">Small</option>
    <option value="medium">Medium</option>
    <option value="large">Large</option>
</select>
<input type="submit" name="Add to Cart" value="Add to Cart" class="submit" />
</form>