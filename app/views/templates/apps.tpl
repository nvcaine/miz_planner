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
				{if $previousWeek != $thisWeek}
				<a href="{$appURL}apps/?week={$previousWeek}" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-chevron-left"></span> Previous week
				</a>
				{else}
				<a href="{$appURL}apps/" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-chevron-left"></span> Previous week
				</a>
				{/if}
				{/if}

				{if isset($nextWeek)}
				{if $nextWeek != $thisWeek}
				<a href="{$appURL}apps/?week={$nextWeek}" class="btn btn-primary btn-sm">
					Next week <span class="glyphicon glyphicon-chevron-right"></span>
				</a>
				{else}
				<a href="{$appURL}apps/" class="btn btn-primary btn-sm">
					Next week <span class="glyphicon glyphicon-chevron-right"></span>
				</a>
				{/if}
				{/if}

				{if $week != $thisWeek}
				<a href="{$appURL}apps/" class="btn btn-primary btn-sm">This week</span>
				</a>
				{/if}
			</div>
		</div>

		<div class="apps-wrapper">
		<div class="apps-container">
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
						<button class="app-item-inner btn btn-{$app->buttonClass} btn-sm" data-toggle="modal" data-target="#edit-appointment-popup" data-status="{$app->status}" data-appid="{$app->id}" data-fullname="{$app->client}">
							{$app->client_short}
						</button>
						{/if}
					{/foreach}
				</div>
				{/foreach}
			</div>
			{/foreach}
		</div>
		</div>
	</main>

	{include file='popups/add-app-popup.tpl'}

	{include file='popups/edit-app-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl'}
</body>

</html>