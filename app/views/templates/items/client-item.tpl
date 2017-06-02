<div class="col-xs-6 col-sm-3 client-wrapper">

	<div class="edit-button-container">
		<button class="btn btn-primary edit_client" data-client_id="{$client.client_id}" data-client_first="{$client.first_name}" data-client_last="{$client.last_name}" data-client_birthday="{$client.birthday}" data-client_email="{$client.email}"
		data-client_phone="{$client.phone}" data-client_address="{$client.address}" data-toggle="modal" data-target="#edit-client-popup">
			<span class="glyphicon glyphicon-pencil"></span>
		</button>
	</div>

	<div class="client-main">
		<div class="center">
			<span class="glyphicon glyphicon-user default-avatar"></span>
		</div>

		<p class="center client-name">
			<strong>{$client.first_name} {$client.last_name}</strong>
		</p>
		{if isset($client.phone)}
		<p><span class="glyphicon glyphicon-phone"></span>&nbsp;&nbsp;{$client.phone}</p>
		{/if}
		{if isset($client.birthday)}
		<p><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;{$client.birthday}</p>
		{/if}
		{if isset($client.email)}
		<p><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;{$client.email}</p>
		{/if}
		{if isset($client.address)}
		<p><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;{$client.address}</p>
		{/if}
		<p><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;{$client.added}</p>
	</div>
</div>