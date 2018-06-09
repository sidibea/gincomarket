<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class AdminController extends AdminControllerCore
{
	public $is_seller;
	
	public function __construct()
	{
		global $cookie;
		parent::__construct();

		$this->is_seller = ($cookie->profile == (int)Configuration::get('AGILE_MS_PROFILE_ID'));	

		Shop::$id_shop_owner = $this->is_seller?$cookie->id_employee : 0;
		
		if(Module::isInstalled('agilemultipleseller') AND !isset($_GET['logout']) AND $this->is_seller AND (Tools::getValue("controller")=="" OR Tools::getValue("controller") == "adminhome"))
		{
			$tid = Tab::getIdFromClassName('AdminProducts');
			$token = Tools::getAdminToken('AdminProducts' .intval($tid).intval($cookie->id_employee));
			
			Tools::redirectAdmin("./index.php?controller=AdminProducts&token=" . $token);
		}
		
		if(Module::isInstalled('agilesellerlistoptions'))
		{
			require_once(_PS_ROOT_DIR_ .'/modules/agilesellerlistoptions/agilesellerlistoptions.php');
			$aslo_module = new AgileSellerListOptions();
			$msg = $aslo_module->hookAgileAdminTop(null);
			if(!empty($msg))
				$this->displayWarning($msg);
		}
		
				$tab = Tab::getInstanceFromClassName('AdminShopGroup');
		if(Module::isInstalled('agilemultipleshop'))
			$tab->active = 1;
		else
			$tab->active = 0;
		$tab->update();
		
	}

	public function initHeader()
	{
		parent::initHeader();
		if($this->is_seller)
		{
						$this->context->smarty->assign(array(
				'show_new_orders' =>0,
				'show_new_customers' => 0,
				'show_new_messages' => 0,
			));
			
		}
	}

	public function renderView()
	{
		global $cookie;
		
				if(Module::isInstalled('agilemultipleseller') AND $this->table =='customer_thread' AND $this->is_seller)
		{
			$this->tpl_view_vars['employees'] = Employee::getEmployeesByProfile(1); 		}
		
		return parent::renderView();
		
	}
				
	public function renderList()
	{
				if(Module::isInstalled('agilemultipleseller'))
		{
			if($this->is_seller AND in_array($this->table,array('customer_thread', 'customer','address')))
			{
				$this->actions = array_diff($this->actions, array("edit","delete"));	
				$this->list_no_link = true;
				$this->bulk_actions = array();
			}
		}
		return parent::renderList();
	}
	
	public function renderForm()
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::renderForm();
				if(strtolower(Tools::getValue('controller')) == 'adminimport')
		{
			$dir = _PS_ADMIN_DIR_.'/import/';
			if($this->is_seller)$dir .= $this->context->cookie->id_employee . '/';
			if(!file_exists($dir))mkdir($dir);
			$files_to_import = scandir($dir);
			uasort($files_to_import, array('AdminImportController', 'usortFiles'));
			foreach ($files_to_import as $k => &$filename)
			{
								if (preg_match('/^\..*|index\.php/i', $filename))
					unset($files_to_import[$k]);
				else if(is_dir($dir . $filename))
					unset($files_to_import[$k]);
			}
			unset($filename);
				
			$this->tpl_form_vars["files_to_import"] = $files_to_import;			
			$this->tpl_form_vars["path_import"] = $dir ;
		}
				
		if($this->table == 'shop' AND !$this->object->id)
		{
			$this->tpl_form_vars['form_import'] = null;
		}

						$eaccess = AgileSellerManager::get_entity_access($this->table);
		
		if($eaccess['owner_table_type']!=AgileSellerManager::OWNER_TABLE_UNKNOWN AND is_array($this->fields_form) AND isset($this->fields_form['input']) AND $this->table != 'sellerinfo')
		{
			$this->fields_value['id_seller'] = AgileSellerManager::getObjectOwnerID($this->table, intval(Tools::getValue('id_' . $this->table)));;
			if(empty($eaccess['owner_xr_table']))
			{
				if($this->is_seller)
				{
					array_unshift($this->fields_form['input'],
						array(
						'type' => 'hidden',
						'label' => $this->l('Seller:'),
						'name' => 'id_seller',
						'required' => false,
						)
					);
				}
				else
				{
					array_unshift($this->fields_form['input'],
						array(
						'type' => 'select',
						'label' => $this->l('Seller:'),
						'name' => 'id_seller',
						'required' => false,
						'default_value' => $this->fields_value['id_seller'],
						'options' => array(
									'query' => AgileSellerManager::getSellersNV(true, $this->l('Store Shared')),
									'id' => 'id_seller',
									'name' => 'name',
							),
						'hint' => $this->l('If this is private seller data, please choose the seller. Otherwise please choose Store Shared')
						)
					);
				}
			}
		}			
		return parent::renderForm();
	
	}
	
	public function viewAccess($disable = false)
	{
		global $cookie;

		if(!Module::isInstalled('agilemultipleseller'))return parent::viewAccess($disable);
		$eaccess = AgileSellerManager::get_entity_access($this->table);
		if($this->is_seller AND $objid  = intval(Tools::getValue('id_' . $this->table)))
		{
			if($objid == $cookie->id_employee AND $this->table == 'employee')return true;
						$id_owner = AgileSellerManager::getObjectOwnerID($this->table, $objid);
			if($id_owner > 0 OR $eaccess['is_exclusive'])
			{
				if(!AgileSellerManager::hasOwnership($this->table, $objid))return false;
			}
			else
			{
								if(isset($_GET['update' . $this->table]))return false;
			}
		}
		return parent::viewAccess($disable);
	}


		public function processSave()
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::processSave();
						if(!$this->can_edit())
		{
			$this->errors[] = Tools::displayError('You do not have permission to access this data');
			return false;
		}
		 
		return parent::processSave();
	}
	
	
	public function processDelete()
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::processDelete();
								if(!$this->can_edit())
		{
			$this->errors[] = Tools::displayError('You do not have permission to delete this data');
			return false;
		}
		 
		return parent::processDelete();
	}
	
	
			private function can_edit()
	{
		global $cookie;
		
		if(!Module::isInstalled('agilemultipleseller'))return true;
		if(!$this->is_seller)return true;

		$eaccess = AgileSellerManager::get_entity_access($this->table);
		$objid = Tools::getValue('id_' . $this->table, 0);

				if($objid == $cookie->id_employee AND $this->table == 'employee')return true;
		
				if(empty($eaccess['owner_xr_table']))
		{	
			if(intval($objid)<=0)return true; 
			$has_ownership = AgileSellerManager::hasOwnership($this->table, $objid);
			if($objid >0)return $has_ownership; 
			if((isset($_GET['submitAdd'.$this->table]) OR isset($_POST['submitAdd'.$this->table])) AND $objid == 0)return true;
			return false;
		}
		else
		{
			$xr_objid = AgileSellerManager::getXRObjectID($this->table, $objid);
			$has_ownership = AgileSellerManager::hasOwnership($eaccess['owner_xr_table'], $xr_objid);

			return $has_ownership;
														}
	}
	
					protected function agilemultipleseller_list_override()
    {        
		global $cookie;
		
		if(!Module::isInstalled('agilemultipleseller'))return;	
		$eaccess = AgileSellerManager::get_entity_access($this->table);
		if($eaccess['owner_table_type'] == AgileSellerManager::OWNER_TABLE_UNKNOWN)return;

		if($eaccess['owner_table_type'] == AgileSellerManager::OWNER_TABLE_DEFINED)
		{
			if(empty( $eaccess['owner_xr_table']))		
			    $this->_join = $this->_join . '	LEFT JOIN `'._DB_PREFIX_. $this->table .'_owner` ao ON (a.`id_' . $this->table . '`=ao.`id_' . $this->table . '`)';
			else
				$this->_join = $this->_join 
					. '	LEFT JOIN `'._DB_PREFIX_. $this->correct_table_name($eaccess['owner_xr_table']) . '`xr ON (a.`id_' . $eaccess['owner_xr_table'] . '`=xr.`id_' . $eaccess['owner_xr_table'] . '`)'
					. '	LEFT JOIN `'._DB_PREFIX_. $eaccess['owner_xr_table'] . '_owner` ao ON (xr.`id_' . $eaccess['owner_xr_table'] . '`=ao.`id_' . $eaccess['owner_xr_table'] . '`)'
				;
		}
		else 		{
			if(empty( $eaccess['owner_xr_table']))
			    $this->_join = $this->_join . '	LEFT JOIN `'._DB_PREFIX_. 'object_owner` ao ON (a.`id_' . $this->table . '`=ao.`id_object` AND `entity`=\'' . $this->table. '\')';
			else
				$this->_join = $this->_join 
					. '	LEFT JOIN `'._DB_PREFIX_. $this->correct_table_name($eaccess['owner_xr_table']) . '`xr ON (a.`id_' . $eaccess['owner_xr_table'] . '`=xr.`id_' . $eaccess['owner_xr_table'] . '`)'
					. '	LEFT JOIN `'._DB_PREFIX_. 'object_owner` ao ON (xr.`id_' . $eaccess['owner_xr_table'] . '`=ao.`id_object` AND ao.`entity`= \'' . $eaccess['owner_xr_table'] . '\')'
				;
		}
		
	    $this->_join = $this->_join . ' LEFT JOIN `'._DB_PREFIX_.'sellerinfo` ams ON (ao.`id_owner` = ams.`id_seller`)';
		$this->_join = $this->_join . ' LEFT JOIN `'._DB_PREFIX_.'sellerinfo_lang` amsl ON (ams.`id_sellerinfo` = amsl.`id_sellerinfo` AND amsl.id_lang=' . intval($cookie->id_lang) . ')';

		if($this->is_seller)
		{
			$cond_for_shared = 'OR IFNULL(ao.id_owner,0)=0';
			if($eaccess['is_exclusive']) $cond_for_shared = '';
			$this->_where = $this->_where . ' AND (IFNULL(ao.id_owner,0)=' . intval($cookie->id_employee) . ' ' . $cond_for_shared . ')';
		}
		else
		{	    
			$this->fields_list['seller'] = array('title' => $this->l('Seller'), 'width' => 90, 'filter_key' => 'amsl!company');
		}
    }
	
	private function correct_table_name($table)
	{
		return ($table == 'order'? 'orders' : $table);
	}
	
		public function displayErrors()
	{		
		if ($nbErrors = count($this->_errors) && $this->_includeContainer)
		{
			echo '<script type="text/javascript">
				$(document).ready(function() {
					$(\'#hideError\').unbind(\'click\').click(function(){
						$(\'.error\').hide(\'slow\', function (){
							$(\'.error\').remove();
						});
						return false;
					});
				});
			  </script>
			<div class="error"><span style="float:right"><a id="hideError" href=""><img alt="X" src="../img/admin/close.png" /></a></span><img src="../img/admin/error2.png" />';
			if (count($this->_errors) == 1)
				echo $this->_errors[0];
			else
			{
				echo sprintf($this->l('%d errors'), $nbErrors).'<br /><ol>';
				foreach ($this->_errors as $error)
					echo '<li>'.$error.'</li>';
				echo '</ol>';
			}
			echo '</div>';
		}
	}
	 

}

