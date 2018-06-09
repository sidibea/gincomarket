<?php
class HelperTreeCategories extends HelperTreeCategoriesCore
{
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:07
    * version: 3.0.6.2
    */
    public function render($data = NULL)
	{
		$html = parent::render($data);
		if(Module::isInstalled('agilemultipleseller') AND !((int)Configuration::get('AGILE_MS_ALLOW_REGISTER_ATHOME')))
		{
			$context = Context::getContext();
			if((int)$context->cookie->id_employee ==0 OR (int)$context->cookie->profile == (int)Configuration::get('AGILE_MS_PROFILE_ID'))
			{				
				require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
				$html .= AgileMultipleSeller::jsForHideHome();
			}
		}
		return $html;
	}
}
