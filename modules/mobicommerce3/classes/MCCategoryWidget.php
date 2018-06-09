<?php
$GLOBALS["yxVxHihMtvArnHrWNBVE"]=base64_decode("IiBPUkRFUiBCWSB3aWRnZXRfcG9zaXRpb24gQVND");$GLOBALS["OZqOsvHzsFArumXEuw"]=base64_decode("IAogICAgICAgICAgICBXSEVSRSB3aWRnZXRfY2F0ZWdvcnlfaWQgPSI=");$GLOBALS["iLhYTUanFjOUGinLWDLV"]=base64_decode("IAogICAgICAgICAgV0hFUkUgbWNpX2NhdGVnb3J5X2lkID0i");$GLOBALS["glCtwboWYexWxUNYpikb"]=base64_decode("bWNpX2NhdGVnb3J5X2lk");$GLOBALS["PqwJWBDOZqWZAfhvAiNw"]=base64_decode("bWNpX2Jhbm5lcg==");$GLOBALS["pOYLvIrWeDsNWICXwgGU"]=base64_decode("bWNpX3RodW1ibmFpbA==");$GLOBALS["enNqNaCvEaCEJfTuGZEY"]=base64_decode("Ig==");$GLOBALS["RcYLSIKNuWCsdyStwgdG"]=base64_decode("Y2F0ZWdvcnlCb3g=");$GLOBALS["LqwNNDchDWAJlmNXeBAb"]=base64_decode("IFdIRVJFIG1jaV9jYXRlZ29yeV9pZCA9ICI=");$GLOBALS["ObPMBnloWfQEXONfvzIX"]=base64_decode("U0VMRUNUICogRlJPTSA=");$GLOBALS["asIPZVYwThWDPmFOBfzS"]=base64_decode("bW9iaWNvbW1lcmNlX2NhdGVnb3J5X2ljb24z");$GLOBALS["jgKjIqgGumRgOInoaZpy"]=base64_decode("CiAgICAgICAgICA=");$GLOBALS["GmFdCKcTyeehglRwAhe"]=base64_decode("CiAgICAgICAgICAgIFNFTEVDVCAqCiAgICAgICAgICAgIEZST00g");$GLOBALS["qNfvvyesRmydHthVAwLi"]=base64_decode("d2lkZ2V0X3Bvc2l0aW9u");$GLOBALS["UFujgwYVohAfSloovsTJ"]=base64_decode("d2lkZ2V0X3N0YXR1cw==");$GLOBALS["aDwnIlIdmURDJOblnNvA"]=base64_decode("d2lkZ2V0X2NvZGU=");$GLOBALS["rgIkImLrAaQHjdciiuxP"]=base64_decode("bGFuZw==");$GLOBALS["NfjjcVEGrlZrcaNSlODH"]=base64_decode("cmVxdWlyZWQ=");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["muekMZgqwBPBWVTxdBoE"]=base64_decode("d2lkZ2V0X2xhYmVs");$GLOBALS["sLnLcOgWCVbrPzrXtZeB"]=base64_decode("ZmllbGRz");$GLOBALS["sujYYCnTomiXqwKSEIsS"]=base64_decode("bXVsdGlsYW5n");$GLOBALS["EHNyOQmBmvBGOmZdcrZU"]=base64_decode("d2lkZ2V0X2lk");$GLOBALS["HaUvzvIYBnZEnTfDiBLL"]=base64_decode("cHJpbWFyeQ==");$GLOBALS["ftGVwvSfpaHQMruwLaYD"]=base64_decode("bW9iaWNvbW1lcmNlX2NhdGVnb3J5X3dpZGdldDM=");$GLOBALS["mDLMOfKWgvDmHozRaKuG"]=base64_decode("dGFibGU=");$GLOBALS["njyaJmZboucmVAmNzHMD"]=base64_decode("L01DQWJzdHJhY3QucGhw");$GLOBALS["sAQEXilAsHTxRRtWAHnp"]=base64_decode("X1BTX1ZFUlNJT05f");$GLOBALS["zLGoFAvnGQLRQclsbsvA"]=base64_decode("d2lkZ2V0X2lkID0gJw==");$GLOBALS["CGbFgRIFcNnyLvvmfknU"]=base64_decode("Jw==");$GLOBALS["iihgqtdHZoxyoIZWFUah"]=base64_decode("bWNpX2NhdGVnb3J5X2lkID0gJw==");
?><?php


if (!defined($GLOBALS["sAQEXilAsHTxRRtWAHnp"]))
    exit;

include_once (dirname ( __FILE__ ) . $GLOBALS["njyaJmZboucmVAmNzHMD"]);
class MCCategoryWidgetObject extends MCAbstractObject
{
    const SORT_BY_POSITION = 1;
    public $widget_id;
    public $widget_label;
    public $widget_code;
    public $widget_status;
    public $widget_position;

    
    public static $definition = array(
        'table' => 'mobicommerce_category_widget3',
        'primary' => 'widget_id',
        'multilang' => false,
        'fields' => array(
            'widget_label' => array(
                'type'     => self::TYPE_STRING,
                'required' => true,
                'lang'     => false
                ),
            'widget_code' => array(
                'type'     => self::TYPE_STRING,
                'required' => false
                ),
            'widget_status' => array(
                'type'     => self::TYPE_INT,
                'required' => false
                ),
            'widget_position' => array(
                'type'     => self::TYPE_INT,
                'required' => false
                )
            ));

    public static function getAll()
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $results = $db->executeS($GLOBALS["GmFdCKcTyeehglRwAhe"] . _DB_PREFIX_ . self::$definition[$GLOBALS["mDLMOfKWgvDmHozRaKuG"]] . $GLOBALS["jgKjIqgGumRgOInoaZpy"]);

        return $results;
    }

    public function add($autodate = true)
    {
        return parent::add($autodate, true);
    }

    public function update($null_values = false)
    {
        if (parent::update($null_values)) {
            return $this->cleanPositions();
        }

        return false;
    }

    public function delete()
    {
        if (parent::delete())
        {
            return $this->cleanPositions();
        }

        return false;
    }

    public function saveImage($array, $thumbnail_image, $banner_image)
    {
        $_table = $GLOBALS["asIPZVYwThWDPmFOBfzS"];

        $sql = $GLOBALS["ObPMBnloWfQEXONfvzIX"]._DB_PREFIX_.$_table.$GLOBALS["LqwNNDchDWAJlmNXeBAb"].$array[$GLOBALS["RcYLSIKNuWCsdyStwgdG"]].$GLOBALS["enNqNaCvEaCEJfTuGZEY"];
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if($result)
        {
            $_data = array();
            if($thumbnail_image)
            {
                $_data[$GLOBALS["pOYLvIrWeDsNWICXwgGU"]] = $thumbnail_image;
            }
            if($banner_image)
            {
                $_data[$GLOBALS["PqwJWBDOZqWZAfhvAiNw"]] = $banner_image;
            }
            
            if($_data)
            {
                Db::getInstance()->update(
                    $_table,
                    $_data,
                    $GLOBALS["iihgqtdHZoxyoIZWFUah"].$array[$GLOBALS["RcYLSIKNuWCsdyStwgdG"]].$GLOBALS["CGbFgRIFcNnyLvvmfknU"],
                    false
                    );
            }
        }
        else
        {
            $_data = array(
                'mci_category_id' => $array['categoryBox'],
                'mci_thumbnail'   => $thumbnail_image,
                'mci_banner'      => $banner_image,
                );
            Db::getInstance()->insert($_table, $_data, false, false);
        }
    } 
    
    
    public function getCatWidgetImage($category_id)
    {
        $_table = $GLOBALS["asIPZVYwThWDPmFOBfzS"];
        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($GLOBALS["GmFdCKcTyeehglRwAhe"] . _DB_PREFIX_ .$_table.$GLOBALS["iLhYTUanFjOUGinLWDLV"].$category_id.$GLOBALS["enNqNaCvEaCEJfTuGZEY"]);

        return $results;
    }    
    
    public function getListCatWidget($category_id)
    {
        $_table = $GLOBALS["ftGVwvSfpaHQMruwLaYD"];
        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($GLOBALS["GmFdCKcTyeehglRwAhe"] . _DB_PREFIX_ . $_table . $GLOBALS["OZqOsvHzsFArumXEuw"].$category_id.$GLOBALS["yxVxHihMtvArnHrWNBVE"]);

        return $results;
    }

    public function updateWidgetPosition($widget_ids = array())
    {
        if(!empty($widget_ids))
        {
            foreach($widget_ids as $_widget_id => $position)
            {
                $_data = array(
                    'widget_position' => (int) $position
                    );
                Db::getInstance()->update($GLOBALS["ftGVwvSfpaHQMruwLaYD"], $_data, $GLOBALS["zLGoFAvnGQLRQclsbsvA"].$_widget_id.$GLOBALS["CGbFgRIFcNnyLvvmfknU"], false);
            }
        }
    }
}
 ?>