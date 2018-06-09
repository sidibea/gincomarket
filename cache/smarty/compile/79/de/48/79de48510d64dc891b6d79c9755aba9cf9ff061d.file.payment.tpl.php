<?php /* Smarty version Smarty-3.1.19, created on 2018-06-05 01:47:03
         compiled from "/home/abdouhanne/www/modules/universalpay/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20109405495b15eb97c44109-22076919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79de48510d64dc891b6d79c9755aba9cf9ff061d' => 
    array (
      0 => '/home/abdouhanne/www/modules/universalpay/views/templates/hook/payment.tpl',
      1 => 1495240425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20109405495b15eb97c44109-22076919',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'universalpay' => 0,
    'img_ps_dir' => 0,
    'ps' => 0,
    'universalpay_onepage' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b15eb97c8d063_58981363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b15eb97c8d063_58981363')) {function content_5b15eb97c8d063_58981363($_smarty_tpl) {?>
<style>
    a.universalpay:after {
        color: #777777;
        content: "\f054";
        display: block;
        font-family: "FontAwesome";
        font-size: 25px;
        height: 22px;
        margin-top: -11px;
        position: absolute;
        right: 15px;
        top: 50%;
        width: 14px;
    }

    a.universalpay:hover {
        color: #515151;
        border-color: #515151;
    }
</style>
<?php  $_smarty_tpl->tpl_vars['ps'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ps']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['universalpay']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ps']->key => $_smarty_tpl->tpl_vars['ps']->value) {
$_smarty_tpl->tpl_vars['ps']->_loop = true;
?>
    <div class="row">
        <div class="col-xs-12">
            <p class="payment_module">
                <a style="background:url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['img_ps_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
pay/<?php echo intval($_smarty_tpl->tpl_vars['ps']->value['id_universalpay_system']);?>
.jpg') no-repeat scroll 15px 15px #FBFBFB"
                   class="universalpay"
                        <?php if ($_smarty_tpl->tpl_vars['universalpay_onepage']->value) {?>
                            onclick='showForm(<?php echo intval($_smarty_tpl->tpl_vars['ps']->value['id_universalpay_system']);?>
)' href='javascript:;//Подробности'
                        <?php } else { ?>
                            href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('universalpay','payment',array('id_universalpay_system'=>$_smarty_tpl->tpl_vars['ps']->value['id_universalpay_system']),true), ENT_QUOTES, 'UTF-8', true);?>
"
                        <?php }?>
                   title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ps']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ps']->value['description_short'], ENT_QUOTES, 'UTF-8', true);?>

                </a>
                <?php if ($_smarty_tpl->tpl_vars['universalpay_onepage']->value) {?>
                <br/>
                <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('universalpay','validation',array(),true), ENT_QUOTES, 'UTF-8', true);?>
"
                      method="post" id="universalpay_hidden<?php echo intval($_smarty_tpl->tpl_vars['ps']->value['id_universalpay_system']);?>
" style="display:none;">
                    <div class="box cheque-box">
                        <?php echo $_smarty_tpl->tpl_vars['ps']->value['description'];?>

                    </div>
            <p>
                <b><?php echo smartyTranslate(array('s'=>'Please confirm your order by clicking "I confirm my order"','mod'=>'universalpay'),$_smarty_tpl);?>
</b>
            </p>
            <p class="cart_navigation clearfix">
                <input type="hidden" name="id_universalpay_system" value="<?php echo intval($_smarty_tpl->tpl_vars['ps']->value['id_universalpay_system']);?>
"/>
                <button class="button btn btn-default button-medium" type="submit">
                    <span><?php echo smartyTranslate(array('s'=>'I confirm my order','mod'=>'universalpay'),$_smarty_tpl);?>
<i class="icon-chevron-right right"></i></span>
                </button>
            </p>
            </form>
            <?php }?>
            </p>
        </div>
    </div>
<?php } ?>
<?php if ($_smarty_tpl->tpl_vars['universalpay_onepage']->value) {?>
    <script type="text/javascript">
        
        function showForm(a) {
            if ($('#universalpay_hidden' + a).is(':hidden'))
                $('#universalpay_hidden' + a).show();
            else
                $('#universalpay_hidden' + a).hide();
            return false;
        }
        ;
        
    </script>
<?php }?><?php }} ?>
