{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<script type="text/javascript">
    $(document).ready(function (){
        var guestAsCustomer = new GuestAsCustomer({$pp_guest_as_customer|intval}, {$ps_guest_checkout_enabled|intval});
        var isPrestashop16 = {$is_prestashop_16|intval};
        isPrestashop17 = {$is_prestashop_17|intval};
        guestAsCustomer.onLoad();
        var paypalAdminSettings = new PaypalAdminSettings({$show_option_convert_currency|intval});
        paypalAdminSettings.onLoad();
        var searchCustomer = new SearchCustomer("{$customer_searching_url|escape:'quotes':'UTF-8'}");
        searchCustomer.setDefaultIdAddress({$default_address|intval});
        searchCustomer.autoCompleteProductSearch();
    });
</script>
