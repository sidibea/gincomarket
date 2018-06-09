<?php
$GLOBALS["BiPqrBarFHDTfSHckFAo"]=base64_decode("CgkJCQ==");$GLOBALS["oQmozerNEjRIoKxpAPxz"]=base64_decode("CgkJCVNFTEVDVCAqCgkJCUZST00g");$GLOBALS["aDwnIlIdmURDJOblnNvA"]=base64_decode("d2lkZ2V0X2NvZGU=");$GLOBALS["muekMZgqwBPBWVTxdBoE"]=base64_decode("d2lkZ2V0X2xhYmVs");$GLOBALS["NfjjcVEGrlZrcaNSlODH"]=base64_decode("cmVxdWlyZWQ=");$GLOBALS["kqpjokinrNKzMlmecrBs"]=base64_decode("dHlwZQ==");$GLOBALS["qNfvvyesRmydHthVAwLi"]=base64_decode("d2lkZ2V0X3Bvc2l0aW9u");$GLOBALS["sLnLcOgWCVbrPzrXtZeB"]=base64_decode("ZmllbGRz");$GLOBALS["sujYYCnTomiXqwKSEIsS"]=base64_decode("bXVsdGlsYW5n");$GLOBALS["SiRSACHoXsTIZeRmGmwq"]=base64_decode("aWQ=");$GLOBALS["HaUvzvIYBnZEnTfDiBLL"]=base64_decode("cHJpbWFyeQ==");$GLOBALS["zFTEuigHCbvmVTKfrs"]=base64_decode("bW9iaWNvbW1lcmNlX3dpZGdldA==");$GLOBALS["mDLMOfKWgvDmHozRaKuG"]=base64_decode("dGFibGU=");$GLOBALS["njyaJmZboucmVAmNzHMD"]=base64_decode("L01DQWJzdHJhY3QucGhw");
?><?php


include_once (dirname ( __FILE__ ) . $GLOBALS["njyaJmZboucmVAmNzHMD"]);
class MCHomeWidgetObject extends MCAbstractObject
{
	const SORT_BY_POSITION = 1;
	public $widget_id;
	
	public static $definition = array(
		'table'           => 'mobicommerce_widget',
		'primary'         => 'id',
		'multilang'       => false,
		'fields'          => array(
			'widget_position' => array('type' => self::TYPE_STRING, 'required' => false),
			'widget_label'    => array('type' => self::TYPE_STRING,'required' => true),
			'widget_code'     => array('type' => self::TYPE_STRING,'required' => false)
			)
		);

	public static function getAll()
	{
		$db = Db::getInstance(_PS_USE_SQL_SLAVE_);
		$results = $db->executeS($GLOBALS["oQmozerNEjRIoKxpAPxz"]._DB_PREFIX_.self::$definition[$GLOBALS["mDLMOfKWgvDmHozRaKuG"]].$GLOBALS["BiPqrBarFHDTfSHckFAo"]);

		return $results;
	}

	public function add($autodate = TRUE)
	{
		return parent::add($autodate, TRUE);
	}

	public function update($null_values = FALSE)
	{
		if (parent::update($null_values))
		{
			return $this->cleanPositions();
		}

		return FALSE;
	}

	public function delete()
	{
		if (parent::delete()) {
			return $this->cleanPositions();
		}

		return FALSE;
	}
}
 ?>