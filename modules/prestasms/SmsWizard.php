<?php
define("SMS_CONTROLER_URL", _PS_MODULE_DIR_.'/prestasms/includes/model/');
require_once(_PS_MODULE_DIR_ . '/prestasms/includes/model/sms.php');
include_once(_PS_MODULE_DIR_.'/prestasms/includes/controller/settings.php');
include_once(_PS_MODULE_DIR_.'/prestasms/exc.php'); 

class SmsWizard extends AdminTab
{
    public $multishop_context = Shop::CONTEXT_ALL;
    public $multishop_context_group = false;
  
    public function __construct()
    {
        $this->sms = new ControllerSmsSettings();
        parent::__construct();
    }

    public function display()
    {
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../modules/prestasms/css/style.css\">";
        if((float)substr(_PS_VERSION_, 0, 3) < 1.6)
        {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../modules/prestasms/css/sms_style_1_5.css\">";
        }        
        echo "<div class=\"smsTab\">".$this->sms->display()."</div>";
    }

    public function postProcess()
    {
        return parent::postProcess();
    }
    
    public function addJqueryPlugin()
    {
    }

    public function addCss()
    {
    }

    public function addJs()
    {
    }
    
    public function addJquery()
    {
    }
    
    public function __call($method, $args) 
    {
    }
}
?>