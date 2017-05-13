<?php /* Smarty version Smarty-3.0.8, created on 2017-05-13 15:31:51
         compiled from "app/views/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1495659170ac7933b24-94082372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dd59c2536946ad1c1c4ce86879deb9a2604cac3' => 
    array (
      0 => 'app/views/templates\\index.tpl',
      1 => 1494681447,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1495659170ac7933b24-94082372',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>

<?php $_template = new Smarty_Internal_Template('components/page-head.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<body>

    <header>
        <?php $_template = new Smarty_Internal_Template('components/menu.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </header>

    <main class="container">
        <h2>Welcome to our Intranet</h2>
        <p>
            To gain access, you will have to log into your Facebook account.<br />
            Additionally, you will have to be part of our group.
        </p>
    </main>

    <?php $_template = new Smarty_Internal_Template('components/footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

    <?php $_template = new Smarty_Internal_Template('components/page-footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>

</html>