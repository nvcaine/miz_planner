<!DOCTYPE html>
<html>

{include file='components/page-head.tpl' includeSchedule='true' includeDatepicker='true'}

<body>

	<header>
		{include file='components/menu.tpl'}
	</header>

	<div class="container">
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
				<a href="{$appURL}apps/" class="btn btn-primary btn-sm">This week</a>
				{/if}
			</div>

			<div>
				<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#add-appointment-popup">
					Add appointment
				</button>

				{if isset($users)}
				<div class="dropdown">
					<button class="btn btn-primary btn-lg" id="admin-users-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Filter by user
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="admin-users-toggle">
					{foreach from=$users item=user}
						{if $week == $thisWeek}
						<li><a href="{$appURL}apps/?user_id={$user.user_id}">{$user.name}</a></li>
						{else}
						<li><a href="{$appURL}apps/?week={$week}&user_id={$user.user_id}">{$user.name}</a></li>
						{/if}
					{/foreach}
					</ul>
				</div>
				{/if}
			</div>
		</div>
	</div>

	<div class="cd-schedule loading">
		<div class="timeline">
			<ul>
			{foreach from=$hours item=hour}
				<li><span>{$hour}</span></li>
			{/foreach}
			</ul>
		</div> <!-- .timeline -->

		<div class="events">
			<ul>
				{foreach from=$weekdays item=day}
				<li class="events-group">
					<div class="top-info"><span>{$day}</span></div>

					<ul>
					{foreach from=$apps item=app}
						{if $app.day == $day}
						<li class="single-event" data-start="{$app.start_time}" data-end="{$app.end_time}" data-content="{$appURL}app_details/?app_id={$app.app_id}&week={$week}" data-event="event-{$app.event_type}">
							<a href="#0">
								<div class="visible-xs" style="color:#DDDDDD;">{$app.start_time} - {$app.end_time}</div>
								<strong class="event-name">{$app.first_name[0]}. {$app.last_name}</strong>
							</a>
						</li>
						{/if}
					{/foreach}
					</ul>
				</li>
				{/foreach}
			</ul>
		</div>

		{include file='popups/app-details-popup.tpl'}

	</div> <!--cd-schedule-->

	{include file='popups/add-app-popup.tpl' week=$week}

	{include file='popups/edit-app-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeSchedule='true' includeDatepicker='true'}

</body>

</html>