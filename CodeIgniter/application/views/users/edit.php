<h2></h2>
<div class="alert alert-warning" aria-hidden="true">
	<?php 
		foreach ($user->error->all as $e)
		{
		    echo $e . "<br />";
		} 
	?>
</div>
<!--?php echo phpinfo(); ?-->
<?php echo form_open($url) ?>
	<input class="form-control" name="id" id="id" type="hidden" value="<?php echo $user->id ?>">
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?php echo $user->username ?>">
	</div>
	<div class="form-group">
		<label for="displayname">Display Name</label>
		<input type="text" class="form-control" name="displayname" id="displayname" placeholder="" value="<?php echo $user->displayname ?>">
	</div>
	<div class="form-group">
		<label for="">Email</label>
		<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $user->email ?>">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
	</div>
	<div class="form-group">
		<label for="confirmpass">Confirm password</label>
		<input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="" value="">
	</div>
	<input type="submit" class="btn btn-default" value="Submit">
</form>