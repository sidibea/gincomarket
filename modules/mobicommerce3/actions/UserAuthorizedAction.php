<?php
$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class UserAuthorizedAction extends BaseAction
{
    public function validate()
    {
        if (!parent::validate())
        {
            return false;
        }
        
        if ($this->context->cookie->logged)
        {
            return true;
        }
        $this->setError(MobicommerceResult::ERROR_SYSTEM_INVALID_SESSION_KEY);
        return false;
    }
}
 ?>