<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class AdminCarrierWizardController extends AdminCarrierWizardControllerCore
{
	public function renderGenericForm($fields_form, $fields_value, $tpl_vars = array())
	{
		if($fields_form['form']['form']['id_form'] == 'step_carrier_summary')
		{			
			$fields_value['id_seller'] = AgileSellerManager::getObjectOwnerID('carrier', Tools::getValue('id_carrier'));

			if($this->is_seller)
			{
				array_unshift($fields_form['form']['form']['input'],
					array(
							'type' => 'hidden',
							'label' => $this->l('Seller:'),
							'name' => 'id_seller',
							'required' => false,
							)
						);
			}
			else
			{
				array_unshift($fields_form['form']['form']['input'],
					array(
							'type' => 'select',
							'label' => $this->l('Seller:'),
							'name' => 'id_seller',
							'required' => false,
							'default_value' => $fields_value['id_seller'],
							'options' => array(
								'query' => AgileSellerManager::getSellersNV(true, $this->l('Store Shared')),
								'id' => 'id_seller',
								'name' => 'name',
								),
							'desc' => $this->l('If this is private seller data, please choose the seller. Otherwise please choose Store Shared')
							)
						);
			}
		}

		return parent::renderGenericForm($fields_form, $fields_value, $tpl_vars);
		
	}
}

