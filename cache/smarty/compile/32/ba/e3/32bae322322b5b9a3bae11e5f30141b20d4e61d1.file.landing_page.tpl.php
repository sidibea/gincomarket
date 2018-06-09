<?php /* Smarty version Smarty-3.1.19, created on 2018-06-07 14:00:00
         compiled from "/home/abdouhanne/www/modules/smartsupp/views/templates/admin/landing_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10844353245b193a6040d0a9-01675308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32bae322322b5b9a3bae11e5f30141b20d4e61d1' => 
    array (
      0 => '/home/abdouhanne/www/modules/smartsupp/views/templates/admin/landing_page.tpl',
      1 => 1494088849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10844353245b193a6040d0a9-01675308',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajax_controller_url' => 0,
    'smartsupp_key' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b193a60458793_21929552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b193a60458793_21929552')) {function content_5b193a60458793_21929552($_smarty_tpl) {?>

<script type="text/javascript">
    var ajax_controller_url = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['ajax_controller_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";    
</script>
<input id="smartsupp_key" type="hidden" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['smartsupp_key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
<div class="bootstrap smartsupp_landing_page">
        <div class="module_error alert alert-danger">
                <button class="close" data-dismiss="alert" type="button">×</button>
                <span></span>
        </div>
</div>
<div id="smartsupp_landing_page" class="panel">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/smartsupp_logo.png" alt="Smartsupp" />
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button id="connect_existing_account_btn1" class="btn btn-default pull-right"><?php echo smartyTranslate(array('s'=>'Connect existing account','mod'=>'smartsupp'),$_smarty_tpl);?>
</button>
		</div>
	</div>
	<hr/>
        <div class="row text-center">
                <div class="row">
                        <p class="title">
                                <strong><?php echo smartyTranslate(array('s'=>'Free live chat with visitor recording','mod'=>'smartsupp'),$_smarty_tpl);?>
</strong>
                        </p>
                        <p class="title">
                                <?php echo smartyTranslate(array('s'=>'Your customers are on your website right now.','mod'=>'smartsupp'),$_smarty_tpl);?>

                                <br/>
                                <?php echo smartyTranslate(array('s'=>'Chat with them and see what they do.','mod'=>'smartsupp'),$_smarty_tpl);?>

                        </p>
                        <div class="center-block">
                                <button id="create_account_btn1" class="btn btn-primary btn-lg"><?php echo smartyTranslate(array('s'=>'Create free account','mod'=>'smartsupp'),$_smarty_tpl);?>
</button>
                        </div>
                        <p class="col-lg-12 none">
                                <img class="dashboard" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/dashboard_en.png" alt="" /><br />
                        </p>
                </div>
        </div>
        <div class="row text-center">
                <div class="row">
                        <p class="one">
                                <strong class="heading"><?php echo smartyTranslate(array('s'=>'Enjoy unlimited agents and chats forever for free','mod'=>'smartsupp'),$_smarty_tpl);?>
</strong>
                                <br/>
                                <strong class="heading"><?php echo smartyTranslate(array('s'=>'or take advantage of premium packages with advanced features.','mod'=>'smartsupp'),$_smarty_tpl);?>
</strong>
                        </p>
                        <p>
                                <strong><?php echo smartyTranslate(array('s'=>'See all features on','mod'=>'smartsupp'),$_smarty_tpl);?>
 <a href="https://www.smartsupp.com/?utm_source=Prestashop&utm_medium=integration&utm_campaign=link" target="_blank"><?php echo smartyTranslate(array('s'=>'our website','mod'=>'smartsupp'),$_smarty_tpl);?>
</a>.</strong>
                        </p>
                </div>
        </div>
        <div class="row text-center advantages">
                <div class="col-lg-4 text-center">
                        <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/chat_with_visitors.png" alt="<?php echo smartyTranslate(array('s'=>'Chat with visitors in real-time','mod'=>'smartsupp'),$_smarty_tpl);?>
" />
                        <p class="heading one"><?php echo smartyTranslate(array('s'=>'Chat with visitors in real-time','mod'=>'smartsupp'),$_smarty_tpl);?>
</p>
                        <p class="column-60"><?php echo smartyTranslate(array('s'=>'Answering questions right away improves loyalty and helps you build closer relationship with your customers.','mod'=>'smartsupp'),$_smarty_tpl);?>
</p>
                </div>
                <div class="col-lg-4 text-center">
                        <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/increase_sales.png" alt="<?php echo smartyTranslate(array('s'=>'Increase online sales','mod'=>'smartsupp'),$_smarty_tpl);?>
" />
                        <p class="heading one"><?php echo smartyTranslate(array('s'=>'Increase online sales','mod'=>'smartsupp'),$_smarty_tpl);?>
</p>
                        <p class="column-60"><?php echo smartyTranslate(array('s'=>'Turn your visitors into customers. Visitors who chat with you buy up to 5x more often - measurable in Google Analytics.','mod'=>'smartsupp'),$_smarty_tpl);?>
</p>
                </div>
                <div class="col-lg-4 text-center">
                        <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/visitor_screen_recording.png" alt="<?php echo smartyTranslate(array('s'=>'Visitor screen recording','mod'=>'smartsupp'),$_smarty_tpl);?>
" />
                        <p class="heading one"><?php echo smartyTranslate(array('s'=>'Visitor screen recording','mod'=>'smartsupp'),$_smarty_tpl);?>
</p>
                        <p class="column-60"><?php echo smartyTranslate(array('s'=>'Watch visitor behavior on your store. You see his screen, mouse movement, clicks and what he filled into forms.','mod'=>'smartsupp'),$_smarty_tpl);?>
</p>
                </div>
        </div>
        <br/>
        <div class="row text-center">
                <p>
                        <strong class="heading"><?php echo smartyTranslate(array('s'=>'Trusted by more that 55 000 companies','mod'=>'smartsupp'),$_smarty_tpl);?>
</strong>
                </p>
                <div class="customers">
                        <a>
                                <img alt="ŠKODA AUTO" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/skoda.png">
                        </a>
                        <a>
                                <img alt="Gekko Computer" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/gekko_computer.png">
                        </a>
                        <a>
                                <img alt="Lememo" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/lememo.png">
                        </a>
                        <a>
                                <img alt="Vinoselección" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/vinoseleccion.png">
                        </a>
                        <a>
                                <img alt="Conrad" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
views/img/conrad.png">
                        </a>
                </div>
        </div>                                        
</div>
<?php }} ?>
