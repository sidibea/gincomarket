<?php
$GLOBALS["TnrZCgIsWVBjeCTAaXMg"]=base64_decode("aHR0cA==");$GLOBALS["rojWvnbZNAUBRjTQLXdg"]=base64_decode("Xw==");$GLOBALS["iGNnMztGIwvPILuWgbGF"]=base64_decode("LnRwbA==");$GLOBALS["aQuZLtAcKEnDNSgCrOUx"]=base64_decode("bW9kdHBs");$GLOBALS["uSStPsoaChxlAfnwiWJx"]=base64_decode("L3ZpZXdzL3RlbXBsYXRlcy9ob29rLw==");$GLOBALS["elBBytaNdsVTJKsSXGuy"]=base64_decode("bW9kdWxlcy8=");$GLOBALS["FLIovxVepvrPFelUHGgg"]=base64_decode("LnBocA==");$GLOBALS["yNIwERtfvXfdcBGREkDk"]=base64_decode("cw==");$GLOBALS["eiMjHdOTkxJOAwMCNHkD"]=base64_decode("bW9k");$GLOBALS["POWdsDYcgiVnFFDSbMHA"]=base64_decode("UFNfU1NMX0VOQUJMRURfRVZFUllXSEVSRQ==");$GLOBALS["JMxuLHVopMBOTWBgwTul"]=base64_decode("aHR0cDovLw==");$GLOBALS["DWmsYJsvcfBZEyObOnZU"]=base64_decode("aHR0cHM6Ly8=");$GLOBALS["tYnFWBeUsqckcNNWjtX"]=base64_decode("UFNfU1NMX0VOQUJMRUQ=");$GLOBALS["bcMeQJBFBAERaPoJTbk"]=base64_decode("MS41");$GLOBALS["UZFVJcdcicwxWrRzTfZs"]=base64_decode("UFNfVEFY");$GLOBALS["fSbNHvNbXyTVCvrycbvJ"]=base64_decode("bW9iaWNvbW1lcmNlMw==");
?><?php


abstract class BaseService
{
    protected $priceDisplay;
    protected $withTax;
    protected $link;
    protected $mod;
    protected $smarty;
    
    public $template_resource;
    public $currentTemplate;

    public $context;
    public $module;

    public function __construct()
    {
        $this->context = context::getContext();
                $this->module->name = $GLOBALS["fSbNHvNbXyTVCvrycbvJ"];

        global $link, $smarty;
        global $_LANG;

        $this->priceDisplay = Product::getTaxCalculationMethod(isset($this->context->id_customer) ? $this->context->id_customer : null);
        $this->withTax = (int) Configuration::get($GLOBALS["UZFVJcdcicwxWrRzTfZs"]);
        $this->smarty = $smarty;

        if ($link)
        {
            $this->link = $link;
        }
        else if ($this->context && isset($this->context->link))
        {
            $this->link = $this->context->link;
        }
        else if (_PS_VERSION_ > $GLOBALS["bcMeQJBFBAERaPoJTbk"])
        {
            $protocol_link = (Configuration::get($GLOBALS["tYnFWBeUsqckcNNWjtX"]) OR Tools::usingSecureMode()) ? $GLOBALS["DWmsYJsvcfBZEyObOnZU"] : $GLOBALS["JMxuLHVopMBOTWBgwTul"];
            $useSSL = ((isset($this->ssl) AND $this->ssl AND Configuration::get($GLOBALS["tYnFWBeUsqckcNNWjtX"])) OR Tools::usingSecureMode()) ? true : false;
            $protocol_content = ($useSSL) ? $GLOBALS["DWmsYJsvcfBZEyObOnZU"] : $GLOBALS["JMxuLHVopMBOTWBgwTul"];
            $this->link = new Link($protocol_link, $protocol_content);
        }
        else
        {
            $this->link = new Link();
        }
    }

    public function getBaseUrl()
    {
        $base_url = _PS_BASE_URL_.__PS_BASE_URI__;
        if(Configuration::get($GLOBALS["tYnFWBeUsqckcNNWjtX"]) && Configuration::get($GLOBALS["POWdsDYcgiVnFFDSbMHA"]))
        {
            $base_url = str_replace($GLOBALS["JMxuLHVopMBOTWBgwTul"], $GLOBALS["DWmsYJsvcfBZEyObOnZU"], $base_url);
        }

        return $base_url;
    }

    protected function l($string, $extra = null)
    {
        $params = array('mod' => $this->mod, 's' => $string);

        $mod = isset($extra[$GLOBALS["eiMjHdOTkxJOAwMCNHkD"]]) ? $extra[$GLOBALS["eiMjHdOTkxJOAwMCNHkD"]] : NULL;
        $this->template_resource = $mod . $GLOBALS["FLIovxVepvrPFelUHGgg"];
        $this->currentTemplate = $mod;

        if ($extra)
        {
            $params[$GLOBALS["eiMjHdOTkxJOAwMCNHkD"]] = $mod;
            $this->mod = $mod;
            $this->template_resource = _PS_THEME_DIR_.$GLOBALS["elBBytaNdsVTJKsSXGuy"].$mod.$GLOBALS["uSStPsoaChxlAfnwiWJx"].$extra[$GLOBALS["aQuZLtAcKEnDNSgCrOUx"]].$GLOBALS["iGNnMztGIwvPILuWgbGF"];
        }

        return smartyTranslate($params, $this);
    }

    protected function t($string, $group)
    {
        if(isset($_LANG[$group.$GLOBALS["rojWvnbZNAUBRjTQLXdg"].md5($string)]))
        {
            return $_LANG[$group.$GLOBALS["rojWvnbZNAUBRjTQLXdg"].md5($string)];
        }

        return $string;
    }

    protected function getProductImage($name, $ids, $type = null)
    {
        $url = $this->link->getImageLink($name, $ids, $type . PIC_NAME_SUFFIX);
        if (strpos($url, $GLOBALS["TnrZCgIsWVBjeCTAaXMg"]) === false)
        {
            $url = _PS_BASE_URL_ . DIRECTORY_SEPARATOR . $url;
        }

        return $url;
    }
}
 ?>