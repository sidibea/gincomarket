<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:24
         compiled from "/home/abdouhanne/www/modules/agilemultipleseller//views/templates/hook/hookproducttabcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8261856035b1a5facb3c6f6-94287620%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de3d7ec7ff01447abde53763f0332ca807ced0cb' => 
    array (
      0 => '/home/abdouhanne/www/modules/agilemultipleseller//views/templates/hook/hookproducttabcontent.tpl',
      1 => 1495227186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8261856035b1a5facb3c6f6-94287620',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
    'sellerInfo' => 0,
    'isVertical' => 0,
    'show_seller_store_link' => 0,
    'link' => 0,
    'goreviewtab' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5facb859a5_27726279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5facb859a5_27726279')) {function content_5b1a5facb859a5_27726279($_smarty_tpl) {?><script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
js/common.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
js/googlemaps.js"></script>
<script type="text/javascript">
    var map;
    var geocoder = new google.maps.Geocoder();
    var markersArray = [];

   $(document).ready(function() 
   {
        initializeMap(<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->latitude;?>
,<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->longitude;?>
 , 12, "map_canvas");
        loc = new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->latitude;?>
, <?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->longitude;?>
);
        addMarker('0',loc);
    }
    );



</script>
<?php if ($_smarty_tpl->tpl_vars['isVertical']->value==1) {?>
<h3 class="idTabHrefShort page-product-heading"><?php echo smartyTranslate(array('s'=>'Seller Info/Map','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h3>
<?php }?>
<div id="idTab19" class="rte">
  <div class="row">
		<div class="margin-form clearfix" style="float:left;margin-left:20px;">
            <h3><?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->company;?>
</h3>
		    <table cellpadding="2" cellspacing="5">
		    <tr>
		    <td valign="top" align="middle" style="padding:10px;">				
				<?php if ($_smarty_tpl->tpl_vars['show_seller_store_link']->value==1) {?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAgileSellerLink($_smarty_tpl->tpl_vars['sellerInfo']->value->id_seller,$_smarty_tpl->tpl_vars['sellerInfo']->value->company);?>
" class="btn btn-default button button-small">
				<?php }?>
			    <img src="<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->get_seller_logo_url();?>
" width="120" />
				<?php if ($_smarty_tpl->tpl_vars['show_seller_store_link']->value==1) {?>
					</a>
					<br>
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['show_seller_store_link']->value==1) {?>
					<br>
					<p><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAgileSellerLink($_smarty_tpl->tpl_vars['sellerInfo']->value->id_seller,$_smarty_tpl->tpl_vars['sellerInfo']->value->company);?>
" class="btn btn-default button button-small">
						<span><?php echo smartyTranslate(array('s'=>'Visit Seller Store','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
						</a>
					</p>
				<?php }?>
		    </td>
	    
		    <td valign="top" style="padding:10px;">
		        <b><?php echo smartyTranslate(array('s'=>'Address:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</b><br />
		        	<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->address1;?>
<br />
		        	<?php if ($_smarty_tpl->tpl_vars['sellerInfo']->value->address2) {?><?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->address2;?>
<br /><?php }?>
		        	<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->city;?>
, <?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->state;?>
 <?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->postcode;?>
<br />
		        	<?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->country;?>
 <br /><br />
		        <?php if ($_smarty_tpl->tpl_vars['sellerInfo']->value->phone) {?>

    		    <b><?php echo smartyTranslate(array('s'=>'Phone:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</b><br /><?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->phone;?>
<br />
		        <?php }?>
                <br />
		        <?php echo $_smarty_tpl->tpl_vars['sellerInfo']->value->description;?>

		    </td>
		    </tr>
		    </table>
		</div>


		<div class="margin-form" style="float:right;">
    	    <div id="map_canvas" style="width:480px;height:250px;padding:0px;margin:0px;"></div>
		</div>
 </div>       
</div>
<script type="text/javascript">
	var goreviewtab = <?php echo $_smarty_tpl->tpl_vars['goreviewtab']->value;?>
;///integration with agile product review
	function switchbacktomoreinfo()
	{
		if(goreviewtab !== 1)
		    $("#more_info_block ul").idTabs("idTab1"); 
	}

    $("#more_info_tabs").idTabs("idTab19"); //make google map show first
	setTimeout("switchbacktomoreinfo()",600);
</script>
<?php }} ?>
