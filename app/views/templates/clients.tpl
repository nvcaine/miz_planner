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

		<p>This section is dedicated to client management and analytics</p>

		<div>
			<button class="btn btn-success" data-toggle="modal" data-target="#add-client-popup">
				<span class="glyphicon glyphicon-plus"></span> Add client
			</button>
		</div>

		<ul class="nav nav-tabs">
			<li><a data-toggle="tab" href="#all-clients">All clients</a></li>
			<li><a data-toggle="tab" href="#clients-birthdays">Upcoming birthdays</a></li>
		</ul>

		<div class="tab-content">
			<div id="all-clients" class="tab-pane fade in active">
				<div class="row">
				{foreach from=$clients key=index item=client}
				{if $index % 4 == 0 && $index > 0}
				</div>
				<div class="row">
				{/if}
					{if $index % 2 == 0 && $index > 0}
					<div class="clearfix visible-xs"></div>
					{/if}
					{include file='items/client-item.tpl' client=$client index=$index}
				{/foreach}
				</div>
			</div>

			<div id="clients-birthdays" class="tab-pane fade">
				<div class="row">
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						<strong>Name</strong>
					</div>
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						<strong>Birthday</strong>
					</div>
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						<strong>Phone</strong>
					</div>
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						<strong>Email</strong>
					</div>
				</div>
			{foreach from=$clients_birthdays item=client}
				<div class="row" style="background-color:{cycle values='#ffffff,#dddddd'}">
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						{$client.first_name} {$client.last_name}
					</div>
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						<strong>{$client.week_birthday}</strong><br />
						Born: {$client.birthyear}, age: {$client.age + 1}
					</div>
					<div class="clearfix visible-xs"></div>
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						{$client.phone}
					</div>
					<div class="col-sm-3 col-xs-6 center user-row-cell">
						{$client.email}
					</div>
				</div>
			{/foreach}
			</div>
		</div>
	</main>

	{include file='popups/add-client-popup.tpl'}

	{include file='popups/edit-client-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeDatepicker='true'}
</body>

</html>