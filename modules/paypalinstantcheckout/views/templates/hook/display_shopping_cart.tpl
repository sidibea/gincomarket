{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}
{if $is_prestashop17}
    {include file="../hook/paypal_button_17.tpl"}
{else}
    {include file="../hook/paypal_button.tpl"}
{/if}
