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
			<div>
				<a href="{$appURL}apps/?week={$previousWeek}" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-chevron-left"></span> Previous week
				</a>
				{/if}
				{if isset($nextWeek)}
				<a href="{$appURL}apps/?week={$nextWeek}" class="btn btn-primary btn-sm">
					Next week <span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
			{/if}
			<div>
				<button class="btn btn-primary" data-toggle="modal" data-target="#add-appointment-popup" data-day="Mon May 08" data-hour="10:00">
					<span class="glyphicon glyphicon-plus"></span> Add appointment
				</button>
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
			<div class="col-xs-2 app-item" data-toggle="modal" data-target="#add-appointment-popup" data-day="{$day}" data-hour="{$hour}"></div>
			{/foreach}
		</div>
		{/foreach}
	</main>

	<div class="modal fade" id="add-appointment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Add appointment</h4>
					<div class="modal-body">
						<p>Hour: <span id="app-hour-label"></span></p>
						<p>Day: <span id="app-day-label"></span></p>
						<p>
							<form>
								<div class="form-group">
									<input name="client-name" type="text" class="form-control validate" placeholder="Client name" required>
								</div>
							</form>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl'}
</body>

</html>