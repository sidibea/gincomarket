{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{extends file="helpers/form/form.tpl"}

{block name="field"}
	{if $input.type == 'htmlhr'}
		<div class="sep col-lg-{if isset($input.col)}{$input.col|intval}{else}9{/if} {if !isset($input.label)}col-lg-offset-3{/if}">
			<hr />
		</div>
    {elseif $input.type == 'switch' && $smarty.const._PS_VERSION_|@addcslashes:'\'' < '1.6'}
		{foreach $input.values as $value}
			<input type="radio" name="{$input.name}" id="{$value.id}" value="{$value.value|escape:'html':'UTF-8'}"
					{if $fields_value[$input.name] == $value.value}checked="checked"{/if}
					{if isset($input.disabled) && $input.disabled}disabled="disabled"{/if} />
			<label class="t" for="{$value.id}">
			 {if isset($input.is_bool) && $input.is_bool == true}
				{if $value.value == 1}
					<img src="../img/admin/enabled.gif" alt="{$value.label}" title="{$value.label}" />
				{else}
					<img src="../img/admin/disabled.gif" alt="{$value.label}" title="{$value.label}" />
				{/if}
			 {else}
				{$value.label}
			 {/if}
			</label>
			{if isset($input.br) && $input.br}<br />{/if}
			{if isset($value.p) && $value.p}<p>{$value.p}</p>{/if}
		{/foreach}
	{else}
		{$smarty.block.parent}
    {/if}

{/block}

{block name="input"}
    {if $input.type == 'radio' && isset($input.header) && $input.header} 
		<p class="help-block">
			{if is_array($input.header)}
				{foreach $input.header as $p}
					{if is_array($p)}
						<span class="{$p.class}">{$p.text}</span><br />
					{else}
						{$p}<br />
					{/if}
				{/foreach}
			{else}
				{$input.header}
			{/if}
		</p>
		{$smarty.block.parent}
   {elseif $input.type == 'agile_radio'}
		{foreach $input.values as $value}
			<div class="radio {if isset($input.class)}{$input.class}{/if}">
				{strip}
				<label>
				<input type="radio"	name="{$input.name}" id="{$value.id}" value="{$value.value|escape:'html':'UTF-8'}"{if $fields_value[$input.name] == $value.value} checked="checked"{/if}{if isset($input.disabled) && $input.disabled} disabled="disabled"{/if}/>
					{$value.label}
				</label>
				{/strip}
			</div>
			{if isset($value.p) }
				<p class="help-block">
				{if is_array($value.p)}
					{foreach $value.p as $p}
						{if is_array($p)}
							<span class="{$p.class}">{$p.text}</span><br />
						{else}
							{$p}<br />
						{/if}
					{/foreach}
				{else}
					{$value.p}
				{/if}
				</p>
			{/if}
		{/foreach}
   {elseif $input.type == 'checkboxgroup'}
		<p class="help-block">
			{if is_array($input.header)}
				{foreach $input.header as $p}
					{if is_array($p)}
						<span class="{$p.class}">{$p.text}</span><br />
					{else}
						{$p}<br />
					{/if}
				{/foreach}
			{else}
				{$input.header}
			{/if}
		</p>
		{foreach $input.values as $value}
			<div id='{$value.section_name}'>
			{foreach $value.items as $item}
				<input type="checkbox" name="{$item.name}" id="{$item.id}" value="1" {if isset($fields_value[$item.id]) && $fields_value[$item.id] == '1'}checked{/if}/>&nbsp;{$item.label}	
			{/foreach}
			</div>
		{/foreach}
    {else}
		{$smarty.block.parent}
    {/if}
{/block}
