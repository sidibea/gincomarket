/**
 * Paypal instant checkout for PrestaShop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

var PaypalAdminSettings = function (showOptionConvertCurrency)
{
    this._showOptionConvertCurrency = typeof showOptionConvertCurrency !== 'undefined' ? showOptionConvertCurrency : 0;
    /**
     * Define array selectors
     */
    this._selectors = {
        viewCarrier: '.view_carrier',
        viewAddress: '.view_address',
        defaultAddress: '.default_address',
        defaultCarrier: '.default_carrier',
        inputPaypalFee: 'input[name="HS_PAYPAL_FEE"]',
        inputCustomRate: 'input[name="HS_PAYPAL_CUSTOM_RATE"]',
        inputCustomFixedFee: 'input[name="HS_PAYPAL_CUSTOM_FIXED_FEE"]',
        blockPaypalFee: '#conf_id_HS_PAYPAL_STANDARD_RATE',
        blockCustomRate: '#conf_id_HS_PAYPAL_CUSTOM_RATE',
        blockCustomFixedFee: '#conf_id_HS_PAYPAL_CUSTOM_FIXED_FEE',
        blockConvertCurrency: '#conf_id_PAYPAL_CONVERT_CURRENCY',
        inputConvertCurrency: 'input[name="PAYPAL_CONVERT_CURRENCY"]',
        paypalFee: '.paypal_fee',
        customFee: '.custom_fee',
        standardRate: '#HS_PAYPAL_STANDARD_RATE',
        newLangFlag: '.new-lang-flag'
    };

    PaypalAdminSettings.instance = this;

    /**
     * Event load default
     */
    this.onLoad = function () {
        PaypalAdminSettings.instance.showBlockConvertCurrency();
        var paypalFee = $(PaypalAdminSettings.instance._selectors.inputPaypalFee + ":checked").val();
        PaypalAdminSettings.instance.showBlockPaypalFee(paypalFee);
        $(document).on("click", PaypalAdminSettings.instance._selectors.inputPaypalFee + ":checked", function () {
            PaypalAdminSettings.instance.showBlockPaypalFee($(this).val());
        });
        $(document).on("click", PaypalAdminSettings.instance._selectors.viewCarrier, function (e) {
            e.preventDefault();
            var urlCarrier = $(this).attr("rel");
            var idCarrier = $(PaypalAdminSettings.instance._selectors.defaultCarrier + " option:selected").val();
            if (urlCarrier && idCarrier) {
                window.open(urlCarrier + idCarrier, "_blank");
            }
        });
        $(document).on("click", PaypalAdminSettings.instance._selectors.viewAddress, function (e) {
            e.preventDefault();
            var urlAddress = $(this).attr("rel");
            var idAddress = $(PaypalAdminSettings.instance._selectors.defaultAddress + " option:selected").val();
            console.log(urlAddress);
            console.log(urlAddress);
            if (urlAddress && idAddress) {
                window.open(urlAddress + idAddress, "_blank");
            }
        });
        $(document).on("change", PaypalAdminSettings.instance._selectors.standardRate, function () {
            PaypalAdminSettings.instance.showBlockCustomFee($(this).val());
        });
        $(document).on("keyup", PaypalAdminSettings.instance._selectors.inputCustomRate, function () {
            if (!$.isNumeric($(this).val())) {
                $(this).val($(this).val().substr(0, $(this).val().length - 1));
            }
        });
        $(document).on("keyup", PaypalAdminSettings.instance._selectors.inputCustomFixedFee, function () {
            if (!$.isNumeric($(this).val())) {
                $(this).val($(this).val().substr(0, $(this).val().length - 1));
            }
        });
        // set language for new item
        $(PaypalAdminSettings.instance._selectors.newLangFlag).on("click", function () {
            var lang_id = (this.id).substr(5);
            $(PaypalAdminSettings.instance._selectors.newLangFlag).each(function () {
                $(this).removeClass("active");
            });
            $(this).addClass("active");
            $("#lang-id").val(lang_id);
        });
    };

    /**
     * Show or hide block convert currency
     */
    this.showBlockConvertCurrency = function(){
        var divCovertCurrency = window.isPrestaShop16 ? $(PaypalAdminSettings.instance._selectors.blockConvertCurrency).parent() : $(PaypalAdminSettings.instance._selectors.blockConvertCurrency);
        if (PaypalAdminSettings.instance._showOptionConvertCurrency) {
            divCovertCurrency.removeClass('hide disable');
            $(PaypalAdminSettings.instance._selectors.inputConvertCurrency).removeAttr('disabled');
        } else {
            divCovertCurrency.addClass('hide disable');
            $(PaypalAdminSettings.instance._selectors.inputConvertCurrency).attr('disabled', 'disabled');
        }
    }
    
    /**
     * @param {boolean} isShow
     */
    this.showBlockPaypalFee = function (isShow)
    {
        var blockPaypalFee = $(this._selectors.blockPaypalFee);
        var blockCustomRate = $(this._selectors.blockCustomRate);
        var blockCustomFixedFee = $(this._selectors.blockCustomFixedFee);
        if (blockPaypalFee.parent().hasClass('form-group')) {
            blockPaypalFee = blockPaypalFee.parent();
        }
        if (blockCustomRate.parent().hasClass('form-group')) {
            blockCustomRate = blockCustomRate.parent();
        }
        if (blockCustomRate.parent().hasClass('form-group')) {
            blockCustomFixedFee = blockCustomFixedFee.parent();
        }
        
        if (isShow == 1) {
            blockPaypalFee.show();
            PaypalAdminSettings.instance.showBlockCustomFee($(PaypalAdminSettings.instance._selectors.standardRate).val());
        } else {
            blockPaypalFee.hide();
            blockCustomRate.hide();
            blockCustomFixedFee.hide();
        }
    };

    /**
     * @param {string} customFeeType
     */
    this.showBlockCustomFee = function (customFeeType)
    {
        var blockCustomRate = $(this._selectors.blockCustomRate);
        var blockCustomFixedFee = $(this._selectors.blockCustomFixedFee);
        if (blockCustomRate.parent().hasClass('form-group')) {
            blockCustomRate = blockCustomRate.parent();
        }
        if (blockCustomRate.parent().hasClass('form-group')) {
            blockCustomFixedFee = blockCustomFixedFee.parent();
        }
        if (customFeeType === "HS_PAYPAL_CUSTOM") {
            blockCustomRate.show();
            blockCustomFixedFee.show();
        } else {
            blockCustomRate.hide();
            blockCustomFixedFee.hide();
        }
    };

};
