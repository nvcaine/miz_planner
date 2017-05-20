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
	</main>

	{include file='popups/add-client-popup.tpl'}

	{include file='popups/edit-client-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeDatepicker='true'}
</body>

</html>