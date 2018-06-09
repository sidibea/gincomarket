<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/default.option1.layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21189376755901f40c5ce107-34201328%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6d254bb0947847953d338036373fd41a3e817a9' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/default.option1.layout.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21189376755901f40c5ce107-34201328',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_id' => 0,
    'module_style' => 0,
    'module_name' => 0,
    'module_icon_type' => 0,
    'module_icon_img' => 0,
    'sectionFeatures' => 0,
    'sectionSubs' => 0,
    'sectionManufacturers' => 0,
    'sectionBanners' => 0,
    'sectionContent' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40c5e77c8_02090209',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40c5e77c8_02090209')) {function content_5901f40c5e77c8_02090209($_smarty_tpl) {?><section id="groupcategory-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
" class="box-group-category style-<?php echo $_smarty_tpl->tpl_vars['module_style']->value;?>
">	<h2 class="heading-title hidden"><?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
</h2>	<div class="groupcategory-tb">		<div class="groupcategory-tr row">			<div class="groupcategory-cell groupcategory-links col-md-2 col-xs-12 col-sm-4">				<div class="row" >					<div class="groupcategory-tabs clearfix">						<div class="box-header clearfix">			                <div class="pull-left box-header-icon">			                	<?php if ($_smarty_tpl->tpl_vars['module_icon_type']->value=='image') {?>			                    	<img src="<?php echo $_smarty_tpl->tpl_vars['module_icon_img']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
">			                    <?php } else { ?>				                    <?php if ($_smarty_tpl->tpl_vars['module_icon_img']->value!='') {?>				                    	<i class="<?php echo $_smarty_tpl->tpl_vars['module_icon_img']->value;?>
"></i>				                    <?php }?>			                    <?php }?>							</div>			                <div class="pull-left box-header-title">			                	<a role="tab" data-id="<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
" data-toggle="tab" href=".tab-content-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
-0-0" class="tab-link check-active active"><?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
</a>			                </div>			            </div>						<?php echo $_smarty_tpl->tpl_vars['sectionFeatures']->value;?>
			            <?php echo $_smarty_tpl->tpl_vars['sectionSubs']->value;?>
			            <?php echo $_smarty_tpl->tpl_vars['sectionManufacturers']->value;?>
					</div>				</div>			</div>			<div class="groupcategory-cell alpha col-md-3 col-xs-12 hidden-sm">				<?php echo $_smarty_tpl->tpl_vars['sectionBanners']->value;?>
			</div>			<div class="groupcategory-cell groupcategory-cell-products col-md-7 col-sm-8 col-xs-12">				<div class="row">					<div class="tab-content">						<?php echo $_smarty_tpl->tpl_vars['sectionContent']->value;?>
					</div>				</div>			</div>		</div>	</div></section><?php }} ?>
