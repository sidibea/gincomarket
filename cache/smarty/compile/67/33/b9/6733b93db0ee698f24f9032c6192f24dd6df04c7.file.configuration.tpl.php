<?php /* Smarty version Smarty-3.1.19, created on 2018-06-07 14:00:00
         compiled from "/home/abdouhanne/www/modules/smartsupp/views/templates/admin/configuration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7114767755b193a604a6275-43440503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6733b93db0ee698f24f9032c6192f24dd6df04c7' => 
    array (
      0 => '/home/abdouhanne/www/modules/smartsupp/views/templates/admin/configuration.tpl',
      1 => 1494088849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7114767755b193a604a6275-43440503',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'smartsupp_email' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b193a604b75a1_81408082',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b193a604b75a1_81408082')) {function content_5b193a604b75a1_81408082($_smarty_tpl) {?>

<div id="smartsupp_configuration" class="panel">
	<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <p class="email none"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['smartsupp_email']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</p>
                </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
			<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/smartsupp_logo.png" alt="Smartsupp" />
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <button id="deactivate_chat_do" class="btn btn-default pull-right"><?php echo smartyTranslate(array('s'=>'Deactivate chat','mod'=>'smartsupp'),$_smarty_tpl);?>
</button>
		</div>
	</div>
        <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                    <p class="status-information">
                            <?php echo smartyTranslate(array('s'=>'Smartsupp chat is now visible on your website.','mod'=>'smartsupp'),$_smarty_tpl);?>

                            <br/>
                            <?php echo smartyTranslate(array('s'=>'Go to Smartsupp to start chatting with visitors, customize chat box design and access all features.','mod'=>'smartsupp'),$_smarty_tpl);?>

                    </p>
                    <div class="center-block">
                            <form action="https://dashboard.smartsupp.com" target="_blank">
                                    <input type="hidden" name="utm_source" value="Prestashop">
                                    <input type="hidden" name="utm_medium" value="integration">
                                    <input type="hidden" name="utm_campaign" value="link">
                                    <input type="submit" class="btn btn-primary btn-lg" value="<?php echo smartyTranslate(array('s'=>'Go to Smartsupp','mod'=>'smartsupp'),$_smarty_tpl);?>
">
                            </form>                        
                    </div>
                    <p style="padding-top: 5px;">
                            (<?php echo smartyTranslate(array('s'=>'This will open a new browser tab.','mod'=>'smartsupp'),$_smarty_tpl);?>
)
                    </p>
                </div>
                <div class="col-lg-4"></div>
        </div>
 </div><?php }} ?>
