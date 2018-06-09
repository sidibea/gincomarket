<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:20
         compiled from "/home/abdouhanne/www/themes/supershop/modules/multistyle/multistyle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6456365725b1a5fa84b2193-71085720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dc53419543433466b3322975b3d14c6ef16e660' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/multistyle/multistyle.tpl',
      1 => 1493588701,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6456365725b1a5fa84b2193-71085720',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'linkfont' => 0,
    'fontname' => 0,
    'linkcolor' => 0,
    'linkHovercolor' => 0,
    'btncolor' => 0,
    'btnHovercolor' => 0,
    'maincolor' => 0,
    'mainhovercolor' => 0,
    'btntextcolor' => 0,
    'btntextHovercolor' => 0,
    'grbacolor' => 0,
    'option1Secondcolor' => 0,
    'option2Secondcolor' => 0,
    'option3Secondcolor' => 0,
    'option4Secondcolor' => 0,
    'option5Secondcolor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fa86665e9_42803294',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fa86665e9_42803294')) {function content_5b1a5fa86665e9_42803294($_smarty_tpl) {?><?php echo html_entity_decode($_smarty_tpl->tpl_vars['linkfont']->value);?>

<style type="text/css">
    /***  Font default ***/
    .mainFont{
        font-family:<?php echo $_smarty_tpl->tpl_vars['fontname']->value;?>
!important;
    }
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        font-family: <?php echo $_smarty_tpl->tpl_vars['fontname']->value;?>
;
    }

    /*** Link color class ***/
    .linkcolor{
        color:<?php echo $_smarty_tpl->tpl_vars['linkcolor']->value;?>
!important;
    }
    .linkcolor:hover{
        color:<?php echo $_smarty_tpl->tpl_vars['linkHovercolor']->value;?>
!important;
    }

    /*** Button color class ***/
    .btnbgcolor{
        color:<?php echo $_smarty_tpl->tpl_vars['btncolor']->value;?>
!important;
    }
    .btnbgcolor:hover{
        color:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
!important;
    }

    /*** Main color class ***/
    .mainColor,.mainHoverColor,.mainColorHoverOnly:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
!important;
    }

    /*** Color hover ***/
    .mainHoverColor:hover{
        color:<?php echo $_smarty_tpl->tpl_vars['mainhovercolor']->value;?>
!important;
    }

    /*** background not change on hover ***/
    .mainBgColor,.mainBgHoverColor {
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
!important;
    }

    /*** background change on hover ***/
    .mainBgHoverColor:hover,.mainBgHoverOnly:hover{
        background-color:<?php echo $_smarty_tpl->tpl_vars['mainhovercolor']->value;?>
!important;
    }

    /*** border only hover ***/
    .mainBorderColor, .mainBorderHoverColor {
        border-color:<?php echo $_smarty_tpl->tpl_vars['mainhovercolor']->value;?>
!important;
    }
    .mainBorderLight, .mainBorderHoverColor:hover, .mainBorderHoverOnly:hover{
        border-color:<?php echo $_smarty_tpl->tpl_vars['mainhovercolor']->value;?>
!important;
    }
    dt.mainHoverColor:hover .product-name a{
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    dt.mainHoverColor:hover .cart-images{
        border-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /*******************************************/
    /**            ThemeStyle                 **/
    /*******************************************/

    /** Theme Button **/
    
    .button.button-small {
        background:<?php echo $_smarty_tpl->tpl_vars['btncolor']->value;?>
;
    }

    .button.button-medium,
    .button.button-small,
    .button.exclusive-medium,
    .button.exclusive-small {
        color:<?php echo $_smarty_tpl->tpl_vars['btntextcolor']->value;?>
;
    }
    
    .button.button-medium:hover,
    .button.button-small:hover,
    .button.exclusive-medium:hover,
    .button.exclusive-small:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['btntextHovercolor']->value;?>
;
    }

    input.button_mini:hover,
    input.button_small:hover,
    input.button:hover,
    input.button_large:hover,
    input.exclusive_mini:hover,
    input.exclusive_small:hover,
    input.exclusive:hover,
    input.exclusive_large:hover,
    a.button_mini:hover,
    a.button_small:hover,
    a.button:hover,
    a.button_large:hover,
    a.exclusive_mini:hover,
    a.exclusive_small:hover,
    a.exclusive:hover,
    a.exclusive_large:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

    input.button_mini:active,
    input.button_small:active,
    input.button:active,
    input.button_large:active,
    input.exclusive_mini:active,
    input.exclusive_small:active,
    input.exclusive:active,
    input.exclusive_large:active,
    a.button_mini:active,
    a.button_small:active,
    a.button:active,
    a.button_large:active,
    a.exclusive_mini:active,
    a.exclusive_small:active,
    a.exclusive:active,
    a.exclusive_large:active {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

    .button.button-small span:hover,
    .button.button-medium:hover,
    .button.exclusive-medium span:hover,
    .button.exclusive-medium span:hover span {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

    .button.ajax_add_to_cart_button:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    .button.ajax_add_to_cart_button:hover {
        border-color:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

     .button.lnk_view:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
        border-color:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

     .footer_link .button.lnk_view.btn-default:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

     /* Breadcrumb */
     .breadcrumb a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Navigation button*/
    .cart_navigation .button-exclusive:hover,
    .cart_navigation .button-exclusive:hover,
    .cart_navigation .button-exclusive:active {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

    /* Header */
    header .nav #text_top a {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    header .row .shopping_cart > a:first-child:before {
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

     /* OWL button */
     .owl-buttons div:hover {
        background-color:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
        border-color: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    #best-sellers_block_right .owl-prev:hover, 
    #best-sellers_block_right .owl-next:hover {
        background-color:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
        border-color: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

    /* CMS module */
    /*
    #cms_pos .header-toggle li a,
    #cms_pos .cms-toggle li a, 
    .header-toggle a, 
    .currencies_ul li a, 
    .languages-block_ul li span {
        color:<?php echo $_smarty_tpl->tpl_vars['linkcolor']->value;?>
!important;
    }
    
    #cms_pos .header-toggle li a:hover,
    #cms_pos .cms-toggle li a:hover,
    .header-toggle a:hover, 
    .currencies_ul li a:hover, 
    .languages-block_ul li:hover span {
        color:<?php echo $_smarty_tpl->tpl_vars['linkHovercolor']->value;?>
!important;
    }
    */

    /* Advanced topmenu module */
    #nav_topmenu ul.nav > li.active > a,
    #nav_topmenu ul.nav > li > a:hover,
    #nav_topmenu ul.nav > li.open > a {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    #nav_topmenu ul.nav > li.active.dropdown > a:after,
    #nav_topmenu ul.nav > li.dropdown > a:hover:after,
    #nav_topmenu ul.nav > li.dropdown.open > a:after {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    #nav_topmenu ul.nav .list ul.block li.level-2:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Block cart module */
    .shopping_cart span.ajax_cart_total,
    .cart_block .cart-info .product-name a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .cart_block .cart-buttons a#button_order_cart span {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .cart_block .cart-buttons a#button_order_cart span {
        color:<?php echo $_smarty_tpl->tpl_vars['btntextcolor']->value;?>
;
    }
    .cart_block .cart-buttons a#button_order_cart:hover span {
        color:<?php echo $_smarty_tpl->tpl_vars['btntextHovercolor']->value;?>
;
    }
    #layer_cart .layer_cart_cart .button-container span.exclusive-medium i {
        color:<?php echo $_smarty_tpl->tpl_vars['btntextcolor']->value;?>
;
    }
    #layer_cart .layer_cart_cart .button-container span.exclusive-medium:hover i {
        color:<?php echo $_smarty_tpl->tpl_vars['btntextHovercolor']->value;?>
;
    }
    
    /* Module: Vertical megamenus */
    .vertical-megamenus h4.title {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Blog */
    #submitComment:hover{
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    
    /* Module: Tabs 3 module on home page */
     .owl-nav .owl-next:hover, .owl-nav .owl-prev:hover,
    .tab-content .owl-carousel .owl-controls .owl-nav .owl-next:hover, 
    .tab-content .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
    .option5 .tab-content .owl-carousel .owl-controls .owl-nav .owl-next:hover, 
    .option5 .tab-content .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
    .option2 .tab-content .owl-carousel .owl-controls .owl-nav .owl-next:hover, 
    .option2 .tab-content .owl-carousel .owl-controls .owl-nav .owl-prev:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    
    #home-popular-tabs > li.active, #home-popular-tabs > li.active:hover, #home-popular-tabs > li:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .owl-carousel .owl-controls .owl-nav .owl-next:hover, .owl-carousel .owl-controls .owl-nav .owl-prev:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Homeslider */
    #homepage-slider .bx-wrapper .bx-controls-direction a:hover:before {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    #layer_cart .button.exclusive-medium span:hover, #layer_cart .button.exclusive-medium span.mainBgHoverColor:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
!important;
    }
    
    /* Module: Discount product - Deal of the day */
    h2.heading-title .coundown-title i.icon-time {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    #discountproducts_list .owl-nav .owl-next:hover, 
    #discountproducts_list .owl-nav .owl-prev:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    } 

    /* Module: Block html */
    #blockhtml_displayTopColumn h1 i,
    h1.heading-title .coundown-title i.icon-time {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Module: Home category */
    .home-category .nav-tabs > li.active > a,.home-category .nav-tabs > li.active > a:hover,
    .home-category .nav-tabs > li.active > a:focus,
    .home-category .nav-tabs > li > a:hover,.home-category .nav-tabs > li > a:focus {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Module: Testimonial */
    #testimonial_block .block_testimonial_name {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Module: Brand slide */
    #brands_slider .brands_slide_wrapper, #brands_slider .brands_list_wrapper {
        background:<?php echo $_smarty_tpl->tpl_vars['grbacolor']->value;?>
;
    }

    /*  */
    #footer #advancefooter #newsletter_block_left .form-group .button-small span {
        color: <?php echo $_smarty_tpl->tpl_vars['btntextcolor']->value;?>
;
    }
    .footer-container #footer #advancefooter #block_contact_infos > div ul li i {
        color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .footer-container {
        border-top: 1px solid <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Product list */
    .option2 ul.product_list li .product-name:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    ul.product_list .button.ajax_add_to_cart_button,
    .option2 .functional-buttons .button.ajax_add_to_cart_button,
    .option2 .flexible-custom-groups ul li.active, 
    .option2 .flexible-custom-groups ul li:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    .option5 ul.product_list li .product-name:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    ul.product_list .button.ajax_add_to_cart_button,
    .option5 .functional-buttons .button.ajax_add_to_cart_button,
    .option5 .flexible-custom-groups ul li.active, 
    .option5 .flexible-custom-groups ul li:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
 
    
    ul.product_list.grid > li .product-container .functional-buttons .quick-view:hover, 
    ul.product_list.grid > li .product-container .functional-buttons .quick-view:hover i,
    ul.product_list .functional-buttons div a:hover, 
    ul.product_list .functional-buttons div label:hover, 
    ul.product_list .functional-buttons div.compare a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
!important;
    }
    ul.product_list.list .functional-buttons a.quick-view:hover, 
    ul.product_list.list .functional-buttons div.compare a:hover, 
    ul.product_list.list .functional-buttons div.wishlist a:hover {
        border-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    ul.product_list .button.ajax_add_to_cart_button:hover,
    ul.product_list .functional-buttons div.compare a:hover,
    ul.product_list.list .button.ajax_add_to_cart_button:hover {
        /* border-color: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
; */
    }

    /* Blocklayered */
    .layered_price .layered_slider,
    .layered_price .ui-slider-horizontal .ui-slider-range {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .layered_price .ui-state-default, 
    .layered_price .ui-widget-content .ui-state-default, 
    .layered_price .ui-widget-header .ui-state-default {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Page: Category */
    #subcategories ul li a:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        border: 1px solid <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .content_sortPagiBar .display li.selected a, 
    .content_sortPagiBar .display_m li.selected a, 
    .display li.selected a, .display_m li.selected a,
    .content_sortPagiBar .display li a:hover, 
    .content_sortPagiBar .display_m li a:hover, 
    .display li a:hover, .display_m li a:hover {
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .button.button-medium.bt_compare {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    .pagination > li.pagination_next > a:hover, 
    .pagination > li.pagination_next > a:hover, 
    .pagination > li.pagination_next > span:hover, 
    .pagination > li.pagination_next > span:hover, 
    .pagination > li.pagination_previous > a:hover, 
    .pagination > li.pagination_previous > a:hover, 
    .pagination > li.pagination_previous > span:hover, 
    .pagination > li.pagination_previous > span:hover {
        color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .pagination > .active > a, 
    .pagination > .active > a:hover, 
    .pagination > .active > a:hover, 
    .pagination > .active > span, 
    .pagination > .active > span:hover, 
    .pagination > .active > span:hover {
        color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    /* Page: Product */
    #product .primary_block .box-info-product label.label_radio:hover,
    #product .primary_block .box-info-product label.label_radio.checked,
    #thumbs_list li a:hover, #thumbs_list li a.shown {
        border-color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    #view_scroll_left:hover:before, #view_scroll_right:hover:before {
        background: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
        border-color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .buttons_bottom_block #wishlist_button:hover, .box-info-product #add_to_compare:hover,
    .buttons_bottom_block #wishlist_button:before:hover, .box-info-product #add_to_compare:before:hover,
    #thumbs_list li a.shown:before {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    #nav_page a:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        border-color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    .box-info-product .exclusive {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    #box-product #size_chart:hover,
    #usefull_link_block li a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Block Search */
    .ac_results li.ac_over {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
!important;
    }
    
    /* Module: Product category */
    .blockproductscategory a#productscategory_scroll_left:hover, 
    .blockproductscategory a#productscategory_scroll_right:hover {
        border-color: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
        background: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }

    /* Page: About us */
    #cms #row-middle .title_block_cms:after {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }

    #cms ul.social_cms li a:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    #cms ul.social_cms li a:hover {
        border-color:<?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    } 
    
    /* Scroll to top */
    .scroll_top:hover {
        background: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    
    /* Title block font */
    .columns-container .block .title_block,
    .columns-container .block h4 {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .columns-container .block .title_block,
    .columns-container .block h4 {
        font-family: <?php echo $_smarty_tpl->tpl_vars['fontname']->value;?>
;
    }
    
     /* Footer links */
    #footer #advancefooter #footer_row2 ul.bullet li:hover,
    .footer-container #footer #advancefooter ul li a:hover,
    .footer-container #footer #advancefooter #tags_block_footer a:hover {
        color: <?php echo $_smarty_tpl->tpl_vars['linkHovercolor']->value;?>
;
    }
    
/*******************************************************
** Option1 Second Color **
********************************************************/
    /* Product List Option1 */
    .option1 ul.product_list li .product-name:hover {
    	color: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }  
    .option1 ul.product_list .button.ajax_add_to_cart_button:hover {
    	background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }  
    
    /* OWL Button Option1 */
    .option1 #best-sellers_block_right .owl-prev:hover, 
    .option1 #best-sellers_block_right .owl-next:hover {
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        border-color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option1 .button.button-medium.bt_compare:hover{
        background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    /* Module: Mega Top Menu Option1 */
    @media (min-width: 768px) {
        .option1 #topmenu {
        	background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
        }   
    }
    
    .option1 #nav_top_links a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    .option1 #nav_topmenu ul.nav > li.active:first-child a {
        /* background-color: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
; */
    }
    
    /* Module: Vertical megamenus Option1 */
    .option1 .vertical-megamenus span.new-price {
        color: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    .option1 .mega-group-header span {
        border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    @media (min-width: 768px) {
        .option1 .vertical-megamenus ul.megamenus-ul li:hover {
            border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
        }
    }
    @media (max-width: 767px) {
        .option1 .vertical-megamenus li.dropdown.open {
            background:<?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
        }
    }
    .option1 .vertical-megamenus ul.megamenus-ul li.active {
    	border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    
    /* Module: Block search Option1 */
    .option1 #search_block_top .btn.button-search {
        background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    
    /* Module: Newsletter Option1 */
    .option1 #footer #advancefooter #newsletter_block_left .form-group .button-small {
        background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    
    /* Module: Block cart Option1 */
    .option1 .cart_block .cart-buttons a span {
        background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    
    /* Menuontop option1 */
    .option1 #nav_topmenu.menuontop {
        background: <?php echo $_smarty_tpl->tpl_vars['option1Secondcolor']->value;?>
;
    }
    
/*******************************************************
** Option2 Color **
********************************************************/
      
    /* Header Option2 */
    .option2 #page #header {
        background: <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    
    /* Product List Option2 */
    .option2 ul.product_list.grid > li .product-container .price.product-price,
    .option2 ul.product_list li .product-name:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option2 .functional-buttons .button.ajax_add_to_cart_button,
    .option2 .flexible-custom-groups ul li.active, 
    .option2 .flexible-custom-groups ul li:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option2 ul.product_list .button.ajax_add_to_cart_button:hover,
    .option2 .functional-buttons .button.ajax_add_to_cart_button:hover {
    	background: <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    
    /* Module: Flexible Brand Option2 */
    .option2 .flexible-brand-groups .module-title,
    .option2 .button-medium.bt_compare:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    .option2 .flexible-brand-list li:hover a, 
    .option2 .flexible-brand-list li.active a {
        border-left-color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .flexible-custom-products .product-name:hover,
    .flexible-custom-products .content_price .price.product-price,
    .flexible-brand-products .content_price .price.product-price,
    .option2 .flexible-brand-products .product-name:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option2 .flexible-custom-products .functional-buttons a.quick-view:hover, 
    .option2 .flexible-custom-products .functional-buttons div a:hover,
    .option2 .flexible-brand-products .functional-buttons a.quick-view:hover, 
    .option2 .flexible-brand-products .functional-buttons div a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Vertical megamenus Option2 */
    .option2 .vertical-megamenus span.new-price {
        color: <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    .option2 .mega-group-header span {
        border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    @media (min-width: 768px) {
        .option2 .vertical-megamenus ul.megamenus-ul li:hover {
            border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
        }
    }
    @media (max-width: 767px) {
        .option2 .vertical-megamenus li.dropdown.open {
            background:<?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
        }
    }
    .option2 .vertical-megamenus ul.megamenus-ul li.active {
    	border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    
    /* Module: Newsletter Option2 */
    .option2 #footer #advancefooter #newsletter_block_left .form-group .button-small {
        background: <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    
    /* Module: Block cart Option2 */
    .option2 header .shopping_cart span.ajax_cart_quantity {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option2 .cart_block .cart-buttons a span {
        background: <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    
    /* OWL Nav Option2 */
    .option2 .owl_wrap .owl-controls .owl-nav .owl-next:hover, 
    .option2 .owl_wrap .owl-controls .owl-nav .owl-prev:hover {
        background: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    
    /* Module: Block Search Option2*/
    .option2 #search_block_top .btn.button-search {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Block User Info Option2 */
    .option2 header #currencies-block-top div.current:hover:after, 
    .option2 header #languages-block-top div.current:hover:after,
    .option2 header .header_user_info a.header-toggle-call:hover:after {
        color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option2 #nav_topmenu.menuontop,    
    .option2 #nav_topmenu.menuontop #topmenu {
        background: <?php echo $_smarty_tpl->tpl_vars['option2Secondcolor']->value;?>
;
    }
    
    
/*******************************************************
** Option3 Second Color **
********************************************************/
    /* Header option3 */
    .option3 #page #header {
        background: <?php echo $_smarty_tpl->tpl_vars['option3Secondcolor']->value;?>
;
    }
    
    /* Module: Mega Menu Top Header */
    .option3 #nav_topmenu ul.nav > li.mega_menu_item > a:hover {
        background-color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    @media (max-width: 767px) {
        .option3 #nav_topmenu .navbar-header {
            background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;    
        }
    }    
    
    /* Module: Search with image */
    .option3 #search_block_top, .option3 #search_block_top #search_query_top, .option3 #call_search_block:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    
    /* Module: Newsletter */
    .option3 #footer #advancefooter #newsletter_block_left .form-group .button-small {
        background: <?php echo $_smarty_tpl->tpl_vars['option3Secondcolor']->value;?>
;
    }
    
    /* Module: Block cart  */
    .option3 header#header .shopping_cart,
    .option3 header .row .shopping_cart > a:first-child,
    .option3 .cart_block .cart-buttons a span {
        background: <?php echo $_smarty_tpl->tpl_vars['option3Secondcolor']->value;?>
;
    }
    .option3 header .row .shopping_cart > a:first-child:before {
        background-color: <?php echo $_smarty_tpl->tpl_vars['option3Secondcolor']->value;?>
;
    }
    .option3 header .shopping_cart span.ajax_cart_quantity {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Slideshow option3 */
    .option3 .displayHomeSlider .tp-rightarrow.default:hover:before, 
    .option3 .displayHomeSlider .tp-rightarrow:hover:before, 
    .option3 .displayHomeSlider .tp-leftarrow.default:hover:before, 
    .option3 .displayHomeSlider .tp-leftarrow:hover:before {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
/*******************************************************
** Option4 Second Color **
********************************************************/
 /* Product List option4 */
    .option4 ul.product_list li .product-name:hover {
    	color: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }  
    .option4 ul.product_list .button.ajax_add_to_cart_button:hover {
    	background: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }  
    /* Module: Mega Top Menu option4 */
    @media (min-width: 768px) {
        .option4 .main-top-menus,
        .option4 #topmenu {
        	background: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
        }    
    }
    
    .option4 #nav_top_links a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
    .option4 #nav_topmenu ul.nav > li.level-1.active:first-child a {
        /* background-color: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
; */
    }
    
    /* Module: Vertical megamenus option4 */
    .option4 .vertical-megamenus span.new-price {
        color: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
    .option4 .mega-group-header span {
        border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
    @media (min-width: 768px) {
        .option4 .vertical-megamenus ul.megamenus-ul li:hover {
            border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
        }
    }
    @media (max-width: 767px) {
        .option4 .vertical-megamenus li.dropdown.open {
            background:<?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
        }
    }
    .option4 .vertical-megamenus ul.megamenus-ul li.active {
    	border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
    
    /* Module: Block search option4 */
    .option4 #search_block_top .btn.button-search {
        background: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
    
    /* Module: Newsletter option4 */
    .option4 #footer #advancefooter #newsletter_block_left .form-group .button-small {
        background: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
    
    /* Module: Block cart option4 */
    .option4 .cart_block .cart-buttons a span {
        background: <?php echo $_smarty_tpl->tpl_vars['option4Secondcolor']->value;?>
;
    }
 /*******************************************************
** Option5 Color **
********************************************************/
      
    
    /* Product List option5 */
    .option5 ul.product_list.grid > li .product-container .price.product-price,
    .option5 ul.product_list li .product-name:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option5 .functional-buttons .button.ajax_add_to_cart_button,
    .option5 .flexible-custom-groups ul li.active, 
    .option5 .flexible-custom-groups ul li:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option5 ul.product_list .button.ajax_add_to_cart_button:hover,
    .option5 .functional-buttons .button.ajax_add_to_cart_button:hover {
    	background: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    
    /* Module: Flexible Brand option5 */
    .option5 .flexible-brand-groups .module-title,
    .option5 .button-medium.bt_compare:hover {
        background:<?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    .option5 .flexible-brand-list li:hover a, 
    .option5 .flexible-brand-list li.active a {
        border-left-color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .flexible-custom-products .product-name:hover,
    .flexible-custom-products .content_price .price.product-price,
    .flexible-brand-products .content_price .price.product-price,
    .option5 .flexible-brand-products .product-name:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    .option5 .flexible-custom-products .functional-buttons a.quick-view:hover, 
    .option5 .flexible-custom-products .functional-buttons div a:hover,
    .option5 .flexible-brand-products .functional-buttons a.quick-view:hover, 
    .option5 .flexible-brand-products .functional-buttons div a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Vertical megamenus option5 */
    .option5 .vertical-megamenus span.new-price {
        color: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    .option5 .mega-group-header span {
        border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    @media (min-width: 768px) {
        .option5 .vertical-megamenus ul.megamenus-ul li:hover {
            border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
        }
    }
    @media (max-width: 767px) {
        .option5 .vertical-megamenus li.dropdown.open {
            background:<?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
        }
    }
    .option5 .vertical-megamenus ul.megamenus-ul li.active {
    	border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    
    /* Module: Newsletter option5 */
    .option5 #footer #advancefooter #newsletter_block_left .form-group .button-small {
        background: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    
    /* Module: Block cart option5 */
    .option5 .cart_block .cart-buttons a span {
        background: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    
    /* OWL Nav option5 */
    .option5 .owl_wrap .owl-controls .owl-nav .owl-next:hover, 
    .option5 .owl_wrap .owl-controls .owl-nav .owl-prev:hover {
        background: <?php echo $_smarty_tpl->tpl_vars['btnHovercolor']->value;?>
;
    }
    
    /* Module: Block Search option5*/
    .option5 #search_block_top .btn.button-search {
        background: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    /* Module: Block User Info option5 */
    .option5 header #currencies-block-top div.current:hover:after, 
    .option5 header #languages-block-top div.current:hover:after,
    .option5 header .header_user_info a.header-toggle-call:hover:after {
        color: <?php echo $_smarty_tpl->tpl_vars['maincolor']->value;?>
;
    }
    
    @media (min-width: 768px) {
        .option5 #topmenu {
        	background: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
        }   
    }
    
    .option5 #nav_top_links a:hover {
        color:<?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }
    .option5 #nav_topmenu ul.nav > li.active:first-child a {
        /* background-color: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
; */
    }
    
    /* Menuontop option1 */
    .option5 #nav_topmenu.menuontop {
        background: <?php echo $_smarty_tpl->tpl_vars['option5Secondcolor']->value;?>
;
    }

</style><?php }} ?>
