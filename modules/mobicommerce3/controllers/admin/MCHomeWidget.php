<?php
$GLOBALS["nVcbhvpIjiwuNJvCXtKd"]=base64_decode("Q29kZQ==");$GLOBALS["aDwnIlIdmURDJOblnNvA"]=base64_decode("d2lkZ2V0X2NvZGU=");$GLOBALS["sVIBZICjQAmbdrUgdFE"]=base64_decode("d2lkdGg=");$GLOBALS["daWoxIretRloKFsopCtQ"]=base64_decode("bGVmdA==");$GLOBALS["WLhxBLhWflGBqwmgQqAQ"]=base64_decode("TGFibGU=");$GLOBALS["muekMZgqwBPBWVTxdBoE"]=base64_decode("d2lkZ2V0X2xhYmVs");$GLOBALS["xgZmupJsgJhdlOsVZNMr"]=base64_decode("Y2VudGVy");$GLOBALS["eyoNIGALmALZnGlirqLv"]=base64_decode("YWxpZ24=");$GLOBALS["iAmJkrDwZbvdHbzAxugA"]=base64_decode("SUQ=");$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["EHNyOQmBmvBGOmZdcrZU"]=base64_decode("d2lkZ2V0X2lk");$GLOBALS["PLrNnUVtQqMkPUueMguY"]=base64_decode("bW9iaWNvbW1lcmNl");$GLOBALS["wswhpupsXzGIvFVtkyjT"]=base64_decode("bWNob21ld2lkZ2V0");$GLOBALS["DFBQKOwgCVKsSJvsHzoH"]=base64_decode("TUNNYW5hZ2VBcHBPYmplY3Q=");$GLOBALS["zFTEuigHCbvmVTKfrs"]=base64_decode("bW9iaWNvbW1lcmNlX3dpZGdldA==");$GLOBALS["jpJqutqELiBUPWsOMuiu"]=base64_decode("bW9kdWxlYWRtaW4=");$GLOBALS["DQDwzWurSYvYlBJlKeTB"]=base64_decode("RGVsZXRlIHNlbGVjdGVkIGl0ZW1zPw==");$GLOBALS["HczPHWfAVdFPcZvunKdw"]=base64_decode("Y29uZmlybQ==");$GLOBALS["IxdjEWNtvrGkHqDBsHDw"]=base64_decode("RGVsZXRlIHNlbGVjdGVk");$GLOBALS["hdNADhDYzBGwyDbViRvk"]=base64_decode("dGV4dA==");$GLOBALS["tkIGKVRJoUXzHqlPHMUx"]=base64_decode("ZGVsZXRl");$GLOBALS["JBbkvEXEDylsAzlwMyzh"]=base64_decode("ZWRpdA==");$GLOBALS["njyaJmZboucmVAmNzHMD"]=base64_decode("L01DQWJzdHJhY3QucGhw");$GLOBALS["qKsjQcexrsBUqlnPPwfX"]=base64_decode("Ly4uLy4uL2NsYXNzZXMvTUNIb21lV2lkZ2V0LnBocA==");$GLOBALS["yFgegkGnyjaqCdXlCeGu"]=base64_decode("d2lkZ2V0X2lk");$GLOBALS["dULjcGtukcdVXpIsDBzn"]=base64_decode("bW9iaWNvbW1lcmNl");
?><?php


include_once(dirname(__FILE__).$GLOBALS["qKsjQcexrsBUqlnPPwfX"]);
include_once (dirname ( __FILE__ ) . $GLOBALS["njyaJmZboucmVAmNzHMD"]);
class MCHomeWidgetController extends MCAbstract
{    
    public $bootstrap = true;
    public $module;
    public $position;
    
	public function __construct()
	{
        $this->addRowAction($GLOBALS["JBbkvEXEDylsAzlwMyzh"]);         $this->addRowAction($GLOBALS["tkIGKVRJoUXzHqlPHMUx"]);         $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), $GLOBALS["HczPHWfAVdFPcZvunKdw"] => $this->l($GLOBALS["DQDwzWurSYvYlBJlKeTB"])));
        $this->explicitSelect = true;
        $this->context = Context::getContext();
        $this->id_lang = $this->context->language->id;
        $this->path = _MODULE_DIR_.$GLOBALS["dULjcGtukcdVXpIsDBzn"];
        $this->controller_type = $GLOBALS["jpJqutqELiBUPWsOMuiu"];
        
        $this->bootstrap = true;
        $this->lang = false;
        $this->default_form_language = $this->context->language->id;
        $this->table = $GLOBALS["zFTEuigHCbvmVTKfrs"];         $this->className = $GLOBALS["DFBQKOwgCVKsSJvsHzoH"];         $this->identifier = $GLOBALS["yFgegkGnyjaqCdXlCeGu"];         $this->list_id = $GLOBALS["wswhpupsXzGIvFVtkyjT"];
        $this->module = $GLOBALS["PLrNnUVtQqMkPUueMguY"];
 
                $this->fields_list = array(
            'widget_id' => array(
				'title' => $this->l('ID'),
				$GLOBALS["eyoNIGALmALZnGlirqLv"] => $GLOBALS["xgZmupJsgJhdlOsVZNMr"],
    			),
            $GLOBALS["muekMZgqwBPBWVTxdBoE"] => array(
                'title' => $this->l('Lable'),
                $GLOBALS["eyoNIGALmALZnGlirqLv"] => $GLOBALS["daWoxIretRloKFsopCtQ"],
                $GLOBALS["sVIBZICjQAmbdrUgdFE"] => 50
            ),
            $GLOBALS["aDwnIlIdmURDJOblnNvA"] => array(
                'title' => $this->l('Code'),
                $GLOBALS["eyoNIGALmALZnGlirqLv"] => $GLOBALS["daWoxIretRloKFsopCtQ"],
                $GLOBALS["sVIBZICjQAmbdrUgdFE"] => 50
            )
        );  

        parent::__construct();
	}   
}
 ?>