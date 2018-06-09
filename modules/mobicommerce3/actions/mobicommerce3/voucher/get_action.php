<?php
$GLOBALS["kRcLrhZXuXDpcYuzpmwx"]=base64_decode("dHJhbnNmb3JtYXRpb25fdGV4dA==");$GLOBALS["stPsEmZdhkBDWNBfXZtQ"]=base64_decode("Y2F0ZWdvcnlfdGV4dA==");$GLOBALS["TOeAMkZYbiIeTLssrRUI"]=base64_decode("Y291bnQ=");$GLOBALS["wEAvTlBRdiSqnDLiJSKV"]=base64_decode("dG90YWxDb3VudA==");$GLOBALS["xdqLbjMkqNwAldSnYJvs"]=base64_decode("bGlzdA==");$GLOBALS["JqSGfZenkJWmydKX"]=base64_decode("dm91Y2hlcg==");$GLOBALS["SclhcxlbneZQXVsHlOKl"]=base64_decode("Vm91Y2hlcg==");$GLOBALS["LzCIQYmHzPJcWsavcvwU"]=base64_decode("bGltaXQ=");$GLOBALS["ubIOsSVcjuGfmsSTDis"]=base64_decode("cGFnZQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_voucher_get_action extends BaseAction
{
    public function execute()
    {
        $p = (int)$this->getParam($GLOBALS["ubIOsSVcjuGfmsSTDis"]);
        $n = (int)$this->getParam($GLOBALS["LzCIQYmHzPJcWsavcvwU"]);
        $result = ServiceFactory::factory($GLOBALS["SclhcxlbneZQXVsHlOKl"])->getVoucherPoints($p, $n);
        $this->setSuccess(array(
            $GLOBALS["JqSGfZenkJWmydKX"]             => $result[$GLOBALS["xdqLbjMkqNwAldSnYJvs"]],
            $GLOBALS["wEAvTlBRdiSqnDLiJSKV"]          => $result[$GLOBALS["TOeAMkZYbiIeTLssrRUI"]],
            $GLOBALS["stPsEmZdhkBDWNBfXZtQ"]       => $result[$GLOBALS["stPsEmZdhkBDWNBfXZtQ"]],
            $GLOBALS["kRcLrhZXuXDpcYuzpmwx"] => $result[$GLOBALS["kRcLrhZXuXDpcYuzpmwx"]],
            
        	));
    }
}
 ?>