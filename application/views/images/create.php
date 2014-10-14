
<?php if($error) echo '<div class="alert alert-warning">' . $error . '</div>'; ?>

<?php echo form_open_multipart('images/upload');?>
<h3>Upload a File</h3>
	<div class="form-group">
		<input type="file" name="userfile" size="20" />
	</div>

	<input class="btn btn-primary" type="submit" name="submit" value="Upload" />

</form>
