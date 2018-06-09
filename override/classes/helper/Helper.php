<?php
class Helper extends HelperCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:07
    * version: 3.0.6.2
    */
    public function renderCategoryTree($root = null,
									   $selected_cat = array(),
									   $input_name = 'categoryBox',
									   $use_radio = false,
									   $use_search = false,
									   $disabled_categories = array(),
									   $use_in_popup = false,
									   $use_shop_context = false)
	{
		global $cookie;
		
		$html = parent::renderCategoryTree($root, $selected_cat,   $input_name, $use_radio, $use_search, $disabled_categories, $use_in_popup, $use_shop_context);
		if(Module::isInstalled('agilemultipleseller') AND !((int)Configuration::get('AGILE_MS_ALLOW_REGISTER_ATHOME')))
		{
			if((int)$cookie->id_employee ==0 OR (int)$cookie->profile == (int)Configuration::get('AGILE_MS_PROFILE_ID'))
			{				
				require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
				$html .= AgileMultipleSeller::jsForHideHome();
			}
		}
		
		return $html;
	}
}
