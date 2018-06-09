<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:11:00
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/hook/displaycustomeraccountform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11222503459020a04b57dd2-96806569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcc8777621c2e7a1826dd3322c7a9f9c3ce9f1bb' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/hook/displaycustomeraccountform.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11222503459020a04b57dd2-96806569',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir_ssl' => 0,
    'sellerinfo' => 0,
    'countries' => 0,
    'create_seller_checked' => 0,
    'id_cms_seller_terms' => 0,
    'link_terms' => 0,
    'seller_sign_up_fields' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020a04b8d2e1_27074324',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020a04b8d2e1_27074324')) {function content_59020a04b8d2e1_27074324($_smarty_tpl) {?><script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/agilemultipleseller/js/AgileStatesManagement.js"></script>
<script type="text/javascript">
  idSelectedCountry = <?php if (isset($_POST['id_state'])) {?><?php echo intval($_POST['id_state']);?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->id_state)) {?><?php echo intval($_smarty_tpl->tpl_vars['sellerinfo']->value->id_state);?>
<?php } else { ?>false<?php }?><?php }?>;
  <?php if (isset($_smarty_tpl->tpl_vars['countries']->value)) {?>
      <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('agileCountries'=>$_smarty_tpl->tpl_vars['countries']->value),$_smarty_tpl);?>

  <?php }?>

  $(document).ready(function() {
    selleraccountsignup();

      $("a#seller_terms").fancybox({
         'type' : 'iframe',
         'width':600,
        'height':600
      });
  });

  function selleraccountsignup()
  {
    if($("input[id='seller_account_signup']").attr('checked') == 'checked')
    {
         $("#agile_fields").show();;
    } else
    {
        $("#agile_fields").hide();;
    }
  }
</script>
<div id="agile">
  <h3><?php echo smartyTranslate(array('s'=>'Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h3>
  <div class="agile_padding" />
  <p>
    <?php echo smartyTranslate(array('s'=>'If you register for a seller account, you will be able to list your products for sale on this website.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    <?php echo smartyTranslate(array('s'=>'You can also choose to create your seller account at a later time. You can register for your seller account at any time from My Account - My Seller Account page.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

  </p>
  <br />
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
js/admin.js"></script>
  <?php if (!isset($_smarty_tpl->tpl_vars['create_seller_checked']->value)) {?>
  <div class="checkbox">
	  <input id="seller_account_signup" type="checkbox" name="seller_account_signup" value="1" <?php if (isset($_POST['seller_account_signup'])) {?><?php if ($_POST['seller_account_signup']==1) {?>checked<?php }?><?php }?>
	   onChange="selleraccountsignup();"/> 
    <label for="seller_account_signup">
      <?php if (isset($_smarty_tpl->tpl_vars['id_cms_seller_terms']->value)&&$_smarty_tpl->tpl_vars['id_cms_seller_terms']->value>0) {?>
      <?php echo smartyTranslate(array('s'=>'Yes, I have read and I agree on the Seller Terms & conditions','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
,
      <?php }?>
      <?php echo smartyTranslate(array('s'=>'Please create a seller account for me','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </label>
  </div>
  <?php }?>
  <?php if (isset($_smarty_tpl->tpl_vars['id_cms_seller_terms']->value)&&$_smarty_tpl->tpl_vars['id_cms_seller_terms']->value>0) {?>
  <p class="clearfix">
    <span class="agile-term">
      <a href="<?php echo $_smarty_tpl->tpl_vars['link_terms']->value;?>
" id="seller_terms" class="iframe"><?php echo smartyTranslate(array('s'=>'Seller Terms & conditions(read)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a>
    </span>
  </p>
  <?php }?>
  <div class="agile-emptyrow"></div>
  <div class="account_creation" id="agile_fields" style="display:<?php if (!isset($_smarty_tpl->tpl_vars['create_seller_checked']->value)) {?>none;<?php }?>">
    <?php echo $_smarty_tpl->tpl_vars['seller_sign_up_fields']->value;?>

  </div>
</div>
<?php }} ?>
