<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:46:02
         compiled from "/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_setting/oviclayout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1145293919590614ca067fd7-27719993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0cc8b8500927f8ea012880da2b3d0c4e760288c' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_setting/oviclayout.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1145293919590614ca067fd7-27719993',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id_tab' => 0,
    'emptyOption' => 0,
    'postUrl' => 0,
    'current_option' => 0,
    'absoluteUrl' => 0,
    'selected_layout' => 0,
    'options' => 0,
    'option' => 0,
    'sidebarPages' => 0,
    'sidebarPage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590614ca15a759_76314529',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590614ca15a759_76314529')) {function content_590614ca15a759_76314529($_smarty_tpl) {?><ul class="nav nav-tabs" id="idTabs">
	<li <?php if ($_smarty_tpl->tpl_vars['id_tab']->value==0) {?> class="active"<?php }?>><a data-toggle="tab" href="#idTab1" class="tab-pane" title="<?php echo smartyTranslate(array('s'=>'Layout setting'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Layout setting'),$_smarty_tpl);?>
</a></li>
	
	<li <?php if ($_smarty_tpl->tpl_vars['id_tab']->value==2) {?> class="active"<?php }?>><a data-toggle="tab" href="#idTab3" class="tab-pane" title="<?php echo smartyTranslate(array('s'=>'Sidebar seting'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Sidebar seting'),$_smarty_tpl);?>
</a></li>
</ul>
<div id="LayoutControl" class="panel tab-content clearfix">
	<div id="idTab1" class="tab-pane <?php if ($_smarty_tpl->tpl_vars['id_tab']->value==0) {?> active<?php }?>">
        <?php if (!isset($_smarty_tpl->tpl_vars['emptyOption']->value)) {?>
            <div id="curent_option" class="panel">
    			<div class="panel-heading"><i class="icon-html5"></i><?php echo smartyTranslate(array('s'=>' Your current option'),$_smarty_tpl);?>
</div>
                <form id="column_popup" method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm">
                <input type="hidden" name="id_option" value="<?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)) {?><?php echo $_smarty_tpl->tpl_vars['current_option']->value->id_option;?>
<?php }?>"/>
                <div class="row row-padding-top">
        			<div class="col-md-3">
      					<img class="center-block img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/thumbnails/<?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['current_option']->value->image, $tmp)>0) {?><?php echo $_smarty_tpl->tpl_vars['current_option']->value->image;?>
<?php } else { ?>en.jpg<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['current_option']->value->name;?>
" />
        			</div>
    	            <div class="col-md-9">
    			        <h2><?php echo $_smarty_tpl->tpl_vars['current_option']->value->name;?>
</h2>
                        <hr />
    			        <h4><?php echo smartyTranslate(array('s'=>'Select layout'),$_smarty_tpl);?>
</h4>
        				<div class="row  colsetting-container">
                            <span class="fixed-width-lg radio_button">
                                
                                <?php if ((isset($_smarty_tpl->tpl_vars['current_option']->value->column)&&strpos($_smarty_tpl->tpl_vars['current_option']->value->column,"0")!==false)) {?>
                                    <input class="colsetting" type="radio" name="colsetting" id="3column" <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==0)||(!$_smarty_tpl->tpl_vars['selected_layout']->value)) {?>checked="checked"<?php }?> value="0"/>
                                    <label <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==0)||(!$_smarty_tpl->tpl_vars['selected_layout']->value)) {?>class="colactive"<?php }?> for="3column"><img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/3col.png" alt=""/></label>
                                <?php }?>
                                
                                <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value->column)&&strpos($_smarty_tpl->tpl_vars['current_option']->value->column,"1")!==false) {?>
                                    <input class="colsetting" type="radio" name="colsetting" id="leftonly" <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==1)) {?>checked="checked"<?php }?> value="1" />
                                    <label <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==1)) {?>class="colactive"<?php }?> for="leftonly"><img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/leftonly.png" alt=""/></label>
                                <?php }?>
                                
                                <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value->column)&&strpos($_smarty_tpl->tpl_vars['current_option']->value->column,"2")!==false) {?>
                                    <input class="colsetting" type="radio" name="colsetting" id="rightonly" <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==2)) {?>checked="checked"<?php }?> value="2" />
                                    <label <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==2)) {?>class="colactive"<?php }?> for="rightonly"><img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/rightonly.png" alt=""/></label>
                                <?php }?>
                                
                                <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value->column)&&substr_count($_smarty_tpl->tpl_vars['current_option']->value->column,"3")>0) {?>
                                    <input class="colsetting" type="radio" name="colsetting" id="nocolumn" <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==3)) {?>checked="checked"<?php }?> value="3" />
                                    <label <?php if ((isset($_smarty_tpl->tpl_vars['selected_layout']->value)&&$_smarty_tpl->tpl_vars['selected_layout']->value==3)) {?>class="colactive"<?php }?> for="nocolumn"><img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/full.png" alt=""/></label>
                                <?php }?>
                            </span>
        				</div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-default pull-right" name="submitChangeLayout">
                        <i class="process-icon-save"></i> Save</button>
                </div>
                </form>
    		</div> 
            <?php if (isset($_smarty_tpl->tpl_vars['options']->value)&&count($_smarty_tpl->tpl_vars['options']->value)>1) {?>
                <div class="panel">
                    <div class="panel-heading">
        				<i class="icon-cogs"></i><?php echo smartyTranslate(array('s'=>' Select an option'),$_smarty_tpl);?>

                    </div>
                    <div class="clearfix">
                    <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['option']->value['id_option']!=$_smarty_tpl->tpl_vars['current_option']->value->id_option) {?>
                        <div class="col-sm-4 col-lg-3 option_container">
        						<div class="theme-container">
        							<h4 class="theme-title"><?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
</h4>
        							<div class="thumbnail-wrapper">
                                        <div class="action-wrapper">
        								    <div class="action-overlay"></div>
                                            <div class="action-buttons">
                                                <div class="btn-group">
            										<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&amp;submitSelectOption&amp;&amp;id_option=<?php echo $_smarty_tpl->tpl_vars['option']->value['id_option'];?>
" class="btn btn-default">
            											<i class="icon-check"></i> <?php echo smartyTranslate(array('s'=>'Use this option'),$_smarty_tpl);?>

            										</a>
            									</div>
                                            </div>
                                        </div>
                                        <img class="center-block img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/thumbnails/<?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['option']->value['image'], $tmp)>0) {?><?php echo $_smarty_tpl->tpl_vars['option']->value['image'];?>
<?php } else { ?>en.jpg<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
" />
        							</div>
                                    <div class="colsetting-container">
                                        <div class="colsetting-wrapper">
                                            <h4 class="theme-title">Support Layout</h4>
                                            <label <?php if (strpos($_smarty_tpl->tpl_vars['option']->value['column'],"0")!==false) {?>class="colactive"<?php }?>>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/3col.png" alt=""/>
                                            </label>
                                            <label <?php if (strpos($_smarty_tpl->tpl_vars['option']->value['column'],"1")!==false) {?>class="colactive"<?php }?>>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/leftonly.png" alt=""/>
                                            </label>
                                            <label <?php if (strpos($_smarty_tpl->tpl_vars['option']->value['column'],"2")!==false) {?>class="colactive"<?php }?>>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/rightonly.png" alt=""/>
                                            </label>
                                            <label <?php if (strpos($_smarty_tpl->tpl_vars['option']->value['column'],"3")!==false) {?>class="colactive"<?php }?>>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
/img/full.png" alt=""/>
                                            </label>
                                        </div>
                                    </div>
        						</div>
        					</div>
                            <?php }?>
                    <?php } ?>
                    </div>
                </div>
            <?php }?>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_smarty_tpl->tpl_vars['emptyOption']->value;?>

            </div>
        <?php }?>
    </div>
    
    <div id="idTab3" class="tab-pane <?php if ($_smarty_tpl->tpl_vars['id_tab']->value==2) {?> active<?php }?>">
        <div class="panel">
            <div class="panel-heading">
	           <i class="icon-columns"></i> <?php echo smartyTranslate(array('s'=>'Appearance of columns'),$_smarty_tpl);?>

            </div>
            <table class="table">
                <thead>
                    <th><?php echo smartyTranslate(array('s'=>'Meta'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Left column'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Right column'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Action'),$_smarty_tpl);?>
</th>
                </thead>
                <tbody>
                    <?php if (isset($_smarty_tpl->tpl_vars['sidebarPages']->value)&&$_smarty_tpl->tpl_vars['sidebarPages']->value&&count($_smarty_tpl->tpl_vars['sidebarPages']->value)>0) {?>
                        <?php  $_smarty_tpl->tpl_vars['sidebarPage'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sidebarPage']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sidebarPages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sidebarPage']->key => $_smarty_tpl->tpl_vars['sidebarPage']->value) {
$_smarty_tpl->tpl_vars['sidebarPage']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['sidebarPage']->value['page_name']!=='index') {?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['title'];?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['sidebarPage']->value['displayLeft']) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['postUrl']->value;?>
&changeleftactive&pagemeta=<?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['page_name'];?>
&id_tab=2" data-toggle="tooltip" class="label-tooltip list-action-enable action-enabled" data-html="true" data-original-title="Actived" >
                                            <i class="icon-check"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['postUrl']->value;?>
&changeleftactive&pagemeta=<?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['page_name'];?>
&id_tab=2" data-toggle="tooltip" class="label-tooltip list-action-enable action-disabled" data-html="true" data-original-title="Deactived" >
                                            <i class="icon-remove"></i>
                                        </a>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['sidebarPage']->value['displayRight']) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['postUrl']->value;?>
&changerightactive&pagemeta=<?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['page_name'];?>
&id_tab=2" data-toggle="tooltip" class="label-tooltip list-action-enable action-enabled" data-html="true" data-original-title="Actived" >
                                            <i class="icon-check"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['postUrl']->value;?>
&changerightactive&pagemeta=<?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['page_name'];?>
&id_tab=2" data-toggle="tooltip" class="label-tooltip list-action-enable action-disabled" data-html="true" data-original-title="Deactived" >
                                            <i class="icon-remove"></i>
                                        </a>
                                    <?php }?>
                                </td>
                                <td>
                                <div class="btn-group-action">
                                    <div class="btn-group pull-right">

                                        <?php if ($_smarty_tpl->tpl_vars['sidebarPage']->value['displayLeft']||$_smarty_tpl->tpl_vars['sidebarPage']->value['displayRight']) {?>
                					       <a href="<?php echo $_smarty_tpl->tpl_vars['postUrl']->value;?>
&view=detail&pagemeta=<?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['page_name'];?>
" title="Configure" class="btn btn-default">
                    	                       <i class="icon-wrench"></i> Configure
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['postUrl']->value;?>
&view=detail&pagemeta=<?php echo $_smarty_tpl->tpl_vars['sidebarPage']->value['page_name'];?>
" title="Configure" class="btn btn-default disabled">
                    	                       <i class="icon-wrench"></i> Configure
                                            </a>
                                        <?php }?>
                                    </div>
                				</div>
                            </td>
                            </tr>
                            <?php }?>
                        <?php } ?>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div><?php }} ?>
