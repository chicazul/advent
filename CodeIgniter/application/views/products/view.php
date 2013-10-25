<div class="row">
	<div class="col-lg-offset-4 item">
		<?php
		echo '<h2 class="green">' . $product->productname . '</h2>';
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
		<div id="alert_placeholder"></div>
	</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="CartLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Cart</h4>
        </div>
        <div class="modal-body">
          <iframe id="cartFrame" src="https://chicazul.foxycart.com/cart" width="100%" height="500px" seamless></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
