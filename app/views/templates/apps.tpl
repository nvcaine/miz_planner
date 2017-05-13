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
			{if isset($previousWeek)}
			<a href="{$appURL}apps/?week={$previousWeek}" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Previous week</a>
			{/if}
			{if isset($nextWeek)}
			<a href="{$appURL}apps/?week={$nextWeek}" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-right"></span> Next week</a>
			{/if}
		</div>

		<div class="row">
			<div class="col-xs-2"></div>

			{foreach from=$weekdays item=day}
			<div class="col-xs-2">{$day}</div>
			{/foreach}
		</div>

		{foreach from=$hours item=hour}
		<div class="row" style="background-color: {cycle values='#FFFFFF,#DDDDDD'}">
			<div class="col-xs-2 hour-container">{$hour}</div>

			<div class="col-xs-2 app-item"></div>
			<div class="col-xs-2 app-item"></div>
			<div class="col-xs-2 app-item"></div>
			<div class="col-xs-2 app-item"></div>
			<div class="col-xs-2 app-item"></div>
		</div>
		{/foreach}
	</main>

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl'}
</body>

</html>