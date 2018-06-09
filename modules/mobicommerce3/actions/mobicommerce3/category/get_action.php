<?php
$GLOBALS["tCYSApDKjdVXwbzQIJxw"]=base64_decode("cGFyZW50X2NpZA==");$GLOBALS["HiNWxuIOYUxdiuWjPiZU"]=base64_decode("aXRlbV9jYXRz");$GLOBALS["PGRoJkxczQFaYyBQPmJK"]=base64_decode("YWxsX2NhdA==");$GLOBALS["gMAGOuAPSosnlhAsWixi"]=base64_decode("Q2F0ZWdvcnk=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_category_get_action extends BaseAction
{
    public function execute()
    {
        $categoryService = ServiceFactory::factory($GLOBALS["gMAGOuAPSosnlhAsWixi"]);
        $categories = $categoryService->getAllCategories();
        if (isset($_REQUEST[$GLOBALS["PGRoJkxczQFaYyBQPmJK"]]))
        {
            $this->setSuccess(array($GLOBALS["HiNWxuIOYUxdiuWjPiZU"] => $categories));
            return;
        }
        else
        {
            if (!isset($_REQUEST[$GLOBALS["tCYSApDKjdVXwbzQIJxw"]]))
            {
                $this->setError(MobicommerceResult::ERROR_CATEGORY_INPUT_PARAMETER);
                return;
            }
            $parent_cid = -1;
            if ($_REQUEST[$GLOBALS["tCYSApDKjdVXwbzQIJxw"]] != -1)
            {
                $parent_cid = $_REQUEST[$GLOBALS["tCYSApDKjdVXwbzQIJxw"]];
            }
            $info = $categoryService->getSubCategories($parent_cid, $categories);
            $this->setSuccess(array($GLOBALS["HiNWxuIOYUxdiuWjPiZU"] => $info));
            return;
        }
    }
}
 ?>