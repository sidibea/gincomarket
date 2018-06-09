<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:22:06
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/hook/hook_product_information.tpl" */ ?>
<?php /*%%SmartyHeaderCode:91435479759020c9ec6e8d1-08945333%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ba196bab0f386a0f8b9f6bb3911df268f23cc3d' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/hook/hook_product_information.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91435479759020c9ec6e8d1-08945333',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_seller' => 0,
    'approveal_required' => 0,
    'sellers' => 0,
    'seller' => 0,
    'id_seller' => 0,
    'approved' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020c9ec92197_61242901',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020c9ec92197_61242901')) {function content_59020c9ec92197_61242901($_smarty_tpl) {?>	<?php if (!$_smarty_tpl->tpl_vars['is_seller']->value||$_smarty_tpl->tpl_vars['approveal_required']->value) {?><div class="separation"></div><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['is_seller']->value) {?>
			<div class="form-group" stryle="display:none;">	
				<label class="control-label col-lg-3" for="id_seller">
				</label>
				<div class="col-lg-3">
					<input type="hidden" name="id_seller" value="$id_seller">
				</div>
			</div>
		<?php } else { ?>
			<div class="form-group">	
				<label class="control-label col-lg-3" for="id_seller">
					<?php echo smartyTranslate(array('s'=>'Seller','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

				</label>
				<div class="col-lg-3">
					<select name="id_seller" id="id_seller">
						<?php  $_smarty_tpl->tpl_vars['seller'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['seller']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sellers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['seller']->key => $_smarty_tpl->tpl_vars['seller']->value) {
$_smarty_tpl->tpl_vars['seller']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['seller']->value['id_seller'];?>
" <?php if ($_smarty_tpl->tpl_vars['id_seller']->value==$_smarty_tpl->tpl_vars['seller']->value['id_seller']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['seller']->value['id_seller'];?>
 - <?php echo $_smarty_tpl->tpl_vars['seller']->value['name'];?>
</option>
						<?php } ?>
					</select>
				</div>
			</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['approveal_required']->value) {?>
			<div class="form-group">
				<label class="control-label col-lg-3" for="approved">
					<span class="label-tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo smartyTranslate(array('s'=>'Indicates whether this product is approved for listing.  This field appears if [Listing Approval Required] is configured.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
						<?php echo smartyTranslate(array('s'=>'Listing Approved','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

					</span>
				</label>							
				<div class="col-lg-3">
					<?php if ($_smarty_tpl->tpl_vars['is_seller']->value) {?>
						<input type="hidden" name="approved" id="approved" value="<?php if ($_smarty_tpl->tpl_vars['approved']->value) {?>1<?php } else { ?>0<?php }?>" />
						<input type="checkbox" name="approved" id="approved" value="1" <?php if ($_smarty_tpl->tpl_vars['approved']->value) {?>checked<?php }?> disabled="true"  />
					<?php } else { ?>
						<input type="checkbox" name="approved" id="approved" value="1" <?php if ($_smarty_tpl->tpl_vars['approved']->value) {?>checked<?php }?> />
					<?php }?>
				</div>
			</div>
		<?php }?>
<?php }} ?>
