<?php if($this->session->flashdata('message')) echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>'; ?>
<a class="btn btn-primary" href="/advent/images/create" role="button">New Image</a>
<table class="table">
	<tr>
		<th>Artist</th>
		<th>Source</th>
		<th>Description</th>
		<th></th>
	</tr>
	<?php foreach ($images as $i): ?>
	<tr>
		<td><?php echo $i->artist ?></td>
		<td><?php echo $i->source ?></td>
		<td><?php echo $i->description ?></td>
		<td><a href="/advent/images/edit/<?php echo $i->id; ?>">Edit</a> | <a href="/advent/images/delete/<?php echo $i->id; ?>">Delete</a></td>
	</tr>
	<?php endforeach ?>
</table>