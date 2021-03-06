<div class="event-info">
	<p>
		<span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;
		<strong>{$app.day}</strong>
	</p>
	{if $app.type != 'Break'}
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
	{/if}
	<p>
		<br />
		<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;
		{$app.notes}
		<br /><br />
	</p>
	<form method="post">
		<div class="form-group">
			<button id="edit-{if $app.type!='Break'}app{else}break{/if}-button" type="button" class="btn btn-info" data-toggle="modal" data-target="#add-{if $app.type!='Break'}appointment{else}break{/if}-popup" data-appclient="{$app.first_name} {$app.last_name}" data-apptype="{$app.type}" data-appdate="{$app.date}" data-appstart="{$app.start_time}" data-append="{$app.end_time}" data-appnotes="{$app.notes}" data-appclientid="{$app.client_id}" data-appid="{$app.app_id}" data-userid="{$app.user_id}">
				<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit
			</button>

			<button type="submit" class="btn btn-danger" name="delete-app-action" onclick="return confirm('Are you sure you want to delete this {if $app.type!='Break'}appointment{else}break{/if}?');">
				<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete
			</button>
		</div>
		<input type="hidden" name="edit-app-id" value="{$app.app_id}">
		<input type="hidden" name="week" value="{$week}">
	</form>
</div>