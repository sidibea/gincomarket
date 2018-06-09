/**
 * Paypal instant checkout for PrestaShop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * It's helpful for auto search customer
 * @param {ajaxUrl} url of controller
 * @returns {SearchCustomer}
 */
var SearchCustomer = function (ajaxUrl)
{

    /**
     * Target AjaxUrl is all ajax url request
     */
    this.ajaxUrl = typeof ajaxUrl !== 'undefined' ? ajaxUrl : null;

    /**
     * default address of customer
     */
    this.defaultIdAddress = 0;

    /**
     * Define array selectors
     */
    this._selectors = {
        inputSearchCustomer: 'form input[name="PAYPAL_DEFAULT_CUSTOMER"]', // defined tex box search customer
        dropdownAddress: 'form select[name="PAYPAL_DEFAULT_ADDRESS"]', //  dropdown of list address
        paypalAddress: '.paypal-address', //  class default address
        customerInfo: '.customer_info',
        viewCustomer: '.view_customer',
    };

    /**
     * Declare all actions
     */
    this.actions = {
        searchCustomers: 'searchCustomers', // request search customer
        getAddresses: 'getAddresses', //  request get address of customer
        
    };

    this._jqXHR = null,
            SearchCustomer.instance = this;

    /**
     * Process auto complete customer
     */
    this.autoCompleteProductSearch = function ()
    {
        if (typeof SearchCustomer.instance.ajaxUrl === 'undefined')
            return false;

        $(SearchCustomer.instance._selectors.inputSearchCustomer).autocomplete({
            minLength: 1,
            source: function (request, response) {

                if (SearchCustomer.instance._jqXHR !== null) {
                    SearchCustomer.instance._jqXHR.abort();
                }

                SearchCustomer.instance._jqXHR = $.ajax({
                    url: SearchCustomer.instance.ajaxUrl,
                    data: {
                        key_search: request.term,
                        ajax: true,
                        action: SearchCustomer.instance.actions.searchCustomers
                    },
                    dataType: "json",
                    success: function (jsonData) {
                        if (jsonData.found)
                        {
                            response($.map(jsonData.customers, function (item)
                            {
                                lable = item.firstname + ' ' + item.lastname;
                                lable += " " + "(" + item.email + ")";

                                return {
                                    label: lable,
                                    link:item.link,
                                    idCustomer: item.id_customer
                                };

                            }));
                        }
                        SearchCustomer.instance._jqXHR = null;
                    },
                    error: function () {
                    }
                });
            },
            select: function (event, ui)
            {
                if (typeof (ui) !== 'undefined')
                {
                    $(SearchCustomer.instance._selectors.inputSearchCustomer).val('');
                    $(SearchCustomer.instance._selectors.customerInfo).html(ui.item.label);
                    $(SearchCustomer.instance._selectors.viewCustomer).attr('href', ui.item.link);
                    SearchCustomer.instance.getAddresses(ui.item.idCustomer);
                }

                return false;
            }
        });
    };

    this.getAddresses = function (idCustomer)
    {
        if (typeof SearchCustomer.instance.ajaxUrl === 'undefined')
            return false;

        $.ajax({
            url: SearchCustomer.instance.ajaxUrl,
            data: {
                id_customer: idCustomer,
                ajax: true,
                action: SearchCustomer.instance.actions.getAddresses
            },
            dataType: "json",
            success: function (jsonData)
            {
                if (jsonData.found)
                {
                    var address = '';
                    $.each(jsonData.addresses, function () {
                        address += '<option value="' + this.id_address + '" ' + (parseInt(this.id_address) === parseInt(SearchCustomer.instance.defaultIdAddress) ? 'selected="selected"' : '') + '>' + this.alias + '</option>';
                    });
                    $(SearchCustomer.instance._selectors.dropdownAddress).html(address);
                    $(SearchCustomer.instance._selectors.paypalAddress).show();
                }
                else
                    $(SearchCustomer.instance._selectors.paypalAddress).css('display', 'none');
            }


        });
    };

    /**
     * Set default id address delivery of customer
     * @param {int} defaultIdAddress
     */
    this.setDefaultIdAddress = function (defaultIdAddress)
    {
        if (typeof defaultIdAddress !== 'undefined' && parseInt(defaultIdAddress) > 0)
            this.defaultIdAddress = defaultIdAddress;
    };

};
