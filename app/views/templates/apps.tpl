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
				<a href="{$appURL}apps/" class="btn btn-primary btn-sm">This week</span>
				</a>
				{/if}
			</div>

			<div>
				<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#add-appointment-popup">
					Add appointment
				</button>
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
						<li class="single-event" data-start="{$app.start_time}" data-end="{$app.end_time}" data-content="{$appURL}app_details/?app_id={$app.app_id}" data-event="event-1">
							<a href="#0">
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

		<div class="event-modal">
			<header class="header">
				<div class="content">
					<span class="event-date"></span>
					<h3 class="event-name"></h3>
				</div>

				<div class="header-bg"></div>
			</header>

			<div class="body">
				<div class="event-info"></div>
				<div class="body-bg"></div>
			</div>

			<a href="#0" class="close">Close</a>
		</div> <!--event-modal-->
		<div class="cover-layer"></div>
	</div> <!--cd-schedule-->

	{include file='popups/add-app-popup.tpl'}

	{include file='popups/edit-app-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeSchedule='true' includeDatepicker='true'}

</body>

</html>