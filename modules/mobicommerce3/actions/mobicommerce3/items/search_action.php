<?php
$GLOBALS["BudoyvNoPXXiWWzhYbHM"]=base64_decode("UHJvZHVjdA==");$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]=base64_decode("dG9rZW4=");$GLOBALS["lRBzvzBSEQkJxdBItbg"]=base64_decode("LA==");$GLOBALS["oPIXvArZcPbxJFnHnnjE"]=base64_decode("aXRlbV9pZHM=");$GLOBALS["IILKyemJoIaydIwgZhVM"]=base64_decode("bg==");$GLOBALS["IbEcMnSRttjLeClaMVkR"]=base64_decode("cA==");$GLOBALS["LzCIQYmHzPJcWsavcvwU"]=base64_decode("bGltaXQ=");$GLOBALS["ubIOsSVcjuGfmsSTDis"]=base64_decode("cGFnZQ==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["TadxZIBCwBlxKgJKpBc"]=base64_decode("YXNj");$GLOBALS["HbjSWFdqTMlrjmtmRFfQ"]=base64_decode("b3JkZXJ3YXk=");$GLOBALS["wKAPrHUzvaPjeFbGMzSG"]=base64_decode("b3JkZXJieQ==");$GLOBALS["AfTzytjMsPtKZRkEUPYY"]=base64_decode("b3JkZXI=");$GLOBALS["TxKKShAyajUHzxDEYMAz"]=base64_decode("ZGVzYw==");$GLOBALS["UBmkXYiwrwACKcKfPguC"]=base64_decode("c29ydF9vcmRlcg==");$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]=base64_decode("c29ydF9ieQ==");$GLOBALS["ktwCrReEJlzuBUIjBcCk"]=base64_decode("Og==");$GLOBALS["rIWgbgqIojOWhIMVwwOk"]=base64_decode("b3JkZXJfYnk=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");$GLOBALS["SnsSSwMKZSYeMFnEirnh"]=base64_decode("");$GLOBALS["ukLzdZEIiuRFEEOQrFRt"]=base64_decode("ZGF0ZV9hZGQ=");$GLOBALS["eaAMXiriSWdaZQYzQIYz"]=base64_decode("bmV3ZXN0X2ZpcnN0");$GLOBALS["JQPsrpNlQDJyOHjBcJiq"]=base64_decode("bmFtZS16LWE=");$GLOBALS["XckkIahjVOedVNldUNrH"]=base64_decode("bmFtZQ==");$GLOBALS["qIoNxfvcrBCFQMSciZu"]=base64_decode("bmFtZS1hLXo=");$GLOBALS["IrPupiOgqnXRiBxvUjgS"]=base64_decode("cmF0aW5nLWgtbA==");$GLOBALS["MmkxKktzjDAFaqkcXkKD"]=base64_decode("cG9wdWxhcml0eQ==");$GLOBALS["QwAfmGtJdGdXECGiKVJk"]=base64_decode("cG9zaXRpb24=");$GLOBALS["UGgrymukEGoXYYSyIiBj"]=base64_decode("cHJpY2UtbC1o");$GLOBALS["VrIktHzGpoHbbHMGmvhk"]=base64_decode("cHJpY2U=");$GLOBALS["sWSvosvbUTBAvWfnMBOd"]=base64_decode("cHJpY2UtaC1s");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_items_search_action extends BaseAction
{
    public function execute()
    {
        if ($_REQUEST[$GLOBALS["rIWgbgqIojOWhIMVwwOk"]])
        {
            $sortOptions = explode($GLOBALS["ktwCrReEJlzuBUIjBcCk"], $_REQUEST[$GLOBALS["rIWgbgqIojOWhIMVwwOk"]]);
            $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $sortOptions[0];
            $sortOptions[1] ? $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $sortOptions[1] : $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
        }
        if ($_REQUEST[$GLOBALS["AfTzytjMsPtKZRkEUPYY"]])
        {
            switch($_REQUEST[$GLOBALS["AfTzytjMsPtKZRkEUPYY"]])
            {
                case $GLOBALS["sWSvosvbUTBAvWfnMBOd"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["VrIktHzGpoHbbHMGmvhk"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];

                    
                    $_GET[$GLOBALS["wKAPrHUzvaPjeFbGMzSG"]] = $GLOBALS["VrIktHzGpoHbbHMGmvhk"];
                    $_GET[$GLOBALS["HbjSWFdqTMlrjmtmRFfQ"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
                    

                    break;
                case $GLOBALS["UGgrymukEGoXYYSyIiBj"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["VrIktHzGpoHbbHMGmvhk"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TadxZIBCwBlxKgJKpBc"];

                    
                    $_GET[$GLOBALS["wKAPrHUzvaPjeFbGMzSG"]] = $GLOBALS["VrIktHzGpoHbbHMGmvhk"];
                    $_GET[$GLOBALS["HbjSWFdqTMlrjmtmRFfQ"]] = $GLOBALS["TadxZIBCwBlxKgJKpBc"];
                    
                    break;
                case $GLOBALS["QwAfmGtJdGdXECGiKVJk"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["QwAfmGtJdGdXECGiKVJk"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
                    break;
                case $GLOBALS["MmkxKktzjDAFaqkcXkKD"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] =  $GLOBALS["VrIktHzGpoHbbHMGmvhk"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
                    break;
                case $GLOBALS["IrPupiOgqnXRiBxvUjgS"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["VrIktHzGpoHbbHMGmvhk"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
                    break;
                case $GLOBALS["qIoNxfvcrBCFQMSciZu"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["XckkIahjVOedVNldUNrH"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TadxZIBCwBlxKgJKpBc"];

                    
                    $_GET[$GLOBALS["wKAPrHUzvaPjeFbGMzSG"]] = $GLOBALS["XckkIahjVOedVNldUNrH"];
                    $_GET[$GLOBALS["HbjSWFdqTMlrjmtmRFfQ"]] = $GLOBALS["TadxZIBCwBlxKgJKpBc"];
                    
                    break; 
                case $GLOBALS["JQPsrpNlQDJyOHjBcJiq"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["XckkIahjVOedVNldUNrH"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];

                    
                    $_GET[$GLOBALS["wKAPrHUzvaPjeFbGMzSG"]] = $GLOBALS["XckkIahjVOedVNldUNrH"];
                    $_GET[$GLOBALS["HbjSWFdqTMlrjmtmRFfQ"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
                    
                    break;  
                case $GLOBALS["eaAMXiriSWdaZQYzQIYz"] : 
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] =  $GLOBALS["ukLzdZEIiuRFEEOQrFRt"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["TxKKShAyajUHzxDEYMAz"];
                    break;
                default :
                    $_REQUEST[$GLOBALS["OxQfzBAjtXxSRfdvxcQY"]] = $GLOBALS["SnsSSwMKZSYeMFnEirnh"];
                    $_REQUEST[$GLOBALS["UBmkXYiwrwACKcKfPguC"]] = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
                    break;
            }
        }

        if(isset($_REQUEST[$GLOBALS["ubIOsSVcjuGfmsSTDis"]]) && isset($_REQUEST[$GLOBALS["LzCIQYmHzPJcWsavcvwU"]]))
        {
            $_GET[$GLOBALS["IbEcMnSRttjLeClaMVkR"]] = $_REQUEST[$GLOBALS["ubIOsSVcjuGfmsSTDis"]];
            $_GET[$GLOBALS["IILKyemJoIaydIwgZhVM"]] = $_REQUEST[$GLOBALS["LzCIQYmHzPJcWsavcvwU"]];
        }
        
        if ($_REQUEST[$GLOBALS["oPIXvArZcPbxJFnHnnjE"]])
        {
            $_REQUEST[$GLOBALS["oPIXvArZcPbxJFnHnnjE"]] = explode($GLOBALS["lRBzvzBSEQkJxdBItbg"], $_REQUEST[$GLOBALS["oPIXvArZcPbxJFnHnnjE"]]);
        }

        $_token = Tools::getValue($GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]);
        
        $info = array();
        $info = ServiceFactory::factory('Product')->searchProducts($_REQUEST);
        $info[$GLOBALS["IUyxwiSnFvUOuLSFxbJQ"]] = $_token;

        $this->setSuccess($info);
    }
}
 ?>