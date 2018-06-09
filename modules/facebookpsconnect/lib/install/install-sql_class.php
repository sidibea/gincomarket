<?php
/**
 * install-sql_class.php file defines InstallMySql class to install / uninstall sql of module
 */

class BT_InstallSql implements BT_IInstall
{
	/**
	 * install() method install of module
	 *
	 * @param mixed $mParam  => sql install file
	 * @return bool $bReturn : true => validate install, false => invalidate install
	 */
	public static function install($mParam = null)
	{
		return (
			self::_exec($mParam)
		);
	}
	
	/**
	 * uninstall() method uninstall of module
	 * 
	 * @category install collection
	 *
	 * @param mixed $mParam => sql uninstall file
	 * @return bool $bReturn : true => validate uninstall, false => invalidate uninstall
	 */
	public static function uninstall($mParam = null)
	{
		return (
			self::_exec($mParam)
		);
	}
	
	/**
	 * _exec() method make an execution generic for install and uninstall
	 *
	 * @param string $sFile
	 * @return bool $bReturn : true => validate uninstall, false => invalidate uninstall
	 */
	private static function _exec($sFile)
	{
		// set return execution
		$bReturn = false;

		// log jam to debug appli
		if (defined('_FPC_LOG_JAM_SQL') && _FPC_LOG_JAM_SQL) {
			$bReturn = _FPC_LOG_JAM_SQL;
		}
		elseif (file_exists($sFile)) {
			// open file
			$rHandle = fopen($sFile, 'r');

			// test handler
			if ($rHandle) {
				$bReturn = true;
				while (($sLine = fgets($rHandle, 4096)) !== false) {
					if (!empty($sLine)) {
						if (strpos($sLine, 'PREFIX_')) {
							$sLine = str_replace('PREFIX_', _DB_PREFIX_ . strtolower(_FPC_MODULE_NAME) . '_', $sLine);
						}
						// execute sql method declared in sql file (install or uninstall)
						if (false == Db::getInstance()->Execute(trim($sLine))) {
							return false;
						}
					}
				}
				if (!feof($rHandle)) {
					$bReturn = false;
				}
				fclose($rHandle);
			}
		}

		return $bReturn;
	}
}