<div class="event-info">
	<p><strong>{$app.day}</strong></p>
	<p><strong>{$app.first_name} {$app.last_name}</strong></p>
	<p>{$app.phone}</p>
	<p>{$app.birthday} (age: {$app.client_age})</p>
	<p>{$app.address}</p>
	<p>
		<a href="mailto:{$app.email}">{$app.email}</a>
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