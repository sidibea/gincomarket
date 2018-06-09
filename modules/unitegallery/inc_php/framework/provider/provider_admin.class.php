<?php

   class UniteProviderAdminUG extends UniteGalleryAdmin{
   	

	   	private static $t;
   		public static $arrScripts = array();
   		public static $arrStyles = array();
   		

		/**
		 *
		 * the constructor
		 */
		public function __construct(){
			self::$t = $this;
			
			if(self::isInsidePlugin() == false)
				return(false);
			
			parent::__construct();
						
			$this->init();
		}		
		
		
		/**
		 * check if inside plugin
		 */
		public static function isInsidePlugin(){
			
			$configure = UniteFunctionsUG::getGetVar("configure");
			
			//$moduleName = UniteFunctionsUG::getGetVar("module_name");
			if($configure == GlobalsUG::PLUGIN_NAME)
				return(true);
			
			return(false);
		}

		
		/**
		 * 
		 * init function
		 */
		protected function init(){
						
			parent::init();		//init the galleries
			
			$this->onAddScripts();
			
		}

		
		/**
		 * get hooks array
		 */
		public static function getArrHooks(){

			$arrHooks = array("displayTop",
					"displayHome",
					"displayLeftColumn",
					"displayRightColumn",
					"displayTopColumn",
					"displayBanner",
					"displayHeader",
					"displayFooter",
					"displayLeftColumnProduct",
					"displayRightColumnProduct",
					"displayProductButtons",
					"displayFooterProduct",
					"displayCarrierList",
					"displayBeforeCarrier",
					"displayPaymentTop",
					"displayPaymentReturn",
					"displayOrderConfirmation",
					"displayShoppingCart",
					"displayShoppingCartFooter",
					"dislayMyAccountBlock",
					"displayCustomerAccountFormTop",
					"displayCustomerAccountForm",
					"displayMyAccountBlock",
					"displayMyAccountBlockfooter"
			);
			
			return($arrHooks);
			
		}
		
	}

?>