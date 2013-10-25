<div class="row">
	<div class="item">
		<h2 class="blue"><?php echo $title ?></h2>
		I like to make things. I may or may not be very good at any of them.
		<?php
		$con=mysqli_connect("localhost","advent","IwbanIR","advent");
		if (mysqli_connect_errno($con))
		{
			echo "Failed to connect to MySQL:" . mysqli_connect_error();
		} else
		{
			echo "Connect to MySQL!";
		}
		$result = mysqli_query($con,"SELECT * FROM Posts");
		while($row = mysqli_fetch_array($result))
		{
			echo "<p>" . $row['title'] . "</p>";
		}
		mysqli_close($con);
		?>
	</div>
</div>