{*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class='vitepayPayNow'>
    <form id='vitepayPayNow' action="{$data.vitepay_url|escape:'htmlall':'UTF-8'}" method="post">
        <p class="payment_module">
            {foreach $data.info as $k=>$v}
                <input type="hidden" name="{$k|escape:'htmlall':'UTF-8'}" value="{$v|escape:'htmlall':'UTF-8'}" />
            {/foreach}
            <a href='#' style="font-size:30px" onclick='document.getElementById("vitepayPayNow").submit();return false;'>{$data.vitepay_paynow_text|escape:'htmlall':'UTF-8'}
                {if $data.vitepay_paynow_logo=='on'} <img align='{$data.vitepay_paynow_align|escape:'htmlall':'UTF-8'}' alt='Payer avec Vitepay' title='Payer avec vitepay' src="{$base_dir|escape:'htmlall':'UTF-8'}modules/vitepay/views/img/vitepay.png">{/if}</a>
        <noscript><input type="image" src="{$base_dir|escape:'htmlall':'UTF-8'}modules/vitepay/views/img/vitepay.png"></noscript>
        </p>
    </form>
</div>
<div class="clear"></div>
