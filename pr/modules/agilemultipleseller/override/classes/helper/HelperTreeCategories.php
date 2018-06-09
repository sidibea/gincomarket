<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class HelperTreeCategories extends HelperTreeCategoriesCore
{
	
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

