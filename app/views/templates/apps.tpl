<!DOCTYPE html>
<html>

{include file='components/page-head.tpl'}

<body>

	<header>
		{include file='components/menu.tpl'}
	</header>

	<main class="container">
		<div class="page-header">
			<h2>Manage appointments</h2>
		</div>

		<p>In this section you can add, edit and remove appointments.</p>

		<div>
			<h3>Week {$week}</h3>
			<div>
				{if isset($previousWeek)}
				<a href="{$appURL}apps/?week={$previousWeek}" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-chevron-left"></span> Previous week
				</a>
				{/if}
				{if isset($nextWeek)}
				{if $week < $maxWeek - 1}
				<a href="{$appURL}apps/?week={$nextWeek}" class="btn btn-primary btn-sm">
					Next week <span class="glyphicon glyphicon-chevron-right"></span>
				</a>
				{else}
				<a href="{$appURL}apps/" class="btn btn-primary btn-sm">
					Next week <span class="glyphicon glyphicon-chevron-right"></span>
				</a>
				{/if}
				{/if}
			</div>
		</div>

		<div class="row">
			<div class="col-xs-2 day-container"><strong>Hours / Days</strong></div>

			{foreach from=$weekdays item=day}
			<div class="col-xs-2 day-container">{$day}</div>
			{/foreach}
		</div>

		{foreach from=$hours item=hour}
		<div class="row" style="background-color: {cycle values='#FFFFFF,#DDDDDD'}">
			<div class="col-xs-2 hour-container">{$hour}</div>
			{foreach from=$weekdays item=day}
			<div class="col-xs-2 app-item" data-toggle="modal" data-target="#add-appointment-popup" data-day="{$day}" data-hour="{$hour}">
				{foreach from=$apps item=app}
					{if $day == $app->day && $hour == $app->hour}
					{if $app->status == 'new'}
						{assign var='buttonClass' value='info'}
					{elseif $app->status == 'done'}
						{assign var='buttonClass' value='success'}
					{else}
						{assign var='buttonClass' value='warning'}
					{/if}
					<button class="btn btn-{$buttonClass} app-item-inner" data-toggle="modal" data-target="#edit-appointment-popup" data-status="{$app->status}" data-appid="{$app->id}">
						{$app->client}
					</button>
					{/if}
				{/foreach}
			</div>
			{/foreach}
		</div>
		{/foreach}
	</main>

	{include file='popups/add-app-popup.tpl'}

	{include file='popups/edit-app-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl'}
</body>

</html>