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
			You can add and remove users if you have admin privileges.
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
			<table id="users-table" class="center">
			{foreach from=$users item=user}
				<tr style="background-color:{cycle values='#dddddd,#ffffff'};">
					<td>{$user.user_id}</td>
					<td>
						{$user.name}
					{if $user.type == 'admin'}
						&nbsp;&nbsp;<span class="glyphicon glyphicon-star"></span>
					{/if}
					</td>
					<td>{$user.email|replace:'@':'<br/>@'}</td>
					<td>
						<button class="btn btn-primary btn-sm" data-user_name="{$user.name}" data-user_email="{$user.email}" data-user_id="{$user.user_id}" data-toggle="modal" data-target="#edit-user-popup">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</td>
				</tr>
			{/foreach}
			</table>
		{else}
			<h4>
				<span class="label label-danger">Your account is not authorized to access this section.</span>
			</h4>
		{/if}
		</div>
	</main>

	{include file='popups/add-user-popup.tpl'}

	{include file='popups/edit-user-popup.tpl'}

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl' includeDatepicker='true'}
</body>

</html>