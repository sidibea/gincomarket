<?php
$GLOBALS["jfWithPGlSYFvdnriAvj"]=base64_decode("U2F2ZQ==");$GLOBALS["ZCAfPWaXVkjXZEJtgpVM"]=base64_decode("c3VibWl0");$GLOBALS["sLnLcOgWCVbrPzrXtZeB"]=base64_decode("ZmllbGRz");$GLOBALS["zMvxNuDinXoYJWCGAdFz"]=base64_decode("aWNvbi1jb2dz");$GLOBALS["YwchZwfVCvWJLNJClmQk"]=base64_decode("aWNvbg==");$GLOBALS["fuUieizsstNkJpBBmSLF"]=base64_decode("R2VuZXJhbA==");$GLOBALS["LOrLwQXqNPePbnfMapGO"]=base64_decode("Z2VuZXJhbA==");$GLOBALS["aaVSngfyKHLQgxZvwrY"]=base64_decode("MA==");$GLOBALS["qPLtmziwLzIqenwZEpjf"]=base64_decode("ZGVmYXVsdA==");$GLOBALS["LJTHLhlVCRJagjxLojur"]=base64_decode("Ym9vbA==");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["GXMfTUXsDODsXGffLZlK"]=base64_decode("aW50dmFs");$GLOBALS["teoDnIniNUCnKfRWFyMo"]=base64_decode("Y2FzdA==");$GLOBALS["QKFMoypQDhdqHecvstrE"]=base64_decode("aXNCb29s");$GLOBALS["yxlFqOhEubTpMvDMEKFI"]=base64_decode("dmFsaWRhdGlvbg==");$GLOBALS["XuLpiLIYhkwlQfMTqiaA"]=base64_decode("RGVidWcgUHVzaCBOb3RpZmljYXRpb24=");$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["tXRWLNRSUXXrbGBrFlHR"]=base64_decode("TUNfREVCVUdfUFVTSE5PVElGSUNBVElPTg==");$GLOBALS["RlVxtMEUcahyIfaOSfKS"]=base64_decode("Y29uZmlndXJhdGlvbg==");$GLOBALS["LPnGxqvFNMLHaQagmnrI"]=base64_decode("Q29uZmlndXJhdGlvbg==");
?><?php



class MCConfigurationController extends AdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->context = Context::getContext();
        $this->className = $GLOBALS["LPnGxqvFNMLHaQagmnrI"];
        $this->table = $GLOBALS["RlVxtMEUcahyIfaOSfKS"];

        $fields = array(
            'MC_DEBUG_PUSHNOTIFICATION' => array(
                'title' => $this->l('Debug Push Notification'),
                $GLOBALS["yxlFqOhEubTpMvDMEKFI"] => $GLOBALS["QKFMoypQDhdqHecvstrE"],
                $GLOBALS["teoDnIniNUCnKfRWFyMo"] => $GLOBALS["GXMfTUXsDODsXGffLZlK"],
                $GLOBALS["kqpjokinrNKzMlmecrBs"] => $GLOBALS["LJTHLhlVCRJagjxLojur"],
                $GLOBALS["qPLtmziwLzIqenwZEpjf"] => $GLOBALS["aaVSngfyKHLQgxZvwrY"]
            ),
        );

        $this->fields_options = array(
            'general' => array(
                'title' =>    $this->l('General'),
                $GLOBALS["YwchZwfVCvWJLNJClmQk"] =>    $GLOBALS["zMvxNuDinXoYJWCGAdFz"],
                $GLOBALS["sLnLcOgWCVbrPzrXtZeB"] =>    $fields,
                $GLOBALS["ZCAfPWaXVkjXZEJtgpVM"] => array('title' => $this->l('Save')),
            ),
        );

        parent::__construct();
    }
}
 ?>