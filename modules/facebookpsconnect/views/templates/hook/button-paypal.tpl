{*
* 2003-2015 Business Tech
*
* @author Business Tech SARL <http://www.businesstech.fr/en/contact-us>
* @copyright  2003-2015 Business Tech SARL
*}
<a class='ao_bt_fpsc ao_bt_fpsc_paypal' href={if !empty($bJS)}\{/if}"javascript:void(0){if !empty($bJS)}\{/if}" onclick={if !empty($bJS)}\{/if}"javascript:popupWin = window.open('{$sModuleURI|escape:'UTF-8'}?sAction=connect&sType=plugin&connector=paypal{if !empty($sBackUri)}&back={$sBackUri|escape:'UTF-8'}{/if}', '{l s='login' mod='facebookpsconnect'}', 'location,width=600,height=600,top=0'); popupWin.focus();{if !empty($bJS)}\{/if}" title={if !empty($bJS)}\{/if}"Paypal{if !empty($bJS)}\{/if}"><span class='picto'></span><span class='title'>{l s='PayPal' mod='facebookpsconnect'}</span></a>