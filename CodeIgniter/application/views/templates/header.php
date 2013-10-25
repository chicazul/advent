<!DOCTYPE html>
<html>
	<head>
	<title>Adventures of Chicazul - <?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://localhost/advent/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/advent/css/styles.css">
	</head>
	<body>
		<div class="container">
			<div class="navbar col-lg-offset-4">
				<ul class="nav navbar-nav">
					<li><a href="/advent/CodeIgniter/store/">STORE</a></li>
					<li><a href="#">GALLERY</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">I<?php echo $title; ?></a></li>
					<li>
		<a href="https://chicazul.foxycart.com/cart?cart=view" id="fc_minicart">
	<span id="fc_quantity">0</span>
	<span id="fc_singular"> item </span>
	<span id="fc_plural"> items </span> in cart
</a></li>
				</ul>
			</div>