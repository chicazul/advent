<div class="container">
<div class="row">
	<div class="col-lg-offset-4 col-md-offset-2 col-md-8 content">
		<h2>Thank you for your purchase!</h2>
		<p>You should receive an email confirmation shortly.</p>
		<p>Please email <a href="mailto:sara@chicazul.com">sara@chicazul.com</a> if you do not receive an email, or if you have any questions or comments.</p>
		<h4>Thanks to you I'm closer to my goal!</h4>
		<div class="progress progress-striped">
			<?php 
				$total = file_exists($_SERVER['DOCUMENT_ROOT'] . '/total.txt') ? file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/total.txt') : "100";
				$goal = file_exists($_SERVER['DOCUMENT_ROOT'] . '/goal.txt') ? file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/goal.txt') : "1500";
				$total = str_replace(array("\r", "\n"), "", $total); 
				$goal = str_replace(array("\r", "\n"), "", $goal); 
				?>
			<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $total; ?>" aria-valuemin="0" aria-valuemax="<?php echo $goal; ?>" style="width: <?php echo $total / $goal * 100; ?>%">
				<span class="sr-only">$<?php echo $total ?></span>
			</div>
			$<?php echo $total . " of " . $goal ?>
		</div>
	</div>
</div>
</div>