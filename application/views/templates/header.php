<!DOCTYPE html>
<html>
	<head>
	<title>Adventures of Chicazul - <?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="http://localhost/advent/css/bootstrap.css">
	<!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">-->
	<!--<link rel="stylesheet" type="text/css" href="http://localhost/advent/css/bootstrap.min.css">-->
	<link rel="stylesheet" type="text/css" href="http://localhost/advent/css/styles.css">

	</head>
	<body>
			<nav class="navbar navbar-default col-lg-offset-4" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
					</button>
					<a class="navbar-brand" href="/advent/">chicazul</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				    <ul class="nav navbar-nav">
				      <li><a href="/advent/store/">STORE</a></li>
				      <li><a href="#">GALLERY</a></li>
				      <li><a href="/advent/about/">ABOUT</a></li>
				    </ul>

					<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 pull-right">
						<small>JoCo Cruise Crazy Fundraising Goal</small>
						<div class="progress progress-striped">
							<?php $total = file_exists($_SERVER['DOCUMENT_ROOT'] . '/advent/total.txt') ? file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/advent/total.txt') : "100";?>
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $total; ?>" aria-valuemin="0" aria-valuemax="2500" style="width: <?php echo $total / 25; ?>%">
								<span class="sr-only">$300</span>
							</div>
						</div>
					</div>

					<a href="https://chicazul.foxycart.com/cart?cart=view" id="fc_minicart" class="pull-right">
						<span id="fc_quantity">0</span>
						<span id="fc_singular"> item </span>
						<span id="fc_plural"> items </span> in cart
					</a>
		  		</div><!-- /.navbar-collapse -->
		  		
			</nav>
		<div class="container">