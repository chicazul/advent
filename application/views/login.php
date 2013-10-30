
<h2><?php echo $title ?></h2>
<div class="item">
<div class="alert alert-warning">
	<?php 
		foreach ($user->error->all as $e)
		{
		    echo $e . "<br />";
		} 
	?>
</div>
<?php echo form_open('login') ?>
	
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?php echo $user->username ?>">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
	</div>

	<input class="btn" type="submit" name="submit" value="Log In" />
</form>
</div>