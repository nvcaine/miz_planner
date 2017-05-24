<div class="col-xs-6 col-sm-3">

	<div style="background-color:#FFFFFF;padding:10px;margin-bottom:20px;">
		<div style="text-align:center;">
			<span class="glyphicon glyphicon-user" style="font-size:50px;padding:10px;border:1px solid #CCCCCC;"></span>
		</div>

		<p style="text-align:center; font-size:1.3em;padding:10px;">
			<strong>{$client->first_name} {$client->last_name}</strong>
		</p>
		{if isset($client->phone)}
		<p><span class="glyphicon glyphicon-phone"></span>&nbsp;&nbsp;{$client->phone}</p>
		{/if}
		{if isset($client->birth_date)}
		<p><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;{$client->birth_date}</p>
		{/if}
		{if isset($client->mail)}
		<p><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;{$client->mail}</p>
		{/if}
		<p><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;{$client->date_added}</p>
	</div>
</div>