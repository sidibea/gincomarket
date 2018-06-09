{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{literal}
    <style>
        #module-paypalinstantcheckout-ppaddress #center_column {
            width: 757px;
            margin-right: 0;
        }

        #account-creation_form  fieldset, fieldset.account_creation {
            padding:0 0 15px 0;
            border:1px solid #ccc;
            background:#f8f8f8
        }
        #account-creation_form  h3 {
            margin:0 0 15px 0;
            padding:8px;
            font-size:14px;
            color:#fff;
            text-transform:uppercase;
            background:#989898
        }
        #center_column #account-creation_form p {margin:0; padding:0 0 10px 0;}
        #account-creation_form p.required {color:#222}
        #account-creation_form p.required  sup {color:#990000}

        #account-creation_form p.radio span,
        #account-creation_form p.text label,
        #account-creation_form p.password label,
        #account-creation_form p.select label,
        #account-creation_form p.select span,
        #account-creation_form p.textarea label {
            display:inline-block;
            padding:6px 15px;
            width:230px;/* 260 */
            font-size:14px;
            text-align:right
        }
        #account-creation_form p.radio label {
            float:none;
            padding-right:10px;
            width:auto;
            font-size:14px
        }
        #account-creation_form p.checkbox label {
            float:none;
            width:auto;
            font-size:12px
        }
        #account-creation_form p.text input,
        #account-creation_form p.password input,
        #account-creation_form p.select input {
            padding:0 5px;
            height:22px;
            width:360px;/* 370 */
            border:1px solid #ccc;
            font-size: 12px;
            color:#666
        }

        #account-creation_form span.inline-infos{display:inline-block;}
        #account-creation_form p.checkbox input {
            margin-left:260px;
        }
        #account-creation_form p.select select {
            margin-right:10px;
            border:1px solid #ccc;
            font-size: 12px;
            color:#666
        }
        #account-creation_form p.textarea textarea {
            height:80px;
            width:370px;
            border:1px solid #ccc;
            font-size: 12px;
            color:#666
        }

        #account-creation_form span.form_info {
            display:block;
            margin:5px 0 0 265px;
            color:#666
        }
        #account-creation_form p.inline-infos {
            margin:0 0 0 100px !important;
            font-size:12px;
            color:#666;
        }

        #center_column #account-creation_form p.cart_navigation {margin:20px 0}
    </style>
{/literal}

<script type="text/javascript">
// <![CDATA[
    var idSelectedCountry = {if isset($smarty.post.id_state)}{$smarty.post.id_state|intval}{else}{if isset($address->id_state)}{$address->id_state|intval}{else}false{/if}{/if};
        var countries = new Array();
        var countriesNeedIDNumber = new Array();
        var countriesNeedZipCode = new Array();
    {foreach from=$countries item='country'}
            {if isset($country.states) && $country.contains_states}
        countries[{$country.id_country|intval}] = new Array();
                {foreach from=$country.states item='state' name='states'}
        countries[{$country.id_country|escape:'html':'UTF-8'}].push({ldelim}'id': '{$state.id_state|escape:'html':'UTF-8'}', 'name': '{$state.name|escape:'html':'UTF-8'}'{rdelim});
            {/foreach}
        {/if}
            {if $country.need_identification_number}
            countriesNeedIDNumber.push({$country.id_country|escape:'html':'UTF-8'});
        {/if}
            {if isset($country.need_zip_code)}
            countriesNeedZipCode[{$country.id_country|escape:'html':'UTF-8'}] = {$country.need_zip_code|escape:'html':'UTF-8'};
        {/if}
    {/foreach}
            $(function (){ldelim}
                    $('.id_state option[value={if isset($smarty.post.id_state|escape:'html':'UTF-8')}{$smarty.post.id_state|escape:'html':'UTF-8'}{else}{if isset($address->id_state)}{$address->id_state|escape:'html':'UTF-8'}{/if}{/if}]').attr('selected', true);
    {rdelim});
    {literal}
    $(document).ready(function () {
        $('#company').blur(function () {
            vat_number();
        });
        vat_number();
        function vat_number()
        {
            if ($('#company').val() != '')
                $('#vat_number').show();
            else
                $('#vat_number').hide();
        }
    });
    {/literal}
//]]>
</script>

{capture name=path}{$hs_translation.your_addresses|escape:'html':'UTF-8'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h1>{$hs_translation.paypal_confirmation_screen|escape:'html':'UTF-8'}</h1>

<h3>
    {if isset($id_address) && (isset($smarty.post.alias) || isset($address->alias))}
        {$hs_translation.modify_address|escape:'html':'UTF-8'}
        {if isset($smarty.post.alias)}
            "{$smarty.post.alias|escape:'html':'UTF-8'}"
        {else}
            {if isset($address->alias)}"{$address->alias|escape:'html':'UTF-8'}"{/if}
        {/if}
    {else}
        {$hs_translation.to_add_a_new_address_please_fill_out_the_form_below|escape:'html':'UTF-8'}
    {/if}
</h3>

{include file="$tpl_dir./errors.tpl"}

<form action="{$link->getModuleLink('paypalinstantcheckout','ppaddress')|escape:'html':'UTF-8'}" method="post" class="std" id="account-creation_form">
    <fieldset>
        <h3>{if isset($id_address)}{$hs_translation.your_address|escape:'html':'UTF-8'}{else}{$hs_translation.new_address|escape:'html':'UTF-8'}{/if}</h3>
        <p class="required text dni">
            <label for="dni">{$hs_translation.identification_number|escape:'html':'UTF-8'}</label>
            <input type="text" class="text" name="dni" id="dni" value="{if isset($smarty.post.dni)}{$smarty.post.dni|escape:'html':'UTF-8'}{else}{if isset($address->dni)}{$address->dni|escape:'html':'UTF-8'}{/if}{/if}" /> <sup>*</sup>
            <span class="form_info">{$hs_translation.dni_nif_nie|escape:'html':'UTF-8'}</span>
        </p>
        {assign var="stateExist" value="false"}
        {foreach from=$ordered_adr_fields item=field_name}
            {if $field_name eq 'company'}
                <p class="text">
                    <input type="hidden" name="token" value="{$token|escape:'html':'UTF-8'}" />
                    <label for="company">{$hs_translation.company|escape:'html':'UTF-8'}</label>
                    <input type="text" id="company" name="company" value="{if isset($smarty.post.company)}{$smarty.post.company|escape:'html':'UTF-8'}{else}{if isset($address->company)}{$address->company|escape:'html':'UTF-8'}{/if}{/if}" />
                </p>
                <div id="vat_area">
                    <div id="vat_number">
                        <p class="text">
                            <label for="vat_number">{$hs_translation.vat_number|escape:'html':'UTF-8'}</label>
                            <input type="text" class="text" name="vat_number" value="{if isset($smarty.post.vat_number)}{$smarty.post.vat_number|escape:'html':'UTF-8'}{else}{if isset($address->vat_number)}{$address->vat_number|escape:'html':'UTF-8'}{/if}{/if}" />
                        </p>
                    </div>
                </div>
            {/if}
            {if $field_name eq 'firstname'}
                <p class="required text">
                    <label for="firstname">{$hs_translation.first_name|escape:'html':'UTF-8'}</label>
                    <input type="text" name="firstname" id="firstname" value="{if isset($smarty.post.firstname)}{$smarty.post.firstname|escape:'html':'UTF-8'}{else}{if isset($address->firstname)}{$address->firstname|escape:'html':'UTF-8'}{/if}{/if}" /> <sup>*</sup>
                </p>
            {/if}
            {if $field_name eq 'lastname'}
                <p class="required text">
                    <label for="lastname">{$hs_translation.last_name|escape:'html':'UTF-8'}</label>
                    <input type="text" id="lastname" name="lastname" value="{if isset($smarty.post.lastname)}{$smarty.post.lastname|escape:'html':'UTF-8'}{else}{if isset($address->lastname)}{$address->lastname|escape:'html':'UTF-8'}{/if}{/if}" /> <sup>*</sup>
                </p>
            {/if}
            {if $field_name eq 'address1':'UTF-8'}
                <p class="required text">
                    <label for="address1">{$hs_translation.address|escape:'html':'UTF-8'}</label>
                    <input type="text" id="address1" name="address1" value="{if isset($smarty.post.address1)}{$smarty.post.address1|escape:'html':'UTF-8'}{else}{if isset($address->address1)}{$address->address1|escape:'html':'UTF-8'}{/if}{/if}" /> <sup>*</sup>
                </p>
            {/if}
            {if $field_name eq 'address2':'UTF-8'}
                <p class="required text">
                    <label for="address2">{$hs_translation.address_line_2|escape:'html':'UTF-8'}</label>
                    <input type="text" id="address2" name="address2" value="{if isset($smarty.post.address2)}{$smarty.post.address2|escape:'html':'UTF-8'}{else}{if isset($address->address2)}{$address->address2|escape:'html':'UTF-8'}{/if}{/if}" />
                </p>
            {/if}
            {if $field_name eq 'postcode':'UTF-8'}
                <p class="required postcode text">
                    <label for="postcode">{$hs_translation.zip_postal_code|escape:'html':'UTF-8'}</label>
                    <input type="text" id="postcode" name="postcode" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode|escape:'html':'UTF-8'}{else}{if isset($address->postcode)}{$address->postcode|escape:'html':'UTF-8'}{/if}{/if}" onkeyup="$('#postcode').val($('#postcode').val().toUpperCase());" /> <sup>*</sup>
                </p>
            {/if}
            {if $field_name eq 'city':'UTF-8'}
                <p class="required text">
                    <label for="city">{$hs_translation.city|escape:'html':'UTF-8'}</label>
                    <input type="text" name="city" id="city" value="{if isset($smarty.post.city)}{$smarty.post.city|escape:'html':'UTF-8'}{else}{if isset($address->city)}{$address->city|escape:'html':'UTF-8'}{/if}{/if}" maxlength="64" />  <sup>*</sup>
                </p>
                {*
                if customer hasn't update his layout address, country has to be verified
                but it's deprecated
                *}
            {/if}
            {if $field_name eq 'Country:name' || $field_name eq 'country'}
                <p class="required select">
                    <label for="id_country">{$hs_translation.country|escape:'html':'UTF-8'}</label>
                    <select id="id_country" name="id_country">{$countries_list|escape:'html':'UTF-8'}</select>  <sup>*</sup>
                </p>
                {if $vatnumber_ajax_call}
                    <script type="text/javascript">
                        var ajaxurl = '{$ajaxurl|escape:'html':'UTF-8'}';
                        {literal}
                                $(document).ready(function () {
                                    $('#id_country').change(function () {
                                        $.ajax({
                                            type: "GET",
                                            url: ajaxurl + "vatnumber/ajax.php?id_country=" + $('#id_country').val(),
                                            success: function (isApplicable) {
                                                if (isApplicable == "1")
                                                {
                                                    $('#vat_area').show();
                                                    $('#vat_number').show();
                                                }
                                                else
                                                {
                                                    $('#vat_area').hide();
                                                }
                                            }
                                        });
                                    });
                                });
                        {/literal}
                    </script>
                {/if}
            {/if}
            {if $field_name eq 'State:name'}
                {assign var="stateExist" value="true"}
                <p class="required id_state select">
                    <label for="id_state">{$hs_translation.state|escape:'html':'UTF-8'}</label>
                    <select name="id_state" id="id_state">
                        <option value="">-</option>
                    </select>  <sup>*</sup>
                </p>
            {/if}
        {/foreach}
        {if $stateExist eq "false"}
            <p class="required id_state select">
                <label for="id_state">{$hs_translation.state|escape:'html':'UTF-8'}</label>
                <select name="id_state" id="id_state">
                    <option value="">-</option>
                </select>  <sup>*</sup>
            </p>
        {/if}
        <p class="textarea">
            <label for="other">{$hs_translation.additional_information|escape:'html':'UTF-8'}</label>
            <textarea id="other" name="other" cols="26" rows="3">{if isset($smarty.post.other)}{$smarty.post.other|escape:'html':'UTF-8'}{else}{if isset($address->other)}{$address->other|escape:'html':'UTF-8'}{/if}{/if}</textarea>
        </p>
        {if $one_phone_at_least}
            <p style="margin-left: 50px" class="phone-required inline-infos required">{$hs_translation.you_must_register_at_least_one_phone_number|escape:'html':'UTF-8'} <sup>*</sup></p>
        {/if}
        <p class="text">
            <label for="phone">{$hs_translation.home_phone|escape:'html':'UTF-8'}</label>
            <input type="text" id="phone" name="phone" value="{if isset($smarty.post.phone)}{$smarty.post.phone|escape:'html':'UTF-8'}{else}{if isset($address->phone)}{$address->phone|escape:'html':'UTF-8'}{/if}{/if}" />
        </p>
        <p id="pp_phone_mobile" class="{if $one_phone_at_least}required {/if}text">
            <label for="phone_mobile">{$hs_translation.mobile_phone|escape:'html':'UTF-8'}{if $one_phone_at_least}{/if}</label>
            <input type="text" id="phone_mobile" name="phone_mobile" value="{if isset($smarty.post.phone_mobile)}{$smarty.post.phone_mobile|escape:'html':'UTF-8'}{else}{if isset($address->phone_mobile) AND $address->phone_mobile!='000000000'}{$address->phone_mobile|escape:'html':'UTF-8'}{/if}{/if}" />
        </p>
        <p class="required text" id="adress_alias">
            <label for="alias">{$hs_translation.give_this_address_a_name_eg_address1_or_stushouse|escape:'html':'UTF-8'}</label>
            <input type="text" id="alias" name="alias" value="{if isset($smarty.post.alias)}{$smarty.post.alias|escape:'html':'UTF-8'}{else if isset($address->alias)}{$address->alias|escape:'html':'UTF-8'}{else if !isset($select_address)}{$hs_translation.my_address|escape:'html':'UTF-8'}{/if}" /> <sup>*</sup>
        </p>
    </fieldset>
    <p class="submit2">
        {if isset($id_address)}<input type="hidden" name="id_address" value="{$id_address|intval}" />{/if}
        {if isset($back)}<input type="hidden" name="back" value="{$back|escape:'quotes':'UTF-8'}" />{/if}
        {if isset($mod)}<input type="hidden" name="mod" value="{$mod|escape:'html':'UTF-8'}" />{/if}
        {if isset($select_address)}<input type="hidden" name="select_address" value="{$select_address|escape:'html':'UTF-8'}" />{/if}
        <input type="submit" name="submitAddress" id="submitAddress" value="{$hs_translation.finished|escape:'html':'UTF-8'}" class="button" />
    </p>
    <p class="required"><sup>*</sup> {$hs_translation.required_field|escape:'html':'UTF-8'}</p>
</form>