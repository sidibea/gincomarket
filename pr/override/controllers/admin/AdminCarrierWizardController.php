<?php
class AdminCarrierWizardController extends AdminCarrierWizardControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:06
    * version: 3.0.6.2
    */
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
