<?php
$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]=base64_decode("dG9rZW4=");$GLOBALS["fpaeRtqabgxVrxakwgft"]=base64_decode("T3JkZXI=");$GLOBALS["udsgbqFGtkNGuyKXxiuf"]=base64_decode("Y3VzdG9tZXJfaWQ=");$GLOBALS["UHjcCUAlGFGSRKsjinnP"]=base64_decode("c3RhdHVzX2lk");$GLOBALS["nVWeDTWlafDTkpRzvCph"]=base64_decode("cGFnZV9zaXpl");$GLOBALS["PPujwNfSSRRCezamCiDr"]=base64_decode("cGFnZV9ubw==");$GLOBALS["LzCIQYmHzPJcWsavcvwU"]=base64_decode("bGltaXQ=");$GLOBALS["ubIOsSVcjuGfmsSTDis"]=base64_decode("cGFnZQ==");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
	header($GLOBALS["PdepTkCacGhHbSYynMub"]);
	die();
}

class mobicommerce3_orders_get_action extends UserAuthorizedAction
{
	public function execute()
	{
		$pageNo = $this->getParam($GLOBALS["ubIOsSVcjuGfmsSTDis"]);
		$pageSize = $this->getParam($GLOBALS["LzCIQYmHzPJcWsavcvwU"]);

		$parameter = array('page_no'=>(isset($pageNo) && is_numeric($pageNo) ? (int)$pageNo : 1),
			$GLOBALS["nVWeDTWlafDTkpRzvCph"]   => (isset($pageSize) && is_numeric($pageSize) ? ((int)$pageSize > 30 ? 30 : (int)$pageSize) : 10),
			$GLOBALS["UHjcCUAlGFGSRKsjinnP"]   => $this->getParam($GLOBALS["UHjcCUAlGFGSRKsjinnP"]),
			$GLOBALS["udsgbqFGtkNGuyKXxiuf"] => $this->context->cookie->id_customer);

		$info = array();
		$info = ServiceFactory::factory('Order')->getOrderInfos($parameter);
		$info[$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]] = Tools::getValue($GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]);
		$this->setSuccess($info);
	}
}
 ?>