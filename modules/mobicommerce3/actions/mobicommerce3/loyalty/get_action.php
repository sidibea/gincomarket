<?php
$GLOBALS["QeLnMPpvndUVxKAOxlRH"]=base64_decode("bWluaW11bV90ZXh0");$GLOBALS["FKJJSrcKfNlcouSwAAmL"]=base64_decode("dGl0bGU=");$GLOBALS["ZwyXGFVAaJkvyAKUbcok"]=base64_decode("dG90YWxfcG9pbnRzX3RleHQ=");$GLOBALS["jOcDrWNJePfvcnTOnujE"]=base64_decode("dG90YWxfcG9pbnRz");$GLOBALS["kRcLrhZXuXDpcYuzpmwx"]=base64_decode("dHJhbnNmb3JtYXRpb25fdGV4dA==");$GLOBALS["stPsEmZdhkBDWNBfXZtQ"]=base64_decode("Y2F0ZWdvcnlfdGV4dA==");$GLOBALS["TOeAMkZYbiIeTLssrRUI"]=base64_decode("Y291bnQ=");$GLOBALS["wEAvTlBRdiSqnDLiJSKV"]=base64_decode("dG90YWxDb3VudA==");$GLOBALS["xdqLbjMkqNwAldSnYJvs"]=base64_decode("bGlzdA==");$GLOBALS["aRbFXpGNJoCqQsoKJrhE"]=base64_decode("bG95YWx0eQ==");$GLOBALS["CwnxVRmTNJwuwIEzKONH"]=base64_decode("TG95YWx0eQ==");$GLOBALS["LzCIQYmHzPJcWsavcvwU"]=base64_decode("bGltaXQ=");$GLOBALS["ubIOsSVcjuGfmsSTDis"]=base64_decode("cGFnZQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_loyalty_get_action extends BaseAction
{
    public function execute()
    {
        $p = (int)$this->getParam($GLOBALS["ubIOsSVcjuGfmsSTDis"]);
        $n = (int)$this->getParam($GLOBALS["LzCIQYmHzPJcWsavcvwU"]);
        $result = ServiceFactory::factory($GLOBALS["CwnxVRmTNJwuwIEzKONH"])->getLoyaltyPoints($p, $n);
        $this->setSuccess(array(
            $GLOBALS["aRbFXpGNJoCqQsoKJrhE"]             => $result[$GLOBALS["xdqLbjMkqNwAldSnYJvs"]],
            $GLOBALS["wEAvTlBRdiSqnDLiJSKV"]          => $result[$GLOBALS["TOeAMkZYbiIeTLssrRUI"]],
            $GLOBALS["stPsEmZdhkBDWNBfXZtQ"]       => $result[$GLOBALS["stPsEmZdhkBDWNBfXZtQ"]],
            $GLOBALS["kRcLrhZXuXDpcYuzpmwx"] => $result[$GLOBALS["kRcLrhZXuXDpcYuzpmwx"]],
            $GLOBALS["jOcDrWNJePfvcnTOnujE"]        => $result[$GLOBALS["jOcDrWNJePfvcnTOnujE"]],
            $GLOBALS["ZwyXGFVAaJkvyAKUbcok"]   => $result[$GLOBALS["ZwyXGFVAaJkvyAKUbcok"]],
            $GLOBALS["FKJJSrcKfNlcouSwAAmL"]               => $result[$GLOBALS["FKJJSrcKfNlcouSwAAmL"]],
            $GLOBALS["QeLnMPpvndUVxKAOxlRH"]        => $result[$GLOBALS["QeLnMPpvndUVxKAOxlRH"]]
        	));
    }
}
 ?>