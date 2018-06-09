{**
* Paypal Instant Checkout for PrestaShop.
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{extends file="helpers/options/options.tpl"}
{block name="leadin"}
    {if isset($smarty.post.currentFormTab)}
	{assign var="current_form_tab" value=$smarty.post.currentFormTab|escape:'quotes':'UTF-8'}
    {elseif isset($smarty.get.currentFormTab)}
        {assign var="current_form_tab" value=$smarty.get.currentFormTab|escape:'quotes':'UTF-8'}
    {else}
        {assign var="current_form_tab" value=paypal_account}
    {/if}
    <script>
        var currentFormTab = '{$current_form_tab|escape:'quotes':'UTF-8'}';
        var pathCSS = '{$smarty.const._THEME_CSS_DIR_|escape:'htmlall':'UTF-8'}';
        var ad = '{$admin_base_url|escape:'htmlall':'UTF-8'}';
    </script>
    <div class="productTabs">
        <ul class="tab nav nav-tabs">
            {foreach $option_list as $category => $categoryData}                                                                
            <li class="tab-row">				
                <a href="javascript:displayConfigurationTab('{$category|escape:'htmlall':'UTF-8'}');" id="configuration_link_{$category|escape:'htmlall':'UTF-8'}" class="tab-page">{$categoryData['tabTitle']|escape:'htmlall':'UTF-8'}</a>
            </li>
            {/foreach}
        </ul>
    </div>
   
{/block}
{block name="field"}
    {if $field['type'] == 'paypal_mode'}
        <div class="col-lg-9">
            <span class="switch prestashop-switch fixed-width-lg">
                {strip}
                <input type="radio" name="{$key|escape:'htmlall':'UTF-8'}" id="{$key|escape:'htmlall':'UTF-8'}_on" value="1" {if $field['value']} checked="checked"{/if}{if isset($field['disabled']) && (bool)$field['disabled']} disabled="disabled"{/if}/>
                <label for="{$key|escape:'htmlall':'UTF-8'}_on" class="radioCheck">
                        {$hs_translation['live']|escape:'htmlall':'UTF-8'}
                </label>
                <input type="radio" name="{$key|escape:'htmlall':'UTF-8'}" id="{$key|escape:'htmlall':'UTF-8'}_off" value="0" {if !$field['value']} checked="checked"{/if}{if isset($field['disabled']) && (bool)$field['disabled']} disabled="disabled"{/if}/>
                <label for="{$key|escape:'htmlall':'UTF-8'}_off" class="radioCheck">
                        {$hs_translation['sandbox']|escape:'htmlall':'UTF-8'}
                </label>
                {/strip}
                <a class="slide-button btn"></a>
            </span>
        </div>
    {elseif $field['type'] == 'paypal_default_customer'}
        <div class="col-lg-9">
            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
            <input type="text" name="PAYPAL_DEFAULT_CUSTOMER" placeholder="{$hs_translation['search_for_customer']|escape:'htmlall':'UTF-8'}" size="30" class="ui-autocomplete-input search_default_customer" autocomplete="off">
        </div>
        <div class="col-lg-9 col-lg-offset-3" style="padding-top:10px;">
            <span class="customer_info">
                {$field['customer']->firstname|escape:'htmlall':'UTF-8'} {$field['customer']->lastname|escape:'htmlall':'UTF-8'} ({$field['customer']->email|escape:'htmlall':'UTF-8'})
            </span> | 
            <a target="_blank" href="{$field['view_default_customer_url']|escape:'quotes':'UTF-8'}" class="view_customer btn-link">
                {$hs_translation['view']|escape:'htmlall':'UTF-8'} <i class="icon-external-link-sign"></i>
            </a>
        </div>
    {elseif $field['type'] == 'paypal_default_carrier'}
        <div class="col-lg-9">
            <select name="PAYPAL_DEFAULT_CARRIER" class="default_carrier fixed-width-xxl">
                {foreach $field['list_carriers'] as $carier}
                    {if $carier['value'] == $field['default_carrier']}
                        {assign var="selected" value='selected="selected"'}
                    {else}
                        {assign var="selected" value=''}
                    {/if}
                    <option value="{$carier['value']|intval}" {$selected|escape:'quotes':'UTF-8'}>{$carier['name']|escape:'htmlall':'UTF-8'}</option>
                {/foreach}
            </select>
            <a target="_blank" href="#" rel="{$field['view_carrier_url']|escape:'quotes':'UTF-8'}" class="btn btn-link bt-icon view_carrier">
                {$hs_translation.view|escape:'htmlall':'UTF-8'} <i class="icon-external-link-sign"></i>
            </a>
        </div>
    {elseif $field['type'] == 'paypal_default_address'}
        <div class="col-lg-9">
            <select name="PAYPAL_DEFAULT_ADDRESS" class="default_address fixed-width-xxl">
                {foreach $field['list_addresses'] as $address}
                    {if $address['id_address'] == $field['default_address']}
                        {assign var="selected" value='selected="selected"'}
                    {else}
                        {assign var="selected" value=''}
                    {/if}
                    <option value="{$address['id_address']|intval}" {$selected|escape:'quotes':'UTF-8'}>{$address['alias']|escape:'htmlall':'UTF-8'}</option>
                {/foreach}
            </select>
            <a target="_blank" href="#" rel="{$field['view_default_address_url']|escape:'quotes':'UTF-8'}" class="btn btn-link bt-icon view_address">
                {$hs_translation.view|escape:'htmlall':'UTF-8'} <i class="icon-external-link-sign"></i>
            </a>
        </div>
    {elseif $field['type'] == 'paypal_buttons'}
        <div class="col-lg-9">
            <script type="text/javascript">
            $(document).ready(function ()
            {
                // event click checked all checkbox
                $(document).on('click', '.checkAll', function ()
                {
                    if (this.checked)
                        $('.group-checkbox-paypal').each(function () {
                            this.checked = true;
                        });
                    else
                        $('.group-checkbox-paypal').each(function () {
                            this.checked = false;
                        });

                });

                $('.pp_position tr').tooltipster({
                    theme: 'tooltipster-pic',
                    position: 'right',
                    contentAsHTML: true
                })

                var path = "{$field['button_positions_data']['path_img']|escape:'quotes':'UTF-8'}";
                $('.pp_position tr').hover(
                        function () {
                            currentPosition = $(this).find('label').attr('for');
                            if (typeof currentPosition === 'undefined')
                                return;
                            if (currentPosition == 'PAYPAL_POSITION_DEFAULT_BUTTON')
                                return;
                            $(this).tooltipster('content', $('<img src="' + path + currentPosition + '.jpg" width="400" />'));
                        });
            });

            function setLanguage(language_id, language_code) {
                $("#lang-id").val(language_id);
                $(".selected-language").html(language_code);

                var custom_fields = ["PAYPAL_TEXT_DEFAULT_BUTTON",
                    "PAYPAL_TEXT_PRODUCT_PAGE",
                    "PAYPAL_TEXT_ADDING_TO_CART",
                    "PAYPAL_TEXT_BLOCK_CART",
                    "PAYPAL_TEXT_SHOPPING_CART",
                    "PAYPAL_TEXT_SP_CART_FOOTER",
                    "PAYPAL_TEXT_CHECKOUT_PAGE",
                    "PAYPAL_TEXT_PAYMENT",
                    "PAYPAL_TEXT_LIST_PAGE",
                    "PAYPAL_IMAGE_DEFAULT_BUTTON",
                    'PAYPAL_IMAGE_SHOPPING_CART',
                    'PAYPAL_IMAGE_BLOCK_CART',
                    'PAYPAL_IMAGE_ADDING_TO_CART',
                    'PAYPAL_IMAGE_PRODUCT_PAGE',
                    'PAYPAL_IMAGE_PAYMENT',
                    'PAYPAL_IMAGE_SP_CART_FOOTER',
                    'PAYPAL_IMAGE_CHECKOUT_PAGE'];
                for (var j = 0; j < custom_fields.length; ++j)
                {
                    var field = custom_fields[j];
                    var fieldsString = custom_fields[j] + "¤";
                    $("div[id^=" + field + "_]").hide();
                    var fields = fieldsString.split("¤");
                    for (var i = 0; i < fields.length; ++i)
                    {
                        $("div[id^=" + fields[i] + "_]").hide();
                        $("#" + fields[i] + "_" + language_id).show();
                    }
                }
                id_language = language_id;
            }

            $(document).on('change', ".data_input_name", function () {
                var id_label = $(this).attr("data-id");
                var wrapper = $("#" + id_label),
                        inp = wrapper.find("input"),
                        btn = wrapper.find("span"),
                        lbl = wrapper.find("mark");
                var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;
                var file_name;
                if (file_api && inp[0].files[0])
                    file_name = inp[0].files[0].name;
                else
                    file_name = inp.val().replace("C:\\", '');
                if (!file_name.length)
                    return;
                lbl.text(file_name);
            });

        </script>
        <table cellspacing="0" cellpadding="0" class="table table-bordered pp_position" style="width:32em;">
            <tbody>
                <tr>
                    <th style="background-color: #179BD7;">
                        <input type="checkbox" name="checkAll" class="checkAll">
                    </th>
                    <th style="background-color: #179BD7; color: #FFFFFF">{$hs_translation.block_page|escape:'htmlall':'UTF-8'} </th>
                </tr>
                
                {foreach from=$field['button_positions_data']['button_positions'] key=config_key item=config_name name=ppbutton}
                    <tr>
                        <td>
                            {if $config_key != 'PAYPAL_POSITION_DEFAULT_BUTTON'}
                                <input type="checkbox" class="group-checkbox-paypal" id="{$config_key|escape:'htmlall':'UTF-8'}" name="{$config_key|escape:'htmlall':'UTF-8'}" {if $field['button_positions_data']['button_position_values'].$config_key == 1}checked="checked"{/if} value="1">
                            {/if}
                        </td>
                        <td class="pp_config_name">
                            <label style="font-weight: bold; float:none; width: 100%" for="{$config_key|escape:'htmlall':'UTF-8'}">{$config_name.title|escape:'string':'UTF-8'}</label>
                            {foreach from=$field['button_positions_data']['languages'] item=lang}
                                <div id="{$config_name.name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" class = "text_fields" style="display:{if $lang.id_lang == $field['button_positions_data']['default_lang']}block{else}none{/if}; float: left;">
                                    <input type="text" name="{$config_name.name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" placeholder="{$field['button_positions_data']['placeholder']|escape:'html':'UTF-8'}" value="{if !empty($config_name['labels'][$lang['id_lang']])}{$config_name['labels'][$lang['id_lang']]|escape:'html':'UTF-8'}{/if}" size="31"/>
                                </div>
                            {/foreach}
                            <div class="language flag-field form-group">
                                <div class="col-lg-1 ">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                                        <span class="selected-language">
                                            {foreach from=$field['button_positions_data']['languages'] item=lang}
                                                {if $lang.id_lang == $field['button_positions_data']['default_lang']} {$lang.iso_code|escape:'html':'UTF-8'}{/if}
                                            {/foreach}
                                        </span>
                                        <span class="caret">&nbsp;</span>
                                    </button>
                                    <ul class="languages dropdown-menu">
                                        {foreach from=$field['button_positions_data']['languages'] item=lang}
                                            <li id="lang-{$lang.id_lang|escape:'htmlall':'UTF-8'}" class="new-lang-flag"><a href="javascript:setLanguage({$lang.id_lang|escape:'htmlall':'UTF-8'}, '{$lang.iso_code|escape:'htmlall':'UTF-8'}');">{$lang.name|escape:'htmlall':'UTF-8'}</a></li>
                                            {/foreach}
                                    </ul>
                                </div>
                            </div>
                            {foreach from=$field['button_positions_data']['languages'] item=lang}
                                {if {$config_name.image_name} == 'PAYPAL_IMAGE_LIST_PAGE'}
                                {else}
                                    <div id="{$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" style="display:{if $lang.id_lang == $field['button_positions_data']['default_lang']}block{else}none{/if}; float: left;">
                                        {if !empty($config_name.image_link[$lang.id_lang])}
                                            <div class ="img-rounded">
                                                <img src="{$config_name.image_link[$lang.id_lang]|escape:'quotes':'UTF-8'}">
                                                <a href="{$field['button_positions_data']['postAction']|escape:'quotes':'UTF-8'}&amp;currentFormTab=paypal_button&amp;removeImage&amp;image_id={$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" name="removeImage" class="link-image-delete">
                                                    {if $is_prestashop16}
                                                        <i class="icon-trash" title=""></i>
                                                    {else}
                                                        <img alt="{$hs_translation.delete|escape:'htmlall':'UTF-8'}" src="../img/admin/delete.gif">
                                                    {/if}
                                                </a>
                                            </div>
                                        {/if}
                                        <label class="file_upload" id="file_{$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}">
                                            {if empty($config_name.image_link[$lang.id_lang])}
                                                <mark></mark>
                                            {/if}
                                            <span class="button">{$config_name.image_text[$lang.id_lang]|escape:'html':'UTF-8'}</span>
                                            <input class='data_input_name' type="file" name="{$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}"   data-id="file_{$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}"/>
                                        </label>
                                    </div>
                                {/if}
                            {/foreach}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        </div>
    {elseif $field['type'] == 'pos_title'}
        <div class="panel-heading">
            {if isset($field['title'])}{$field['title']|escape:'quotes':'UTF-8'}{/if}
        </div>
    {else}    
        {$smarty.block.parent}
    {/if}
{/block}