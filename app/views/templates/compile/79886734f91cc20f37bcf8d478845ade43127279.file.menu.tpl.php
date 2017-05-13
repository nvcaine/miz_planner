<?php /* Smarty version Smarty-3.0.8, created on 2017-05-13 15:31:51
         compiled from "app/views/templates\components/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122659170ac7a9eff4-40172472%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79886734f91cc20f37bcf8d478845ade43127279' => 
    array (
      0 => 'app/views/templates\\components/menu.tpl',
      1 => 1482162371,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122659170ac7a9eff4-40172472',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<nav id="menu-nav" class="navbar navbar-default navbar-material-cyan" role="navigation" style="color:white; font-weight:bold;"> <!-- navbar-fixed-top-->

	<div class="container">
		<div class="pull-left">
			<a href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
" class="navbar-brand" style="padding:5px; background-color:white;">
				<img src="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
assets/gamelab.png" alt="" style="max-width:100%; max-height:100%;">
			</a>
		</div>

		<?php if (isset($_smarty_tpl->getVariable('menuItems',null,true,false)->value)){?>
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
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<?php if (isset($_smarty_tpl->getVariable('item',null,true,false)->value->menuLabel)){?>
						<li class="menu-item">
							<a href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
<?php echo $_smarty_tpl->getVariable('item')->value->name;?>
/">
								<?php echo $_smarty_tpl->getVariable('item')->value->menuLabel;?>

							</a>
						</li>
					<?php }?>
				<?php }} ?>
			</ul>
		</div> <!--.navbar-collapse-->
		<?php }?>

		<div class="clearfix"></div>
	</div> <!--.container-->
</nav>