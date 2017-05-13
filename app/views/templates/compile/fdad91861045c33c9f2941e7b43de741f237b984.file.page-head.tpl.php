<?php /* Smarty version Smarty-3.0.8, created on 2017-05-13 15:35:10
         compiled from "app/views/templates\components/page-head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:392459170b8e62bcc9-80592215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fdad91861045c33c9f2941e7b43de741f237b984' => 
    array (
      0 => 'app/views/templates\\components/page-head.tpl',
      1 => 1494682477,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '392459170b8e62bcc9-80592215',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>

	<!-- Bootstrap core CSS -->
	<!--<link href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
libs/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
	<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
/libs/material/css/roboto.min.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
/libs/material/css/material.min.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
/libs/material/css/ripples.min.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>

	<?php if (isset($_smarty_tpl->getVariable('styles',null,true,false)->value)){?>
		<?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('styles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value){
?>
			<link href="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
" rel="stylesheet">
		<?php }} ?>
	<?php }?>
</head>