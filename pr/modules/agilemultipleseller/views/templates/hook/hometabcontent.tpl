{*
This source file is subject to the Software License Agreement that is bundled with this 
package in the file license.txt, or you can get it here
http://addons-modules.com/en/content/3-terms-and-conditions-of-use

@copyright  2009-2014 Addons-Modules.com
*}
<ul id="agilesellwithus" class="row agilesellwithus clearfix tab-pane">
	<h4 class="title_block">{l s='Sell With US' mod='agilemultipleseller'}</h4>
	<form action="{$link->getPageLink('authentication', true, NULL, "")|escape:'html':'UTF-8'}" method="post" id="new_account_form" class="std clearfix">

		{include file="$agilemultipleseller_tpl./hook/displaycustomeraccountform.tpl"}

	  <div class="agile-emptyrow"></div>

		<center>
		<div class="submit clearfix">
			<input type="hidden" name="email_create" value="1" />
			<input type="hidden" name="is_new_customer" value="1" />
			{if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'html':'UTF-8'}" />{/if}
			<button type="submit" name="submitAccount" id="submitAccount" class="agile-btn agile-btn-default button button-medium">
				<span>{l s='Register' mod='agilemultipleseller'}<i class="icon-chevron-right right"></i></span>
			</button>
			<p class="pull-right required"><span><sup>*</sup>{l s='Required field' mod='agilemultipleseller'}</span></p>
		</div>
		</center>

	</form>
</ul>
