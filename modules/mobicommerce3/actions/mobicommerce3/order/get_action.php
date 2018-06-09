<?php
$GLOBALS["TADrsdsleiQBYALAqaIp"]=base64_decode("b3JkZXJfZGV0YWlscw==");$GLOBALS["fpaeRtqabgxVrxakwgft"]=base64_decode("T3JkZXI=");$GLOBALS["OsDTIoTswSZaNSJDDLfo"]=base64_decode("aWRfY2FydA==");$GLOBALS["RebOSfKjxLaHWlwWPQMS"]=base64_decode("b3JkZXJfaWQ=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}


class mobicommerce3_order_get_action extends UserAuthorizedAction
{
    public function execute()
    {
        $orderId = $this->getParam($GLOBALS["RebOSfKjxLaHWlwWPQMS"]);
        $cartId = $this->getParam($GLOBALS["OsDTIoTswSZaNSJDDLfo"]);
        $orderService = ServiceFactory::factory($GLOBALS["fpaeRtqabgxVrxakwgft"]);
        $oneOrderInfo = $orderService->getOneOrderInfoById($orderId, $cartId);
        $this->setSuccess(array($GLOBALS["TADrsdsleiQBYALAqaIp"] => $oneOrderInfo));
    }
}
 ?>