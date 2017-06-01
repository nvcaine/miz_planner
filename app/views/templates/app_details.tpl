<div class="event-info">
	<p>
		<span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;
		<strong>{$app.day}</strong>
	</p>
	<p>
		<span class="glyphicon glyphicon-barcode"></span>&nbsp;&nbsp;
		<strong>{$app.type}</strong>
	</p>
	<p>
		<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;
		<strong>{$app.first_name} {$app.last_name}</strong>
	</p>
	<p>
		<span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;
		{$app.phone}
	</p>
	<p>
		<span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;
		{$app.birthday} (age: {$app.client_age})
	</p>
	<p>
		<span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;
		{$app.address}
	</p>
	<p>
		<span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;
		<a href="mailto:{$app.email}">{$app.email}</a>
	</p>
	<p>
		<br />
		<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;
		{$app.notes}
	</p>
	<form method="post">
		<div class="form-group">
			<button type="submit" class="btn btn-danger" name="delete-app-action" onclick="return confirm('Are you sure you want to delete this appointment?');">
				<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete
			</button>
		</div>
		<input type="hidden" name="edit-app-id" value="{$app.app_id}">
	</form>
</div>