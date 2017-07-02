<!DOCTYPE html>
<html>

{include file='components/page-head.tpl'}

<body>

	<header>
		{include file='components/menu.tpl'}
	</header>

	<main class="container">
		<h2>Login</h2>
		<p>
			Please use the form below to authenticate.
		</p>
		{if isset($login_failed)}
		<p>
			<h4><span class="label label-danger">Unathorized credentials!</span></h4>
		</p>
		{/if}
		<p>
			<form method="post">
					<div class="form-group">
						<input name="username" type="text" class="form-control validate" placeholder="Username" required>
					</div>

					<div class="form-group">
						<input name="password" type="password" class="form-control validate" placeholder="Password" required>
					</div>

					<div class="form-group">
						<label>
							<input name="remember_me" type="checkbox" class="from-control">
							Remember me
						</label>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
			</form>
		</p>
	</main>

	{include file='components/footer.tpl'}

	{include file='components/page-footer.tpl'}
</body>

</html>