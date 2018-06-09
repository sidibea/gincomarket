<?php
$GLOBALS["AfTzytjMsPtKZRkEUPYY"]=base64_decode("b3JkZXI=");$GLOBALS["talIVCLoJvCwHEulQoGd"]=base64_decode("MHhGRkZG");$GLOBALS["fpaeRtqabgxVrxakwgft"]=base64_decode("T3JkZXI=");$GLOBALS["irICZvXWyTxDHOXrhqvW"]=base64_decode("cGF5bWVudF9zdGF0dXM=");$GLOBALS["YzCNIbnwemsiTiDhEGAX"]=base64_decode("Y3VzdG9tX2tjX2NvbW1lbnRz");$GLOBALS["RebOSfKjxLaHWlwWPQMS"]=base64_decode("b3JkZXJfaWQ=");$GLOBALS["GDRrLneapceRZeqzXRAs"]=base64_decode("TW9iaWNvbW1lcmNlUGF5bWVudA==");$GLOBALS["ovjKgCYvGIGfqjaVsNPD"]=base64_decode("S2FuQ2FydC5TaG9wcGluZ0NhcnQuUGF5UGFsRUMuUGF5");$GLOBALS["vjxTxFtVDyxeUZVqIHxx"]=base64_decode("cGF5cGFsd3Bw");$GLOBALS["pTSzXbOEEHrOlHBelfHA"]=base64_decode("S2FuQ2FydC5TaG9wcGluZ0NhcnQuUGF5UGFsV1BTLkRvbmU=");$GLOBALS["AvpWRgjbjjVvBFnFfcdK"]=base64_decode("cGF5cGFs");$GLOBALS["IbXKddgXWInlrdJnVRni"]=base64_decode("cGF5bWVudF9tZXRob2RfaWQ=");$GLOBALS["alHKmGFEojxrfKbyyvEp"]=base64_decode("Y2FydA==");$GLOBALS["gDLbLYklpCTcTEwyCxpN"]=base64_decode("Y2hlY2tvdXRfdHlwZQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_checkout_done_action extends UserAuthorizedAction
{
    public function execute()
    {
        switch (Tools::getValue($GLOBALS["gDLbLYklpCTcTEwyCxpN"]))
        {
            case $GLOBALS["alHKmGFEojxrfKbyyvEp"]:
                if (Tools::getValue($GLOBALS["IbXKddgXWInlrdJnVRni"]) == $GLOBALS["AvpWRgjbjjVvBFnFfcdK"])
                {
                    $actionInstance = ActionFactory::factory($GLOBALS["pTSzXbOEEHrOlHBelfHA"]);
                    $actionInstance->init();
                    $actionInstance->execute();
                    $this->result = $actionInstance->getResult();
                }
                else if (Tools::getValue($GLOBALS["IbXKddgXWInlrdJnVRni"]) == $GLOBALS["vjxTxFtVDyxeUZVqIHxx"])
                {
                    $actionInstance = ActionFactory::factory($GLOBALS["ovjKgCYvGIGfqjaVsNPD"]);
                    $actionInstance->init();
                    $actionInstance->execute();
                    $this->result = $actionInstance->getResult();
                }
                else
                {
                    $mobicommercePaymentService = ServiceFactory::factory($GLOBALS["GDRrLneapceRZeqzXRAs"]);
                    list($result, $order) = $mobicommercePaymentService->mobicommercePaymentDone(Tools::getValue($GLOBALS["RebOSfKjxLaHWlwWPQMS"]), Tools::getValue($GLOBALS["YzCNIbnwemsiTiDhEGAX"]), Tools::getValue($GLOBALS["irICZvXWyTxDHOXrhqvW"]));
                    if ($result === TRUE)
                    {
                        $info = ServiceFactory::factory($GLOBALS["fpaeRtqabgxVrxakwgft"])->getPaymentOrderInfo($order);
                        $this->setSuccess($info);
                    }
                    else
                    {
                        $this->setError($GLOBALS["talIVCLoJvCwHEulQoGd"], $order);
                    }
                }
            case $GLOBALS["AfTzytjMsPtKZRkEUPYY"]:
                break;
            default:
                break;
        }
    }
}
 ?>