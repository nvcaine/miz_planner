<!DOCTYPE html>
<html>

{include file='components/page-head.tpl' includeDatepicker='true'}

<body>

	<header>
		{include file='components/menu.tpl'}
	</header>

	<main class="container">
		<div class="page-header">
			<h2>Manage clients</h2>
		</div>

		<p>
			This section is dedicated to client management and analytics.
		</p>
		<div>
			<button class="btn btn-success" data-toggle="modal" data-target="#add-client-popup">
				<span class="glyphicon glyphicon-plus"></span> Add client
			</button>
		</div>

		{foreach from=$clients item=client}
		<div class="row" style="background-color: {cycle values='#FFFFFF,#DDDDDD'}">
			<div class="col-xs-8">
				<h4>{$client->first_name} {$client->last_name}</h4>
				{if isset($client->phone)}
				<p>{$client->phone}</p>
				{/if}
				<p>{$client->birth_date}</p>
			</div>
			<!--<div class="col-xs-3">{$client->birth_date}</div>-->
			<div class="col-xs-4">{$client->date_added}</div>
		</div>
		{/foreach}
	</main>

	{include file='popups/add-client-popup.tpl'}

	{include file='popups/edit-client-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeDatepicker='true'}
</body>

</html>