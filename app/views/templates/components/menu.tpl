<nav id="menu-nav" class="navbar navbar-default navbar-material-cyan" role="navigation" style="color:white; font-weight:bold;"> <!-- navbar-fixed-top-->

	<div class="container">
		<div class="pull-left">
			<a href="{$appURL}" class="navbar-brand" style="padding:5px; background-color:white;">
				<img src="{$appURL}assets/logo-massage.png" alt="" style="max-width:100%; max-height:100%;">
			</a>
		</div>

		{if isset($menuItems)}
		<div class="navbar-header pull-right">
			<button id="menu-button" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-menu">
				<span class="sr-only">Toggle</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="clearfix visible-xs"></div>

		<div id="nav-menu" class="navbar-nav navbar-collapse collapse navbar-right">
			<div id="menu-spacer" class="hidden-xs"></div>
			<ul class="nav navbar-nav">
				{foreach from=$menuItems item=item}
					{if isset($item->menuLabel)}
						<li class="menu-item">
							<a href="{$appURL}{$item->name}/">
								{$item->menuLabel}
							</a>
						</li>
					{/if}
				{/foreach}
			</ul>
		</div> <!--.navbar-collapse-->
		{/if}

		<div class="clearfix"></div>
	</div> <!--.container-->
</nav>