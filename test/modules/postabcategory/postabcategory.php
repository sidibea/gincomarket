<?php

class postabcategory extends Module {
	private $spacer_size = '5';	
	private $_postErrors  = array();
	private $_html= null;
	public function __construct() {
		$this->name 		= 'postabcategory';
		$this->tab 			= 'front_office_features';
		$this->version 		= '1.5';
		$this->author 		= 'posthemes';
		$this->displayName 	= $this->l('Pos Category Tabs Slider');
		$this->description 	= $this->l('Category Tabs Slider');
		parent :: __construct();
       
	}
	
	public function install() {
	
	Configuration::updateValue($this->name . '_p_limit', 30);
	
	$arrayDefault = array('CAT3,CAT4');
	$cateDefault = implode(',',$arrayDefault);
	Configuration::updateGlobalValue($this->name . '_list_cate',$cateDefault);

		return parent :: install()
			&& $this->registerHook('blockPosition3')
			&& $this->registerHook('header')
			&& $this->registerHook('actionOrderStatusPostUpdate')
			&& $this->registerHook('addproduct')
			&& $this->registerHook('updateproduct')
			&& $this->registerHook('deleteproduct');
	}

      public function uninstall() {
		Configuration::deleteByName($this->name . '_list_cate');
        $this->_clearCache('postabcategory.tpl');
        return parent::uninstall();
    }

  
	public function psversion() {
		$version=_PS_VERSION_;
		$exp=$explode=explode(".",$version);
		return $exp[1];
	}
    
    
    public function hookHeader($params){
        if ($this->psversion()==5){
            $this->context->controller->addCSS(($this->_path).'postabcategory.css', 'all');

        } else {
            Tools::addCSS(($this->_path).'postabcategory.css');

        }
    }
	
	public function hookblockPosition2($params) {
	        $nb = Configuration::get($this->name . '_p_limit');
		    $arrayCategory = array();
			$catSelected = Configuration::get($this->name . '_list_cate');
			$cateArray = explode(',', $catSelected); 
			$id_lang =(int) Context::getContext()->language->id;
			$id_shop = (int) Context::getContext()->shop->id;
			$arrayProductCate = array();
			foreach($cateArray as $id_category) {
				$id_category = str_replace('CAT','',$id_category);
				$category = new Category((int) $id_category, (int) $id_lang, (int) $id_shop);
				$categoryProducts = $category->getProducts($this->context->language->id, 0, ($nb ? $nb : 5));
				foreach ($category as $categoryid);{
					$html = '';
					$files = scandir(_PS_CAT_IMG_DIR_);
					if (count($files) > 0)
					{
						foreach ($files as $value=>$file){
							if (preg_match('/'.$id_category.'-([0-9])?_thumb.jpg/i',substr($file,0)) === 1){
								 if (preg_match('/'.$id_category.'-([0-9])?_thumb.jpg/i',substr($file,1))!=1){
									$html .= $this->context->link->getMediaLink(_THEME_CAT_DIR_.$file);
								 }
							}
						}
					}
					if($categoryProducts) {
						$arrayProductCate[] = array('id' => $id_category, 'html'=>$html, 'name'=> $category->name, 'product' => $categoryProducts);
					}
				}
			}
			
            $this->smarty->assign(array(
				'productCates' => $arrayProductCate,
                'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
                'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
				
            ));
		return $this->display(__FILE__, 'postabcategory.tpl');
	}
	
	public function hookblockPosition3($params) {
	        $nb = Configuration::get($this->name . '_p_limit');
		    $arrayCategory = array();
			$catSelected = Configuration::get($this->name . '_list_cate');
			$cateArray = explode(',', $catSelected); 
			$id_lang =(int) Context::getContext()->language->id;
			$id_shop = (int) Context::getContext()->shop->id;
			$arrayProductCate = array();
			foreach($cateArray as $id_category) {
				$id_category = str_replace('CAT','',$id_category);
				$category = new Category((int) $id_category, (int) $id_lang, (int) $id_shop);
				$categoryProducts = $category->getProducts($this->context->language->id, 0, ($nb ? $nb : 5));
				foreach ($category as $categoryid);{
					$html = '';
					$files = scandir(_PS_CAT_IMG_DIR_);
					if (count($files) > 0)
					{
						foreach ($files as $value=>$file){
							if (preg_match('/'.$id_category.'-([0-9])?_thumb.jpg/i',substr($file,0)) === 1){
								 if (preg_match('/'.$id_category.'-([0-9])?_thumb.jpg/i',substr($file,1))!=1){
									$html .= $this->context->link->getMediaLink(_THEME_CAT_DIR_.$file);
								 }
							}
						}
					}
					if($categoryProducts) {
						$arrayProductCate[] = array('id' => $id_category, 'html'=>$html, 'name'=> $category->name, 'product' => $categoryProducts);
					}
				}
			}
			
            $this->smarty->assign(array(
				'productCates' => $arrayProductCate,
                'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
                'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
				
            ));
		return $this->display(__FILE__, 'postabcategory.tpl');
	}

	  public function getContent() {
        $output = '<h2>' . $this->displayName . '</h2>';
        if (Tools::isSubmit('submitPosTabCate')) {
            if (!sizeof($this->_postErrors))
                $this->_postProcess();
            else {
                foreach ($this->_postErrors AS $err) {
                    $this->_html .= '<div class="alert error">' . $err . '</div>';
                }
            }
        }
        return $output . $this->_displayForm();
    }

    public function getSelectOptionsHtml($options = NULL, $name = NULL, $selected = NULL) {
        $html = "";
        $html .='<select name =' . $name . ' style="width:130px">';
        if (count($options) > 0) {
            foreach ($options as $key => $val) {
                if (trim($key) == trim($selected)) {
                    $html .='<option value=' . $key . ' selected="selected">' . $val . '</option>';
                } else {
                    $html .='<option value=' . $key . '>' . $val . '</option>';
                }
            }
        }
        $html .= '</select>';
        return $html;
    }

    private function _postProcess() {
	
        Configuration::updateValue($this->name . '_list_cate', implode(',', Tools::getValue('list_cate')));
        Configuration::updateValue($this->name . '_p_limit', Tools::getValue('p_limit'));

        $this->_html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
    }
	
	private function _displayForm(){ 
		$spacer = str_repeat('&nbsp;', $this->spacer_size);
	
         $this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                  <fieldset>';
					
					$this->_html .= '<label>' . $this->l('Show Link/Label Category: ') . '</label>';
					$this->_html .= '<div class="margin-form">';
					$this->_html .= '<select multiple="multiple" name ="list_cate[]" style="width: 200px; height: 160px;">';
					// BEGIN Categories
					$id_lang = (int) Context::getContext()->language->id;
					$this->getCategoryOption(1, (int) $id_lang, (int) Shop::getContextShopID());
					$this->_html .= '</select>
					</div>';
					$this->_html .='
                     <label>'.$this->l('Products Limit: ').'</label>
                    <div class="margin-form">
                            <input type = "text"  name="p_limit" value ='.(Tools::getValue('p_limit')?Tools::getValue('p_limit'): Configuration::get($this->name.'_p_limit')).' ></input>
                    </div>
                    <input type="submit" name="submitPosTabCate" value="'.$this->l('Update').'" class="button" />
                     </fieldset>
		</form>';
		return $this->_html;
	}
	
	
     private function getCategoryOption($id_category = 1, $id_lang = false, $id_shop = false, $recursive = true) {
		$cateCurrent = Configuration::get($this->name . '_list_cate');		
		$cateCurrent = explode(',', $cateCurrent);
		$id_lang = $id_lang ? (int)$id_lang : (int)Context::getContext()->language->id;
		$category = new Category((int)$id_category, (int)$id_lang, (int)$id_shop);

		if (is_null($category->id))
			return;

		if ($recursive)
		{
			$children = Category::getChildren((int)$id_category, (int)$id_lang, true, (int)$id_shop);
			$spacer = str_repeat('&nbsp;', $this->spacer_size * (int)$category->level_depth);
		}
		
		$shop = (object) Shop::getShop((int)$category->getShopID());
		        if (in_array('CAT'.(int)$category->id, $cateCurrent)) {
					$this->_html .= '<option value="CAT'.(int)$category->id.'" selected ="selected" >'.(isset($spacer) ? $spacer : '').$category->name.' ('.$shop->name.')</option>';
				} else {
					$this->_html .= '<option value="CAT'.(int)$category->id.'">'.(isset($spacer) ? $spacer : '').$category->name.' ('.$shop->name.')</option>';
				}

		if (isset($children) && count($children))
			foreach ($children as $child)
				$this->getCategoryOption((int)$child['id_category'], (int)$id_lang, (int)$child['id_shop']);
    }

   
	
}