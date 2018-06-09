<?php
class AdminShopController extends AdminShopControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function viewAccess($disable = false)
	{
		if(Module::isInstalled('agilemultipleshop'))return true;
		return parent::viewAccess($disable);
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function renderForm()
	{
		$scripts_4_hide = '';
		if(Module::isInstalled('agilemultipleshop'))$scripts_4_hide = $this->hide_shop_defaultsetting();
		return parent::renderForm() . $scripts_4_hide ;
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    private function hide_shop_defaultsetting()
	{
		return '
			<script type="text/javascript">			
			$(document).ready(function(){
				$("#id_category").parent().hide();
				$("#id_category").parent().prev().hide();
				$("#id_shop_group").parent().hide();
				$("#id_shop_group").parent().prev().hide();
				$(".category-filter").parent().hide();
				$(".category-filter").parent().prev().hide();
			
			});
			</script>
			';
	}
	
}
