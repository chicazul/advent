
<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://chicazul.com/js/bootstrap.js"></script>
<!-- FOXYCART -->
<script src="//cdn.foxycart.com/chicazul/loader.js" async defer></script>
<!-- /FOXYCART -->
<script type="text/javascript">
jQuery(document).ready(function() 
{

	// Product options can change product price. Make sure to update it
	$('.option').change(function() {
		var totalPrice = parseInt($("#price").val());
		$("select option:selected").each(function(index) {
			totalPrice += parseInt($("#"+this.id+"-value").val());
		});
		$('#totalprice').text(totalPrice);
		$('#subtotal').toggleClass('hidden',(totalPrice <= 0));
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