<?php if($this->session->flashdata('message')) echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>'; ?>
<table class="table">
	<tr>
		<th>Username</th>
		<th>Display Name</th>
		<th>Email</th>
		<th></th>
	</tr>
	<?php foreach ($users as $u): ?>
	<tr>
		<td><?php echo $u->username ?></td>
		<td><?php echo $u->displayname ?></td>
		<td><?php echo $u->email ?></td>
		<td><a href="users/edit/<?php echo $u->id ?>">Edit</a></td>
	</tr>
	<?php endforeach ?>
</table>