<?php
$GLOBALS["SJMQQHzjLEdLVmUkMEza"]=base64_decode("VXNlcg==");$GLOBALS["JPeHjhYPagTDvLhPQOFn"]=base64_decode("dXNlcmRhdGE=");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_get_action extends UserAuthorizedAction
{
    public function execute()
    {
        $this->setSuccess(array(
            $GLOBALS["zyCDQPaTqgmxkQFUGvGF"] => ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get(),
            $GLOBALS["JPeHjhYPagTDvLhPQOFn"]     => ServiceFactory::factory($GLOBALS["SJMQQHzjLEdLVmUkMEza"])->getUserInfo($this->context->cookie->email),
            ));
    }
}
 ?>