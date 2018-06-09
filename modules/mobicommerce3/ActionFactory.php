<?php
$GLOBALS["QswoPIiixEYnnAcpgY"]=base64_decode("X2FjdGlvbi5waHA=");$GLOBALS["PFCFETtmLKplKZxkCvKX"]=base64_decode("L2FjdGlvbnM=");$GLOBALS["JxnebyjdFidXdVzNqnEb"]=base64_decode("Lw==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["QLmcSKQMCCDEUqzrHyBD"]=base64_decode("X2FjdGlvbg==");$GLOBALS["rojWvnbZNAUBRjTQLXdg"]=base64_decode("Xw==");$GLOBALS["hQMtQEXNnpjUEYrLmOsm"]=base64_decode("Lg==");$GLOBALS["WLQfODDGnljWKEkYDnOg"]=base64_decode("KQ==");$GLOBALS["mDCVFahEQtjIaJjApGgY"]=base64_decode("SW52YWxpZCByZXF1ZXN0IG1ldGhvZCAuKA==");$GLOBALS["QLJANnQSRvALfYLssPvE"]=base64_decode("TWlzc2luZyBtZXRob2QgcGFyYW1ldGVy");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"])) {
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class ActionFactory
{
    private static $actionCache = array();

    public static function factory($requestMethod)
    {
        $requestMethod = Tools::strtolower($requestMethod);
        if (empty($requestMethod)) {
            throw new EmptyMethodException($GLOBALS["QLJANnQSRvALfYLssPvE"]);
        }
        if (isset(self::$actionCache[$requestMethod])) {
            return self::$actionCache;              
        }
        if (!self::actionExists($requestMethod)) {
            throw new InvalidRequestException($GLOBALS["mDCVFahEQtjIaJjApGgY"] . $requestMethod . $GLOBALS["WLQfODDGnljWKEkYDnOg"]);
        }
        mc_include_once(self::getActionPath($requestMethod));
        $actionClassName = self::getActionClassName($requestMethod);
        $instance = new $actionClassName;
        
        self::$actionCache[$requestMethod] = $instance;
        return $instance;
    }

    public static function getActionClassName($requestMethod)
    {
        $arr = explode($GLOBALS["hQMtQEXNnpjUEYrLmOsm"], $requestMethod);
        $className = join($GLOBALS["rojWvnbZNAUBRjTQLXdg"], $arr);
        return $className . $GLOBALS["QLmcSKQMCCDEUqzrHyBD"];                                          
    }

    public static function getActionPath($requestMethod)
    {
        $actionPath = $GLOBALS["tugkmwKQmrdyfghQnRJj"];
        foreach (explode($GLOBALS["hQMtQEXNnpjUEYrLmOsm"], $requestMethod) as $pathPart) {
            $actionPath = $actionPath . $GLOBALS["JxnebyjdFidXdVzNqnEb"] . $pathPart;
        }
        return MOBICOMMERCE3_ROOT . $GLOBALS["PFCFETtmLKplKZxkCvKX"] . $actionPath . $GLOBALS["QswoPIiixEYnnAcpgY"];         
    }

    public static function actionExists($requestMethod)
    {
        return mc_file_exists(self::getActionPath($requestMethod));
    }
}
 ?>