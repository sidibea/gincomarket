<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class ModuleFrontController extends ModuleFrontControllerCore
{
    protected $className;
    protected $identifier;
    protected $table;
    protected $object;
    protected $id_object;
	
	protected $warnings;

	protected function beforeDelete($object)
	{
		return false;
	}
	protected function afterDelete($object, $oldId)
	{
		return true;
	}


	protected function beforeAdd($object)
	{
		return true;
	}

	protected function afterAdd($object)
	{
		return true;
	}

	protected function afterUpdate($object)
	{
		return true;
	}
        
	protected function updateAssoShop($id_object = false, $new_id_object = false)
	{
		if (!Shop::isFeatureActive())
			return;

		$assos_data = $this->getAssoShop($this->table, $id_object);
		$assos = $assos_data[0];
		$type = $assos_data[1];

		if (!$type)
			return;

		Db::getInstance()->execute('
			DELETE FROM '._DB_PREFIX_.$this->table.'_'.$type.($id_object ? '
			WHERE `'.$this->identifier.'`='.(int)$id_object : ''));

		foreach ($assos as $asso)
		{
			Db::getInstance()->execute('
				INSERT INTO '._DB_PREFIX_.$this->table.'_'.$type.' (`'.pSQL($this->identifier).'`, id_'.$type.')
				VALUES('.($new_id_object ? $new_id_object : (int)$asso['id_object']).', '.(int)$asso['id_'.$type].')');
		}
	}
        
	public function validateRules($class_name = false)
	{
		if (!$class_name)
			$class_name = $this->className;
				$rules = call_user_func(array($class_name, 'getValidationRules'), $class_name);

		if ((count($rules['requiredLang']) || count($rules['sizeLang']) || count($rules['validateLang'])))
		{
						$default_language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));

						$languages = Language::getLanguages(false);
		}

				foreach ($rules['required'] as $field)
		{
			if (($value = Tools::getValue($field)) == false && (string)$value != '0')
			{
				if (!Tools::getValue($this->identifier) || ($field != 'passwd' && $field != 'no-picture'))
				{
					$this->errors[] = $this->l('The field').
						' <b>'.call_user_func(array($class_name, 'displayFieldName'), $field, $class_name).'</b> '.
						$this->l('is required');
				}
			}
		}

				foreach ($rules['requiredLang'] as $field_lang)
		{
			if (($empty = Tools::getValue($field_lang.'_'.$default_language->id)) === false || $empty !== '0' && empty($empty))
			{
				$this->errors[] = $this->l('The field').
					' <b>'.call_user_func(array($class_name, 'displayFieldName'), $field_lang, $class_name).'</b> '.
					$this->l('is required at least in').' '.$default_language->name;
			}
		}

				foreach ($rules['size'] as $field => $max_length)
		{
			if (Tools::getValue($field) !== false && Tools::strlen(Tools::getValue($field)) > $max_length)
			{
				$this->errors[] = $this->l('the field').
					' <b>'.call_user_func(array($class_name, 'displayFieldName'), $field, $class_name).'</b> '.
					$this->l('is too long').' ('.$max_length.' '.$this->l('chars max').')';
			}
		}
				foreach ($rules['sizeLang'] as $field_lang => $max_length)
		{
			foreach ($languages as $language)
			{
				$field_lang = Tools::getValue($field_lang.'_'.$language['id_lang']);
				if ($field_lang !== false && Tools::strlen($field_lang) > $max_length)
				{
					$this->errors[] = $this->l('the field').
						' <b>'.call_user_func(array($class_name, 'displayFieldName'), $field_lang, $class_name).' ('.$language['name'].')</b> '.
						$this->l('is too long').' ('.$max_length.' '.$this->l('chars max, html chars including').')';
				}
			}
		}
				$this->_childValidation();

				foreach ($rules['validate'] as $field => $function)
		{
			if (($value = Tools::getValue($field)) !== false && ($field != 'passwd'))
			{
				if (!Validate::$function($value) && !empty($value))
				{
					$this->errors[] = $this->l('the field').
						' <b>'.call_user_func(array($class_name, 'displayFieldName'), $field, $class_name).'</b> '.
						$this->l('is invalid');
				}
			}
		}

				if (($value = Tools::getValue('passwd')) != false)
		{
			if ($class_name == 'Employee' && !Validate::isPasswdAdmin($value))
				$this->errors[] = $this->l('the field').
					' <b>'.call_user_func(array($class_name, 'displayFieldName'), 'passwd', $class_name).'</b> '.
					$this->l('is invalid');
			elseif ($class_name == 'Customer' && !Validate::isPasswd($value))
				$this->errors[] = $this->l('the field').
					' <b>'.call_user_func(array($class_name, 'displayFieldName'), 'passwd', $class_name).
					'</b> '.$this->l('is invalid');
		}

				foreach ($rules['validateLang'] as $field_lang => $function)
		{
			foreach ($languages as $language)
			{
				if (($value = Tools::getValue($field_lang.'_'.$language['id_lang'])) !== false && !empty($value))
				{
					if (!Validate::$function($value))
					{
						$this->errors[] = $this->l('the field').
							' <b>'.call_user_func(array($class_name, 'displayFieldName'), $field_lang, $class_name).' ('.$language['name'].')</b> '.
							$this->l('is invalid');
					}
				}
			}
		}
	}

	public function _childValidation()
	{
	}


	public function copyFromPost(&$object, $table)
	{
				foreach ($_POST as $key => $value)
		{
			if (key_exists($key, $object) && $key != 'id_'.$table)
			{
								if ($key == 'passwd' && Tools::getValue('id_'.$table) && empty($value))
					continue;
								if ($key == 'passwd' && !empty($value))
					$value = Tools::encrypt($value);
				$object->{$key} = $value;
			}
		}

				$rules = call_user_func(array(get_class($object), 'getValidationRules'), get_class($object));
		if (count($rules['validateLang']))
		{
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				foreach (array_keys($rules['validateLang']) as $field)
				{
					if (isset($_POST[$field.'_'.(int)$language['id_lang']]))
					{
						$object->{$field}[(int)$language['id_lang']] = $_POST[$field.'_'.(int)$language['id_lang']];
					}
				}
			}
		}
	}
	
	
	 	 	 	 	 	 	 	public function getFieldValue($obj, $key, $id_lang = null)
	{
		if ($id_lang)
			$default_value = ($obj->id && isset($obj->{$key}[$id_lang])) ? $obj->{$key}[$id_lang] : '';
		else
			$default_value = isset($obj->{$key}) ? $obj->{$key} : '';

		return Tools::getValue($key.($id_lang ? '_'.$id_lang : ''), $default_value);
	}
	
	public function display()
	{
		$this->context->smarty->assign('warnings', $this->warnings);
		parent::display();
		
	}

	protected function displayWarning($msg)
	{
		$this->warnings[] = $msg;
	}


	protected function l($string)
	{
		return Translate::getModuleTranslation($this->module, $string, Tools::getValue('controller'));
	}

}

