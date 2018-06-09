{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}
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

        var path = "{$path_img|escape:'quotes':'UTF-8'}";
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
        {foreach from=$button_positions key=config_key item=config_name}
            <tr>
                <td>
                    {if $config_key != 'PAYPAL_POSITION_DEFAULT_BUTTON'}
                        <input type="checkbox" class="group-checkbox-paypal" id="{$config_key|escape:'html':'UTF-8'}" name="{$config_key|escape:'string':'UTF-8'}" {if $button_position_values.$config_key == 1}checked="checked"{/if} value="1">
                    {/if}
                </td>
                <td class="pp_config_name">
                    <label style="font-weight: bold; float:none; width: 100%" for="{$config_key|escape:'html':'UTF-8'}">{$config_name.title|escape:'string':'UTF-8'}</label>
                    {foreach from=$languages item=lang}
                        <div id="{$config_name.name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" class = "text_fields" style="display:{if $lang.id_lang == $default_lang}block{else}none{/if}; float: left;">
                            <input type="text" name="{$config_name.name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" placeholder="{$placeholder|escape:'html':'UTF-8'}" value="{if !empty($config_name.labels[$lang.id_lang])}{$config_name.labels[$lang.id_lang]|escape:'html':'UTF-8'}{/if}" size="31"/>
                        </div>
                    {/foreach}
                    <div class="language flag-field form-group">
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                                <span class="selected-language">
                                    {foreach from=$languages item=lang}
                                        {if $lang.id_lang == $default_lang} {$lang.iso_code|escape:'html':'UTF-8'}{/if}
                                    {/foreach}
                                </span>
                                <span class="caret">&nbsp;</span>
                            </button>
                            <ul class="languages dropdown-menu">
                                {foreach from=$languages item=lang}
                                    <li id="lang-{$lang.id_lang|escape:'htmlall':'UTF-8'}" class="new-lang-flag"><a href="javascript:setLanguage({$lang.id_lang|escape:'htmlall':'UTF-8'}, '{$lang.iso_code|escape:'htmlall':'UTF-8'}');">{$lang.name|escape:'htmlall':'UTF-8'}</a></li>
                                    {/foreach}
                            </ul>
                        </div>
                    </div>
                    {foreach from=$languages item=lang}
                        {if {$config_name.image_name} == 'PAYPAL_IMAGE_LIST_PAGE'}
                        {else}
                            <div id="{$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" style="display:{if $lang.id_lang == $default_lang}block{else}none{/if}; float: left;">
                                {if !empty($config_name.image_link[$lang.id_lang])}
                                    <div class ="img-rounded">
                                        <img src="{$config_name.image_link[$lang.id_lang]|escape:'quotes':'UTF-8'}">
                                        <a href="{$postAction|escape:'quotes':'UTF-8'}&amp;removeImage&amp;image_id={$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}" name="removeImage" class="link-image-delete">
                                            <i class="icon-trash" title=""></i>
                                        </a>
                                    </div>
                                {/if}
                                <label class="file_upload" id="file_{$config_name.image_name|escape:'html':'UTF-8'}_{$lang.id_lang|escape:'html':'UTF-8'}">
                                    {if empty($config_name.image_link[$lang.id_lang])}
                                        <mark></mark>
                                        {/if}
                                    <span class = "button">{$config_name.image_text[$lang.id_lang]|escape:'html':'UTF-8'}</span>
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
