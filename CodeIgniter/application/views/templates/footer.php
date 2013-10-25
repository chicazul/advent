</div>
This is a footer
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
	    	// Add notification that product is being added here.
	    	showalert('Adding to cart...', 'alert-warning');

		    $.getJSON(href + '&output=json&callback=?', function(data)
		    {
		        // Automatically update JSON and minicart helper objects
		        fcc.cart_update();
		 
		      	// Add notification that the product has successfully been added here.
		 
		      	showalert('Item has been added to cart.', 'alert-success');
		    });
		    return false;
	    }

	});

	$('#cart').on('hidden.bs.modal', function () 
	{
		fcc.cart_update();
	})


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