<?php
/**
 * @package Unite Gallery for Prestashop
 * @author UniteCMS.net / Valiano
 * @copyright (C) 2012 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Restricted access');

class UniteProviderDBUG{
	
	private $pdb;
	
	/**
	 *
	 * constructor - set database object
	 */
	public function __construct(){
		$this->pdb = Db::getInstance();
	}
	
	/**
	 * get error number
	 */
	public function getErrorNum(){
		return $this->pdb->getNumberError();
	}
	
	
	/**
	 * get error message
	 */
	public function getErrorMsg(){
		return $this->pdb->getMsgError();
	}
	
	/**
	 * get last row insert id
	 */
	public function insertid(){
		return $this->pdb->Insert_ID();
	}
	
	/**
	 * do sql query, return success
	 */
	public function query($query){
		$success = $this->pdb->query($query);
		
		return($success);
	}
	
	
	/**
	 * get affected rows after operation
	 */
	public function getAffectedRows(){
		return $this->pdb->Affected_Rows();
	}
	
	/**
	 * fetch objects from some sql
	 */
	public function fetchSql($query){
		//dmp($query);
		$rows = $this->pdb->executes($query);
		
		//dmp($rows);exit();
		
		return($rows);
	}
	
	/**
	 * escape some string
	 */
	public function escape($string){
		return $this->pdb->_escape($string);
	}
	
}



?>