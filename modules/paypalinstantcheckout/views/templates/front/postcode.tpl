{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}
<style>
    body{
        margin: 50px auto;
    }
    .form-error input{
        border: 1px solid #ff0000;
    }
    .form-group{
        margin: 10px 0;
    }
    .form-group select, .form-group input{
        padding: 8px;
        width: 230px;
    }
    .form-group select option{
        padding: 3px;
    }
    #submit{
        width: 70px;
        cursor: pointer;
    }
    .form-group label{
        width: 39%;
        float: left;
        text-align: right;
        padding-right: 1%;
        margin-top: 8px;
    }
    .col-lg-1{
        width: 60%;
        float: left;
        text-align: left;
    }
    .clearfix:before, .clearfix:after {
        content: " ";
        display: table;
    }
    .clearfix:after {
        clear: both;
    }
</style>
{if $js_include}
    {foreach from=$js_files item=js_uri}
        <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
    {/foreach}
{/if}

<form action="{$url_submit_form|escape:'quotes':'UTF-8'}" method="post">
    <div class="box">
        <div class="form-group clearfix">
            <label for="id_country">{$translate_country|escape:'html':'UTF-8'}</label>
            <div class="col-lg-1">
                <select id="id_country" class="" name="id_country">
                    {foreach from=$countries item='country'}
                        <option value="{$country.id_country|escape:'html':'UTF-8'}" {if $country.id_country == $id_default_country}selected='selected'{/if}>{$country.name|escape:'htmlall':'UTF-8'}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group clearfix states">
            <label for="id_state">{$translate_state|escape:'html':'UTF-8'}</label>
            <div class="col-lg-1">
                <select name="id_state" id="id_state" class="">
                    <option value="">-</option>
                </select>
            </div>
        </div>

        <div class="form-group clearfix">
            <label for="postcode">{$translate_postcode|escape:'html':'UTF-8'}</label>
            <div class="postcode col-lg-1">
                <input class="is_required validate" placeholder="{$enter_your_postcode|escape:'html':'UTF-8'}" data-validate="isPostCode" type="text" id="postcode" name="postcode" value="" />
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="postcode">&nbsp;</label>
            <div class="col-lg-1">
                <input id="submit" type="submit" name="submitPostCode" value="{$translate_submit|escape:'html':'UTF-8'}">
            </div>
        </div>

    </div>
</form>
<script type='text/javascript'>

    ajaxUrl = '{$url_ajax|escape:'quotes':'UTF-8'}';
    id_default_country = {$id_default_country|escape:'htmlall':'UTF-8'}
    countriesNeedZipCode = {};
    countries ={$countries_json|escape:'quotes':'UTF-8'}
    var invalidPostcode = '{$invalid_postcode|escape:'htmlall':'UTF-8'}';
    {if isset($countries)}
        {foreach from=$countries item='country'}
                {if isset($country.need_zip_code)}
    countriesNeedZipCode[{$country.id_country|escape:'html':'UTF-8'}] = '{$country.zip_code_format|escape:'html':'UTF-8'}';
            {/if}
        {/foreach}
    {/if}

    $(document).ready(function () {

        getStateByIdCountry(id_default_country);

        $('#id_country').change(function () {
            var id_country = parseInt($(this).val());
            getStateByIdCountry(id_country);
            enableButtonSubmit();
            $('#submit').attr('disabled', 'disabled');
        });
        $('#postcode').val('');
        if (!$('#postcode').val())
            $('#submit').attr('disabled', 'disabled');
        $(document).on('blur', '#postcode', function () {
            enableButtonSubmit();
        });

    });

    /**
     * Turn on|of button submit form
     */
    function enableButtonSubmit()
    {
        if ($('.postcode').hasClass('form-error'))
        {
            $('#submit').attr('disabled', 'disabled');
            alert(invalidPostcode);
        }
        else
            $('#submit').removeAttr('disabled');
    }

    function getStateByIdCountry(id_country)
    {
        $('#postcode').val('');
        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: {
                ajax: true,
                id_country: id_country
            },
            dataType: 'json',
            beforeSend: function ()
            {
                $('#id_state').parents('.states').hide();
                $('#id_state').html('');
            },
            success: function (json) {

                if (json.length > 0)
                {
                    $.each(json, function (index, state)
                    {
                        $('#id_state').append('<option value=\'' + state.id_state + '\'>' + state.name + '</option>');
                        $('#id_state').parents('.states').fadeIn();
                    });
                }
                else
                    $('#id_state').parents('.states').fadeOut();


            }
        });
    }
</script>
