<?php /*
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/store/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///
*/
${"\x47\x4c\x4f\x42\x41L\x53"}["j\x65j\x78\x68\x65m"]="\x6frd\x65r\x73";${"G\x4c\x4fB\x41L\x53"}["\x66\x63\x68up\x76\x62"]="\x6f\x72\x64\x65\x72\x5f\x6e\x62";class AgileMultipleSellerSellerOrdersModuleFrontController extends AgileModuleFrontController{public function setMedia(){parent::setMedia();$this->addCSS(_THEME_CSS_DIR_."\x68i\x73\x74or\x79\x2e\x63\x73s");$this->addCSS(_THEME_CSS_DIR_."a\x64\x64\x72\x65\x73s\x65s\x2ec\x73\x73");$this->addJqueryPlugin("\x73\x63\x72\x6fll\x54o");$this->addJS(array(_THEME_JS_DIR_."tool\x73\x2ej\x73"));}public function initContent(){parent::initContent();${${"\x47L\x4f\x42A\x4c\x53"}["\x66\x63\x68\x75\x70\x76\x62"]}=AgileSellerManager::getOrders($this->sellerinfo->id_seller,true,$this->context,true);$this->pagination(${${"\x47\x4cO\x42A\x4c\x53"}["f\x63h\x75p\x76\x62"]});${${"\x47\x4cO\x42ALS"}["\x6a\x65\x6a\x78\x68e\x6d"]}=AgileSellerManager::getOrders($this->sellerinfo->id_seller,true,$this->context,false,$this->p,$this->n,$this->orderBy,$this->orderWay);self::$smarty->assign(array("\x73ell\x65\x72\x5ftab_id"=>4,"\x6f\x72\x64ers"=>${${"GL\x4f\x42A\x4c\x53"}["\x6a\x65\x6a\x78\x68\x65\x6d"]},"i\x6ev\x6f\x69c\x65A\x6cl\x6fwe\x64"=>(int)(Configuration::get("P\x53_\x49NV\x4f\x49\x43\x45"))));$this->setTemplate("\x73e\x6c\x6cer\x6fr\x64\x65r\x73\x2et\x70l");}}
?>