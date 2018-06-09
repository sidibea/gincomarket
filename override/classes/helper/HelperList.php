<?php
class HelperList extends HelperListCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function displayEnableLink($token, $id, $value, $active, $id_category = null, $id_product = null, $ajax = false)
	{
				if(Module::isInstalled('agilemultipleseller'))
		{
			if($this->context->controller->is_seller AND in_array($this->context->controller->table,array('customer','address')))return;
		}
		return parent::displayEnableLink($token, $id, $value, $active, $id_category, $id_product, $ajax);
	}
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function displayViewLink($token = null, $id, $name = null)
	{
		$link = new Link();
		
		if (!array_key_exists('View', self::$cache_lang))
			self::$cache_lang['View'] = $this->l('View', 'Helper');
				if(Module::isInstalled('agilenewsletters') AND in_array($this->context->controller->table,array('agile_mail_history')))
		{
			return '<a href="' . $link->getModuleLink('agilenewsletters', 'newsletterdetail', array('nid'=>$id), true) . '" target="_new"><img src="../img/admin/details.gif" alt="'.self::$cache_lang['View'].'" title="'.self::$cache_lang['View'].'" /></a>';
		}
		return parent::displayViewLink($token, $id);
	}
	/*
    * module: agilemultipleseller
    * date: 2017-04-25 12:22:05
    * version: 3.0.6.2
    */
    public function displayListFooter()
	{
		$summary_row = '';
		if(in_array($this->table,array('seller_commission')))
		{
			$summary_row = $this->context->controller->getSummaryRow();
		}
		return $summary_row .
		parent::displayListFooter();
	}
}
