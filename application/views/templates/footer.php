</div>
<!--<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  ...
</nav>
<!-- Shopping Cart -->
  <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="CartLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Cart</h4>
        </div>
        <div class="modal-body">
          <iframe id="cartFrame" src="" width="100%" height="400px" seamless></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://localhost/advent/js/bootstrap.js"></script>
<!-- FoxyCart files -->
<script src="//cdn.foxycart.com/chicazul/foxycart.js?ver=2" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
jQuery(document).ready(function() 
{
	// Restart the process event collection object
	fcc.events.cart.process = new FC.client.event();
	 
	// Define the new process event
	fcc.events.cart.process.add(function(e)
	{
	    var href = '';
	    if (e.tagName == 'A') {
	      href = e.href;
	    } else if (e.tagName == 'FORM') {
	      href = 'https://'+storedomain+'/cart?'+jQuery(e).serialize();
	    }
	    if (href.match("cart=(checkout|updateinfo)") || href.match("redirect=")) {
			return true;
	    } else if (href.match("cart=view")) {
	    	// view cart
			$("#cartFrame").attr("src", href);
			$('#cart').modal('show');
			return false;
	    } else {
	    	// Add item to cart
	    	showalert('Adding to cart...', 'alert-warning');

		    $.getJSON(href + '&output=json&callback=?', function(data)
		    {
		        // Automatically update JSON and minicart helper objects
		        fcc.cart_update();
		      	showalert(e.elements['name'].value + ' has been added to cart.', 'alert-success');
		    });
		    return false;
	    }

	});

	// When cart closed, update JSON and minicart helper objects
	$('#cart').on('hidden.bs.modal', function () 
	{
		fcc.cart_update();
	});

	// Product options can change product price. Make sure to update it
	$('.option').change(function() {
		var totalPrice = parseInt($("#price").val());
		$("select option:selected").each(function(index) {
			//this ugly contraption gets the numeric value of the tag with an id equal to:
			// the select name (minus spaces) -dash- selected option value (minus spaces)
			totalPrice += parseInt($("#"+$(this).parent().attr('name').replace(/\s+/g,'')+'-'+$(this).val().replace(/\s+/g,'')).val());
		});
		$('#totalprice').text(totalPrice);
	});

	// Submit the total price, including custom options
	$('#submit-product').click(function()
	{
		$('#price').val($('#totalprice').text());
	});

	// Display a temporary alert
	function showalert(message, alerttype, timeout) {
	  	//default timout to 5 seconds
		timeout = timeout || 5000;

		// Bootstrap default alerts
		$('#alert_placeholder').html('<div id="alertdiv" class="alert ' +  alerttype + '"><a class="close" data-dismiss="alert">&times;</a><span>'+message+'</span></div>')

		// automatically remove message after timeout expires
		setTimeout(function() 
		{ 
			$("#alertdiv").remove();
	    }, timeout);
	}

});
</script>
	</body>
</html>