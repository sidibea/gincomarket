<?php
$GLOBALS["IbvlXZlUjVIBdfHMbDPF"]=base64_decode("aXNBcHBlbmREYXRl");$GLOBALS["XMvvVijpqzByvmhqQILr"]=base64_decode("ZGllT25PcGVuTG9nRmFpbGVk");$GLOBALS["WVZlWTvBOHhqhzGZxEbe"]=base64_decode("aXNMb2dFbmFibGVk");$GLOBALS["PHlZbczLSAqKYIaphtgI"]=base64_decode("bG9nUGF0aA==");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["iaEhwVAxQfCZbIpNYOyr"]=base64_decode("dw==");$GLOBALS["GkrOImiyITWvPAMmxHtI"]=base64_decode("PGJyIC8+");$GLOBALS["WkWoqCXATbYqtpRIKQHy"]=base64_decode("IC0g");$GLOBALS["WhhfbVVjffUiUYQXixVQ"]=base64_decode("WS1tLWQgSDppOnM=");$GLOBALS["xGygAzYkcBfetlTYCDSI"]=base64_decode("Q2FuIG5vdCBvcGVuIGxvZyBmaWxlOiA=");$GLOBALS["jcPlXoOcULOcFWBuPwFf"]=base64_decode("YSs=");$GLOBALS["EeTTFZDhuDloScNFHyvO"]=base64_decode("SVNfQVBQRU5EX0RBVEU=");$GLOBALS["giASDoEwVwOZfqgzmLFB"]=base64_decode("RElFX09OX09QRU5fTE9HX0ZBSUxFRA==");$GLOBALS["tGfQyQXFTQOjyHhwGpHb"]=base64_decode("SVNfTE9HX0VOQUJMRUQ=");$GLOBALS["rJoKjdnFEkNnycMRRnLu"]=base64_decode("L2xvZy5odG1s");$GLOBALS["CYLViNItHRbDbyYeKdNx"]=base64_decode("U1lURU1fTE9HX1BBVEg=");$GLOBALS["JxnebyjdFidXdVzNqnEb"]=base64_decode("Lw==");$GLOBALS["FnRIVeekqoefqkqZZJut"]=base64_decode("TU9CSUNPTU1FUkNFM19ST09U");
?><?php


if (!defined($GLOBALS["FnRIVeekqoefqkqZZJut"])) {
    define($GLOBALS["FnRIVeekqoefqkqZZJut"], str_replace('\\', $GLOBALS["JxnebyjdFidXdVzNqnEb"], dirname(__FILE__)));
}
define($GLOBALS["CYLViNItHRbDbyYeKdNx"], MOBICOMMERCE3_ROOT . $GLOBALS["rJoKjdnFEkNnycMRRnLu"]);
define($GLOBALS["tGfQyQXFTQOjyHhwGpHb"], true);
define($GLOBALS["giASDoEwVwOZfqgzmLFB"], false);
define($GLOBALS["EeTTFZDhuDloScNFHyvO"], true);

class Logger
{
    private static $filePath = SYTEM_LOG_PATH;
    private static $dieOnOpenLogFailed = DIE_ON_OPEN_LOG_FAILED;
    private static $islogEnabled = IS_LOG_ENABLED;
    private static $isAppendDate = IS_APPEND_DATE;

    public static function log($data)
    {
        if (self::$islogEnabled) {
            $myFile = Logger::$filePath;
            $fh = fopen($myFile, $GLOBALS["jcPlXoOcULOcFWBuPwFf"]);
            if (!$fh) {
                if (self::$dieOnOpenLogFailed) {
                    die($GLOBALS["xGygAzYkcBfetlTYCDSI"] . self::$filePath);
                }
                return;
            }
            flock($fh, LOCK_EX);
            if (self::$isAppendDate) {
                fwrite($fh, date($GLOBALS["WhhfbVVjffUiUYQXixVQ"]) . $GLOBALS["WkWoqCXATbYqtpRIKQHy"] . htmlspecialchars($data) . $GLOBALS["GkrOImiyITWvPAMmxHtI"]);
            } else {
                fwrite($fh, htmlspecialchars($data) . $GLOBALS["GkrOImiyITWvPAMmxHtI"]);
            }

            flock($fh, LOCK_UN);
            fclose($fh);
        }
    }

    public static function clean()
    {
        $fp = fopen(self::$filePath, $GLOBALS["iaEhwVAxQfCZbIpNYOyr"]);
        if ($fp) {
            fwrite($fp, $GLOBALS["tugkmwKQmrdyfghQnRJj"]);
            fclose($fp);
        }
    }

    public static function status()
    {
        return array(
            'logPath'            => SYTEM_LOG_PATH,
            'isLogEnabled'       => IS_LOG_ENABLED,
            'dieOnOpenLogFailed' => DIE_ON_OPEN_LOG_FAILED,
            'isAppendDate'       => IS_APPEND_DATE
        );
    }
}
 ?>