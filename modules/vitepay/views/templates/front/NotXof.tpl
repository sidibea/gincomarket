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
    <p class="payment_module"><a href='#'>
    {l s='ATTENTION !!! Seul les paiement en FCFA (XOF) sont possible avec ' mod='vitepay'} <span class="bold">{$shop_name|escape:'htmlall':'UTF-8'}</span> {l s='' mod='vitepay'}
        <br /><br /><span class="bold">{l s='Vous devez changer affecter vitepay a la devise FCFA ou XOF sur le tableau de bord. vitepay est actuellement affecté à =' mod='vitepay'}</span> {$currency|escape:'htmlall':'UTF-8'}
        <br /><br />{l s='Pour plus d informations veuillez s il vous plait contacter notre service support'   mod='vitepay'} <span class="navigation-pipe">{$navigationPipe}</span></a>
    </p>
</div>
<div class="clear"></div>