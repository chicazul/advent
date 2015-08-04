<!DOCTYPE html>
<html>
	<head>
	<title>Adventures of Chicazul - <?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='http://fonts.googleapis.com/css?family=Monda:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://chicazul.com/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://chicazul.com/css/styles.css">

	</head>
	<body>
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="glyphicon glyphicon-th-list"></span>
					</button>
					<a class="navbar-brand" href="/">Adventures of Chicazul</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				    <ul class="nav navbar-nav">
				      <li><a href="/store/">STORE</a></li>
				      <li><a href="/about/">ABOUT</a></li>
				      <?php
				      	if(isset($user))
				      	{
				      		echo '<li><a href="/advent/logout">LOG OUT</a></li>';
				      	}
				      ?>
				    </ul>

					<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 pull-right">
						<small>JoCo Cruise Fundraising Goal</small>
						<div class="progress progress-striped">
							<?php 
								$total = file_exists($_SERVER['DOCUMENT_ROOT'] . '/total.txt') ? file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/total.txt') : "100";
								$goal = file_exists($_SERVER['DOCUMENT_ROOT'] . '/goal.txt') ? file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/goal.txt') : "1500";
								$total = str_replace(array("\r", "\n"), "", $total); 
								$goal = str_replace(array("\r", "\n"), "", $goal); 
							?>
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $total; ?>" aria-valuemin="0" aria-valuemax="<?php echo $goal; ?>" style="width: <?php echo $total / $goal * 100; ?>%">
								<span class="sr-only">$<?php echo $total; ?></span>
							</div>
						</div>
					</div>
					<!-- FoxyCart minicart - inline style hack to keep blank minicart from flashing while FC loads -->
					<div data-fc-id="minicart" class="pull-right" style="display:none;">
						<a href="https://chicazul.foxycart.com/cart?cart=view">
							$<span data-fc-id="minicart-order-total">0</span>
							<span class="glyphicon glyphicon-shopping-cart"></span>
							<span data-fc-id="minicart-quantity">0</span>
							<span data-fc-id="minicart-singular"> item </span>
							<span data-fc-id="minicart-plural"> items </span> in cart
						</a>
					</div><!-- /minicart -->
		  		</div><!-- /.navbar-collapse -->
		  		
			</nav>