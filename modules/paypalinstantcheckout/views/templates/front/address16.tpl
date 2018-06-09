{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{capture name=path}{$hs_translation.your_addresses|escape:'html':'UTF-8'}{/capture}
<div class="box">
    <h1>{$hs_translation.paypal_confirmation_screen|escape:'html':'UTF-8'}</h1>
    <p class="info-title">
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
    </p>
    {include file="$tpl_dir./errors.tpl"}
    <p class="required"><sup>*</sup>{$hs_translation.required_field|escape:'html':'UTF-8'}</p>
    <form action="{$link->getModuleLink('paypalinstantcheckout','ppaddress')|escape:'html':'UTF-8'}" method="post" class="std" id="account-creation_form">
        {$hs_translation.your_address|escape:'html':'UTF-8'}
        {assign var="stateExist" value=false}
        {assign var="postCodeExist" value=false}
        {assign var="dniExist" value=false}
        {assign var="homePhoneExist" value=false}
        {assign var="mobilePhoneExist" value=false}
        {assign var="atLeastOneExists" value=false}
        {foreach from=$ordered_adr_fields item=field_name}
            {if $field_name eq 'company'}
                <div class="form-group">
                    <label for="company">{$hs_translation.company|escape:'html':'UTF-8'}</label>
                    <input class="form-control validate" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" id="company" name="company" value="{if isset($smarty.post.company)}{$smarty.post.company|escape:'html':'UTF-8'}{else}{if isset($address->company)}{$address->company|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
            {if $field_name eq 'vat_number'}
                <div id="vat_area">
                    <div id="vat_number">
                        <div class="form-group">
                            <label for="vat-number">{$hs_translation.vat_number|escape:'html':'UTF-8'}</label>
                            <input type="text" class="form-control validate" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" id="vat-number" name="vat_number" value="{if isset($smarty.post.vat_number)}{$smarty.post.vat_number|escape:'html':'UTF-8'}{else}{if isset($address->vat_number)}{$address->vat_number|escape:'html':'UTF-8'}{/if}{/if}" />
                        </div>
                    </div>
                </div>
            {/if}
            {if $field_name eq 'dni'}
                {assign var="dniExist" value=true}
                <div class="required form-group">
                    <label for="dni">{$hs_translation.identification_number|escape:'html':'UTF-8'}</label>
                    <input class="form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" name="dni" id="dni" value="{if isset($smarty.post.dni)}{$smarty.post.dni|escape:'html':'UTF-8'}{else}{if isset($address->dni)}{$address->dni|escape:'html':'UTF-8'}{/if}{/if}" />
                    <span class="form_info">{$hs_translation.dni_nif_nie|escape:'html':'UTF-8'}</span>
                </div>
            {/if}
            {if $field_name eq 'firstname' }
                <div class="required form-group">
                    <label for="firstname">{$hs_translation.first_name|escape:'html':'UTF-8'} <sup>*</sup></label>
                    <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" name="firstname" id="firstname" value="{if isset($smarty.post.firstname)}{$smarty.post.firstname|escape:'html':'UTF-8'}{else}{if isset($address->firstname)}{$address->firstname|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
            {if $field_name eq 'lastname'}
                <div class="required form-group">
                    <label for="lastname">{$hs_translation.last_name|escape:'html':'UTF-8'} <sup>*</sup></label>
                    <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" id="lastname" name="lastname" value="{if isset($smarty.post.lastname)|escape:'html':'UTF-8'}{$smarty.post.lastname|escape:'html':'UTF-8'}{else}{if isset($address->lastname)}{$address->lastname|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
            {if $field_name eq 'address1'}
                <div class="required form-group">
                    <label for="address1">{$hs_translation.address|escape:'html':'UTF-8'}<sup>*</sup></label>
                    <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" id="address1" name="address1" value="{if isset($smarty.post.address1)}{$smarty.post.address1|escape:'html':'UTF-8'}{else}{if isset($address->address1)}{$address->address1|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
            {if $field_name eq 'address2'}
                <div class="required form-group">
                    <label for="address2">{$hs_translation.address_line_2|escape:'html':'UTF-8'}</label>
                    <input class="validate form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" id="address2" name="address2" value="{if isset($smarty.post.address2)}{$smarty.post.address2|escape:'html':'UTF-8'}{else}{if isset($address->address2)}{$address->address2|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
            {if $field_name eq 'postcode'}
                {assign var="postCodeExist" value=true}
                <div class="required postcode form-group unvisible">
                    <label for="postcode">{$hs_translation.zip_postal_code|escape:'html':'UTF-8'} <sup>*</sup></label>
                    <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" id="postcode" name="postcode" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode|escape:'html':'UTF-8'}{else}{if isset($address->postcode)}{$address->postcode|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
            {if $field_name eq 'city'}
                <div class="required form-group">
                    <label for="city">{$hs_translation.city|escape:'html':'UTF-8'} <sup>*</sup></label>
                    <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate|escape:'html':'UTF-8'}" type="text" name="city" id="city" value="{if isset($smarty.post.city)}{$smarty.post.city|escape:'html':'UTF-8'}{else}{if isset($address->city)}{$address->city|escape:'html':'UTF-8'}{/if}{/if}" maxlength="64" />
                </div>
                {* if customer hasn't update his layout address, country has to be verified but it's deprecated *}
            {/if}
            {if $field_name eq 'Country:name' || $field_name eq 'country'}
                <div class="required form-group">
                    <label for="id_country">{$hs_translation.country|escape:'html':'UTF-8'}<sup>*</sup></label>
                    <select id="id_country" class="form-control" name="id_country">{$countries_list|escape:'quotes':'UTF-8'}</select>
                </div>
            {/if}
            {if $field_name eq 'State:name'}
                {assign var="stateExist" value=true}
                <div class="required id_state form-group">
                    <label for="id_state">{$hs_translation.state|escape:'html':'UTF-8'} <sup>*</sup></label>
                    <select name="id_state" id="id_state" class="form-control">
                        <option value="">-</option>
                    </select>
                </div>
            {/if}
            {if $field_name eq 'phone'}
                {assign var="homePhoneExist" value=true}
                <div class="form-group phone-number">
                    <label for="phone">{$hs_translation.home_phone|escape:'html':'UTF-8'}{if isset($one_phone_at_least) && $one_phone_at_least|escape:'html':'UTF-8'} <sup>**</sup>{/if}</label>
                    <input class="{if isset($one_phone_at_least) && $one_phone_at_least|escape:'html':'UTF-8'}is_required{/if} validate form-control" data-validate="{$address_validation.phone.validate|escape:'html':'UTF-8'}" type="tel" id="phone" name="phone" value="{if isset($smarty.post.phone)}{$smarty.post.phone|escape:'html':'UTF-8'}{else}{if isset($address->phone)}{$address->phone|escape:'html':'UTF-8'}{/if}{/if}"  />
                </div>
                {if isset($one_phone_at_least) && $one_phone_at_least}
                    {assign var="atLeastOneExists" value=true}
                    <p class="inline-infos required">** {$hs_translation.you_must_register_at_least_one_phone_number|escape:'html':'UTF-8'}</p>
                {/if}
                <div class="clearfix"></div>
            {/if}
            {if $field_name eq 'phone_mobile'}
                {assign var="mobilePhoneExist" value=true}
                <div class="{if isset($one_phone_at_least) && $one_phone_at_least}required {/if}form-group">
                    <label for="phone_mobile">{$hs_translation.mobile_phone|escape:'html':'UTF-8'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
                    <input class="validate form-control" data-validate="{$address_validation.phone_mobile.validate|escape:'html':'UTF-8'}" type="tel" id="phone_mobile" name="phone_mobile" value="{if isset($smarty.post.phone_mobile)}{$smarty.post.phone_mobile|escape:'html':'UTF-8'}{else}{if isset($address->phone_mobile)}{$address->phone_mobile|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
            {/if}
        {/foreach}
        {if !$postCodeExist}
            <div class="required postcode form-group unvisible">
                <label for="postcode">{$hs_translation.zip_postal_code|escape:'html':'UTF-8'} <sup>*</sup></label>
                <input class="is_required validate form-control" data-validate="{$address_validation.postcode.validate|escape:'html':'UTF-8'}" type="text" id="postcode" name="postcode" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode|escape:'html':'UTF-8'}{else}{if isset($address->postcode)}{$address->postcode|escape:'html':'UTF-8'}{/if}{/if}" />
            </div>
        {/if}
        {if !$stateExist}
            <div class="required id_state form-group unvisible">
                <label for="id_state">{$hs_translation.state|escape:'html':'UTF-8'} <sup>*</sup></label>
                <select name="id_state" id="id_state" class="form-control">
                    <option value="">-</option>
                </select>
            </div>
        {/if}
        {if !$dniExist}
            <div class="required dni form-group unvisible">
                <label for="dni">{$hs_translation.identification_number|escape:'html':'UTF-8'} <sup>*</sup></label>
                <input class="is_required form-control" data-validate="{$address_validation.dni.validate|escape:'html':'UTF-8'}" type="text" name="dni" id="dni" value="{if isset($smarty.post.dni)}{$smarty.post.dni|escape:'html':'UTF-8'}{else}{if isset($address->dni)}{$address->dni|escape:'html':'UTF-8'}{/if}{/if}" />
                <span class="form_info">{$hs_translation.dni_nif_nie|escape:'html':'UTF-8'}</span>
            </div>
        {/if}
        <div class="form-group">
            <label for="other">{$hs_translation.additional_information|escape:'html':'UTF-8'}</label>
            <textarea class="validate form-control" data-validate="{$address_validation.other.validate|escape:'html':'UTF-8'}" id="other" name="other" cols="26" rows="3" >{if isset($smarty.post.other)}{$smarty.post.other|escape:'html':'UTF-8'}{else}{if isset($address->other)}{$address->other|escape:'html':'UTF-8'}{/if}{/if}</textarea>
        </div>
        {if !$homePhoneExist}
            <div class="form-group phone-number">
                <label for="phone">{$hs_translation.home_phone|escape:'html':'UTF-8'}</label>
                <input class="{if isset($one_phone_at_least) && $one_phone_at_least}is_required{/if} validate form-control" data-validate="{$address_validation.phone.validate|escape:'html':'UTF-8'}" type="tel" id="phone" name="phone" value="{if isset($smarty.post.phone)}{$smarty.post.phone|escape:'html':'UTF-8'}{else}{if isset($address->phone)}{$address->phone|escape:'html':'UTF-8'}{/if}{/if}"  />
            </div>
        {/if}
        {if isset($one_phone_at_least) && $one_phone_at_least && !$atLeastOneExists }
            <p class="inline-infos required">{$hs_translation.you_must_register_at_least_one_phone_number|escape:'html':'UTF-8'}</p>
        {/if}
        <div class="clearfix"></div>
        {if !$mobilePhoneExist}
            <div class="{if isset($one_phone_at_least) && $one_phone_at_least}required {/if}form-group">
                <label for="phone_mobile">{$hs_translation.mobile_phone|escape:'html':'UTF-8'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
                <input class="validate form-control" data-validate="{$address_validation.phone_mobile.validate|escape:'html':'UTF-8'}" type="tel" id="phone_mobile" name="phone_mobile" value="{if isset($smarty.post.phone_mobile)}{$smarty.post.phone_mobile|escape:'html':'UTF-8'}{else}{if isset($address->phone_mobile)}{$address->phone_mobile|escape:'html':'UTF-8'}{/if}{/if}" />
            </div>
        {/if}
        <div class="required form-group" id="adress_alias">
            <label for="alias">{$hs_translation.please_assign_an_address_title_for_future_reference|escape:'html':'UTF-8'} <sup>*</sup></label>
            <input type="text" id="alias" class="is_required validate form-control" data-validate="{$address_validation.alias.validate|escape:'html':'UTF-8'}" name="alias" value="{if isset($smarty.post.alias)}{$smarty.post.alias|escape:'html':'UTF-8'}{else if isset($address->alias)}{$address->alias|escape:'html':'UTF-8'}{elseif !$select_address}{$hs_translation.my_address|escape:'html':'UTF-8'}{/if}" />
        </div>
        <p class="submit2">
            {if isset($id_address)}<input type="hidden" name="id_address" value="{$id_address|escape:'html':'UTF-8'}" />{/if}
            {if isset($back)}<input type="hidden" name="back" value="{$back|escape:'html':'UTF-8'}" />{/if}
            {if isset($mod)}<input type="hidden" name="mod" value="{$mod|escape:'html':'UTF-8'}" />{/if}
            {if isset($select_address)}<input type="hidden" name="select_address" value="{$select_address|escape:'html':'UTF-8'}" />{/if}
            <input type="hidden" name="token" value="{$token|escape:'html':'UTF-8'}" />
            <button type="submit" name="submitAddress" id="submitAddress" class="btn btn-default button button-medium">
                <span>
                    {$hs_translation.finished|escape:'html':'UTF-8'}
                    <i class="icon-chevron-right right"></i>
                </span>
            </button>
        </p>
    </form>
</div>
{strip}
    {if isset($smarty.post.id_state) && $smarty.post.id_state}
        {addJsDef idSelectedState=$smarty.post.id_state|intval}
    {else if isset($address->id_state) && $address->id_state}
        {addJsDef idSelectedState=$address->id_state|intval}
    {else}
        {addJsDef idSelectedState=false}
    {/if}
    {if isset($smarty.post.id_country) && $smarty.post.id_country}
        {addJsDef idSelectedCountry=$smarty.post.id_country|intval}
    {else if isset($address->id_country) && $address->id_country}
        {addJsDef idSelectedCountry=$address->id_country|intval}
    {else}
        {addJsDef idSelectedCountry=false}
    {/if}
    {if isset($countries)}
        {addJsDef countries=$countries}
    {/if}
    {if isset($vatnumber_ajax_call) && $vatnumber_ajax_call}
        {addJsDef vatnumber_ajax_call=$vatnumber_ajax_call}
    {/if}
{/strip}