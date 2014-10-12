<?php if($this->session->flashdata('message')) echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>'; ?>
<a class="btn btn-primary" href="create" role="button">New Post</a>
<table class="table">
	<tr>
		<th>Title</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach ($posts as $p): ?>
	<tr>
		<td><?php echo $p->title ?></td>
		<td><a href="edit/<?php echo $p->slug; ?>">Edit</a></td>
		<td><a href="delete/<?php echo $p->slug; ?>">Delete</a></td>
	</tr>
	<?php endforeach ?>
</table>