<?php
$GLOBALS["dTgTlqxkJVxCEotaParH"]=base64_decode("aGVhZGluZw==");$GLOBALS["LZMjpjyqMPdyCzwJBdOJ"]=base64_decode("ZGV2aWNlX3R5cGU=");$GLOBALS["bGlkAtJeNFDSznVBnkUO"]=base64_decode("aXNTdHJpbmc=");$GLOBALS["neUEEMxTZtPsjlITsrHo"]=base64_decode("dmFsaWRhdGU=");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]=base64_decode("YXBwY29kZQ==");$GLOBALS["sLnLcOgWCVbrPzrXtZeB"]=base64_decode("ZmllbGRz");$GLOBALS["vOMNaPLRNLJHvzcCBsvW"]=base64_decode("bXVsdGlsYW5nX3Nob3A=");$GLOBALS["sujYYCnTomiXqwKSEIsS"]=base64_decode("bXVsdGlsYW5n");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["HaUvzvIYBnZEnTfDiBLL"]=base64_decode("cHJpbWFyeQ==");$GLOBALS["HLRfIBMCSDQyIxGxUEw"]=base64_decode("bW9iaWNvbW1lcmNlX3B1c2hoaXN0b3J5");$GLOBALS["mDLMOfKWgvDmHozRaKuG"]=base64_decode("dGFibGU=");$GLOBALS["sAQEXilAsHTxRRtWAHnp"]=base64_decode("X1BTX1ZFUlNJT05f");
?><?php


if (!defined($GLOBALS["sAQEXilAsHTxRRtWAHnp"]))
	exit;

class MCPushHistory extends ObjectModel
{
	public static $definition = array(
        'table' => 'mobicommerce_pushhistory',
        'primary' => 'id',
        'multilang' => false,
        'multilang_shop' => false,
        'fields' => array(
            'appcode' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'device_type' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'heading' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
        )
    );
}
 ?>