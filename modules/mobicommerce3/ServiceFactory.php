<?php
$GLOBALS["FLIovxVepvrPFelUHGgg"]=base64_decode("LnBocA==");$GLOBALS["bgZKxCAhiypuqGZKmvgu"]=base64_decode("L3NlcnZpY2VzLw==");$GLOBALS["DnHjLfGIQJmWRoSDEXGL"]=base64_decode("IG5vdCBleGlzdHM=");$GLOBALS["XYdTLtgwUWwgQrPXrA"]=base64_decode("U2VydmljZQ==");$GLOBALS["GjibQdtQwvLkzafzVPsj"]=base64_decode("U2VydmljZSBuYW1lIGlzIHJlcXVpcmVkIC4=");
?><?php


class ServiceFactory
{
    private static $serviceCache = array();

    public static function factory($serviceName, $singleton = true)
    {
        if (empty($serviceName))
        {
            throw new Exception($GLOBALS["GjibQdtQwvLkzafzVPsj"]);
        }
        $serviceClassName = $serviceName . $GLOBALS["XYdTLtgwUWwgQrPXrA"];
        if (isset(self::$serviceCache[$serviceClassName]))
        {
            if ($singleton)
            {
                return self::$serviceCache[$serviceClassName];
            }
            else
            {
                return new $serviceClassName;
            }
        }
        if (!self::serviceExists($serviceClassName))
        {
            throw new Exception($serviceClassName . $GLOBALS["DnHjLfGIQJmWRoSDEXGL"]);
        }
        mc_include_once(MOBICOMMERCE3_ROOT . $GLOBALS["bgZKxCAhiypuqGZKmvgu"] . $serviceClassName . $GLOBALS["FLIovxVepvrPFelUHGgg"]);
        $instance = new $serviceClassName;
        self::$serviceCache[$serviceClassName] = $instance;
        return $instance;
    }

    public static function serviceExists($serviceClassName)
    {
        $serviceFile = $serviceClassName . $GLOBALS["FLIovxVepvrPFelUHGgg"];
        return mc_file_exists(MOBICOMMERCE3_ROOT . $GLOBALS["bgZKxCAhiypuqGZKmvgu"] . $serviceFile);
    }
}
 ?>