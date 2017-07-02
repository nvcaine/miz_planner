<!DOCTYPE html>
<html>

{include file='components/page-head.tpl' includeDatepicker='true'}

<body>

	<header>
		{include file='components/menu.tpl'}
	</header>

	<main class="container">
		<div class="page-header">
			<h2>Manage users</h2>
		</div>

		<p>
			This section is dedicated to user management.<br />
			You can Add and remove users if you admin privileges.
		</p>

		{if isset($users)}
		<div>
			<button class="btn btn-success" data-toggle="modal" data-target="#add-user-popup">
				<span class="glyphicon glyphicon-plus"></span> Add user
			</button>
		</div>
		{/if}

		<div>
		{if isset($users)}
		{foreach from=$users item=user}
			<tr>
				<td>{$user.user_id}</td>
				<td>{$user.name}</td>
				<td>{$user.email}</td>
				<td>{$user.type}</td>
			</tr>
		{/foreach}
		{else}
			<h4>
				<span class="label label-danger">Your account is not authorized to access this section.</span>
			</h4>
		{/if}
		</div>
	</main>

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeDatepicker='true'}
</body>

</html>