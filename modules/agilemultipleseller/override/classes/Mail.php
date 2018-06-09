<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class Mail extends MailCore
{
	public static function Send($id_lang, $template, $subject, $templateVars, $to, $toName = NULL, $from = NULL, $fromName = NULL, $fileAttachment = NULL, $modeSMTP = NULL, $templatePath = _PS_MAIL_DIR_, $die = false, $id_shop = NULL, $bcc = null)
    {
				if(Module::isInstalled('agileprepaidcredit') AND $template == 'payment_error')
		{
			if(AgilePrepaidCredit::isPaymentErrorCausedByTokens($templateVars)>0)return true;
		}
		
		$order_info_templates = array('order_conf','bankwire','cheque','new_order');
		if(Module::isInstalled('agilesellershipping') AND in_array($template,$order_info_templates))
		{
			AgileSellerManager::adjust_shipping_cost_carriers($templateVars);		}
        if(Module::isInstalled('agilepickupcenter') AND $template == 'order_conf')
        {
            require_once(_PS_ROOT_DIR_  . "/modules/agilepickupcenter/agilepickupcenter.php");
            $amodule = new AgilePickupCenter();
            $templateVars = $amodule->transform_mail_data($templateVars);
			if(isset($templateVars['{carrier_email}']) AND Validate::isEmail($templateVars['{carrier_email}']))
				parent::Send($id_lang, $template, $subject, $templateVars, $templateVars['{carrier_email}'], $toName, $from, $fromName, $fileAttachment, $modeSMTP, $templatePath, $die,$id_shop, $bcc);
        }
        if(in_array($template,$order_info_templates))
        {   
	        		    $shop_email = Configuration::get('PS_SHOP_EMAIL');
			if(Module::isInstalled('agilemultipleseller'))
			{			
				require_once(_PS_ROOT_DIR_  . "/modules/agilemultipleseller/SellerInfo.php");
				$templateVars = AgileSellerManager::appendMailTemplateVars($templateVars,$id_lang);
			}
						if(Module::isInstalled('agileprepaidcredit') AND in_array($template,array('bankwire','cheque')))
			{  
				require_once(_PS_ROOT_DIR_ . "/modules/agileprepaidcredit/agileprepaidcredit.php");
				$templateVars = AgilePrepaidCredit::replace_amount2pay($templateVars);
			}		    
			parent::Send($id_lang, $template, $subject, $templateVars, $shop_email, $toName, $from, $fromName, $fileAttachment, $modeSMTP, $templatePath, $die,$id_shop, $bcc);
        }
		
		if(Module::isInstalled('agilemultipleseller') AND $template == 'order_customer_comment')
        {   
            			$id_order = intval($templateVars['{id_order}']);
			$id_seller = AgileSellerManager::getObjectOwnerID('order',$id_order);
			$seller = new Employee($id_seller);
			parent::Send($id_lang, $template, $subject, $templateVars, $seller->email, $toName, $from, $fromName, $fileAttachment, $modeSMTP, $templatePath, $die,$id_shop, $bcc);
        }
		if(Module::isInstalled('agilemultipleseller') AND $template == 'order_conf')
		{ 
			require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
			AgileMultipleSeller::sendNewOrderMail($id_lang, $templateVars, $from, $fromName, $fileAttachment, $modeSMTP, $die,$id_shop, $bcc);
		}

		return parent::Send($id_lang, $template, $subject, $templateVars, $to, $toName, $from, $fromName, $fileAttachment, $modeSMTP, $templatePath, $die,$id_shop, $bcc);
    }
}

