/**
 * Paypal instant checkout for PrestaShop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * It's helpful for rendering Paypal button
 * @param {json} options
 * @returns {GuestAsCustomer}
 */
var GuestAsCustomer = function (guestAsCustomer, psGuestCheckoutEnabled)
{
    /**
     * Enable guest as customer or not
     * @var string
     */
    this._isEnbleGuestAsCustomer = typeof guestAsCustomer !== 'undefined' ? guestAsCustomer : false;
    this._psGuestCheckoutEnabled = typeof psGuestCheckoutEnabled !== 'undefined' ? psGuestCheckoutEnabled : 0;


    /**
     * Define array selectors
     */
    this._selectors = {
        inputGuestAsCustomer: 'form input[name="PAYPAL_GUEST_AS_CUSTOMER"]', // defined input guest as customer
        blockGuestAsCustomer: '#conf_id_PAYPAL_GUEST_AS_CUSTOMER',
        classConfirmAddress: '#conf_id_PAYPAL_CONFIRM_ADDRESS' // defined class confirm address
    };

    GuestAsCustomer.instance = this;

    /**
     * Event load default
     */
    this.onLoad = function () {
        
        GuestAsCustomer.instance._isEnbleGuestAsCustomer = parseInt($(GuestAsCustomer.instance._selectors.inputGuestAsCustomer + ":checked").val());
        this._displayCofirmAddress();
        // event click button quote in home page or category page
        $(document).on('click', this._selectors.inputGuestAsCustomer, function ()
        {
            GuestAsCustomer.instance._isEnbleGuestAsCustomer = parseInt($(this).val());
            GuestAsCustomer.instance._displayCofirmAddress();
        });
        // show | hide option guest as customer
        if (!GuestAsCustomer.instance._psGuestCheckoutEnabled) {
            if(parseInt(window.isPrestashop16) === 1) {
                $(GuestAsCustomer.instance._selectors.blockGuestAsCustomer).parent().addClass('hide disable');
            } else {
                $(GuestAsCustomer.instance._selectors.blockGuestAsCustomer).addClass('hide disable');
            }
        }
    };

    /**
     * Displaying confirm address
     */
    this._displayCofirmAddress = function ()
    {
        if (GuestAsCustomer.instance._isEnbleGuestAsCustomer && !isPrestashop17)
            $(this._selectors.classConfirmAddress).parent().show();
        else
            $(this._selectors.classConfirmAddress).parent().hide();

    };

};
