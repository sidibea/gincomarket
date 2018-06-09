<?php
$GLOBALS["SclhcxlbneZQXVsHlOKl"]=base64_decode("Vm91Y2hlcg==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_voucher_process_action extends BaseAction
{
    public function execute()
    {
        ServiceFactory::factory($GLOBALS["SclhcxlbneZQXVsHlOKl"])->processVoucherPoints();
        $this->setSuccess();
    }
}
 ?>