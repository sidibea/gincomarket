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

{if $status == 'ok'}
    <p>{l s='Votre paiement sur' mod='vitepay'} <span class="bold">{$shop_name|escape:'htmlall':'UTF-8'}</span> {l s='est validé.' mod='vitepay'}
        <br /><br /><span class="bold">{l s='Votre commande sera traitée dans les plus bref délais .' mod='vitepay'}</span>
        <br /><br />{l s='Pour plus d informations veuillez s il vous plait contacter notre service support'   mod='vitepay'} <a href="{$link->getPageLink('contact', true)|escape:'htmlall':'UTF-8'}">{l s='support client' mod='vitepay'}</a>.
    </p>
{else}
    {if $status == 'pending'}
        <p>{l s='Votre paiement sur' mod='vitepay'} <span class="bold">{$shop_name|escape:'htmlall':'UTF-8'}</span> {l s='Est en attente.' mod='vitepay'}
            <br /><br /><span class="bold">{l s='Votre commande sera livrée des nous recevrons le transfert.' mod='vitepay'}</span>
            <br /><br />{l s='Pour plus d informations veuillez s il vous plait contacter notre service support' mod='vitepay'} <a href="{$link->getPageLink('contact', true)|escape:'htmlall':'UTF-8'}">{l s='support client' mod='vitepay'}</a>.
        </p>
    {else}
        <p class="warning">
            {l s='Nous avons remarqué un problème Avec votre paiement, Si vous pensez que c est une erreur, Veuillez s il vous plait contacter notre service client' mod='vitepay'}
            <a href="{$link->getPageLink('contact', true)|escape:'htmlall':'UTF-8'}">{l s='support client' mod='vitepay'}</a>.
        </p>
    {/if}
{/if}
