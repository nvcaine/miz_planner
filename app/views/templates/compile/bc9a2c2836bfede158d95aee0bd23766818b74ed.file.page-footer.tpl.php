<?php /* Smarty version Smarty-3.0.8, created on 2017-05-13 15:35:10
         compiled from "app/views/templates\components/page-footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2022159170b8e70e604-77769560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc9a2c2836bfede158d95aee0bd23766818b74ed' => 
    array (
      0 => 'app/views/templates\\components/page-footer.tpl',
      1 => 1494682505,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2022159170b8e70e604-77769560',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- modules -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
<!--<script src="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
libs/jQuery.1.11.0/jquery-1.11.0.min.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
libs/bootstrap-3.3.5/js/bootstrap.min.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
/libs/material/js/ripples.min.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
/libs/material/js/material.min.js"></script>

<?php if (isset($_smarty_tpl->getVariable('scripts',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['script'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('scripts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['script']->key => $_smarty_tpl->tpl_vars['script']->value){
?>
		<script src="<?php echo $_smarty_tpl->getVariable('appURL')->value;?>
<?php echo $_smarty_tpl->tpl_vars['script']->value;?>
"></script>
	<?php }} ?>
<?php }?>
