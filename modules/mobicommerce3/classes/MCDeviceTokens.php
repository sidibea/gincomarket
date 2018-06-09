<?php
$GLOBALS["FssdfjvVXybScftcZwry"]=base64_decode("bWRfZGV2aWNldG9rZW4=");$GLOBALS["YBAwLuCheitDWxRvCbjX"]=base64_decode("bWRfYXBwY29kZQ==");$GLOBALS["bGlkAtJeNFDSznVBnkUO"]=base64_decode("aXNTdHJpbmc=");$GLOBALS["neUEEMxTZtPsjlITsrHo"]=base64_decode("dmFsaWRhdGU=");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["ZwKRIxWDGPzjIERcTNUh"]=base64_decode("YXBwY29kZQ==");$GLOBALS["sLnLcOgWCVbrPzrXtZeB"]=base64_decode("ZmllbGRz");$GLOBALS["vOMNaPLRNLJHvzcCBsvW"]=base64_decode("bXVsdGlsYW5nX3Nob3A=");$GLOBALS["sujYYCnTomiXqwKSEIsS"]=base64_decode("bXVsdGlsYW5n");$GLOBALS["bnCUgEryxxzsrRJFowKH"]=base64_decode("bWRfaWQ=");$GLOBALS["HaUvzvIYBnZEnTfDiBLL"]=base64_decode("cHJpbWFyeQ==");$GLOBALS["cjdFyRkwzdlEsSjIzzc"]=base64_decode("bW9iaWNvbW1lcmNlX2RldmljZXRva2Vucw==");$GLOBALS["mDLMOfKWgvDmHozRaKuG"]=base64_decode("dGFibGU=");$GLOBALS["sAQEXilAsHTxRRtWAHnp"]=base64_decode("X1BTX1ZFUlNJT05f");
?><?php


if (!defined($GLOBALS["sAQEXilAsHTxRRtWAHnp"]))
	exit;

class MCDeviceTokens extends ObjectModel
{
	public static $definition = array(
        'table' => 'mobicommerce_devicetokens',
        'primary' => 'md_id',
        'multilang' => false,
        'multilang_shop' => false,
        'fields' => array(
            'appcode' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'md_appcode' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'md_devicetoken' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
        )
    );
}
 ?>