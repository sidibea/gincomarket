{*
* 2007-2013 PrestaShop
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
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{foreach from=$languages item=language}
	<div class="translatable-field row lang-{$language.id_lang}">
		<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			{if isset($maxchar)}
			<div class="input-group">
				<span id="{$input_name}_{$language.id_lang}_counter" class="input-group-addon">
					<span class="text-count-down">{$maxchar}</span>
				</span>
				{/if}
				<input type="text"
				id="{$input_name}_{$language.id_lang}"
				{if isset($input_class)}class="{$input_class}"{/if}
				name="{$input_name}_{$language.id_lang}"
				value="{$input_value[$language.id_lang]|htmlentitiesUTF8|default:''}"
				onkeyup="if (isArrowKey(event)) return ;updateFriendlyURL();"
				onblur="updateLinkRewrite();"
				{if isset($maxchar)} data-maxchar="{$maxchar}"{/if}
				{if isset($maxlength)} maxlength="{$maxlength}"{/if} />
				{if isset($maxchar)}
			</div>
			{/if}
		</div>
	{if $languages|count > 1}
		<div class="agile-col-sm-2 agile-col-md-2 agile-col-lg-2 agile-col-xl-2">
			<button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" data-toggle="agile-dropdown" tabindex="-1">
				{$language.iso_code}
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				{foreach from=$languages item=language}
				<li>
					<a href="javascript:hideOtherLanguage({$language.id_lang});">{$language.name}</a>
				</li>
				{/foreach}
			</ul>
		</div>
	{/if}
	</div>
{/foreach}
{if isset($maxchar)}
<script type="text/javascript">
function countDown($source, $target) {
	var max = $source.attr("data-maxchar");
	$target.html(max-$source.val().length);

	$source.keyup(function(){
		$target.html(max-$source.val().length);
	});
}

$(document).ready(function(){
{foreach from=$languages item=language}
	countDown($("#{$input_name}_{$language.id_lang}"), $("#{$input_name}_{$language.id_lang}_counter"));
{/foreach}
});
</script>
{/if}
