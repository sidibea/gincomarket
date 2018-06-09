{*
 * Paypal instant checkout for PrestaShop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<script type="text/javascript">

    isPrestashop17 = {$is_prestashop17|intval};
    isPrestashop16 = 0;
    isOneStepCheckOut = {$is_one_step_check_out|escape:'html':'UTF-8'};
    buttonPositions = {$button_positions nofilter};
    paypalInstantCheckoutOptionPayment = {$paypal_instant_checkout_payment|escape:'quotes':'UTF-8'};
    {* new code for 1.7*}
    {* for block shipping cart*}
    payPalActionUrl = '{$paypal_action nofilter}';
    shoppingCartImageUrl = '{$paypal_image nofilter}';
    shoppingCartTitleButton = '{$paypal_labels.PAYPAL_TEXT_ADDING_TO_CART|escape:'html':'UTF-8'}';
    shoppingCartClassCssButton = '{$paypal_class_css|escape:'html':'UTF-8'}';
    shoppingCartPaypalLable = '{$paypal_labels.PAYPAL_TEXT_ADDING_TO_CART|escape:'html':'UTF-8'}';
    shoppingCartPaypalButtonImage = '{if !empty($button_images.PAYPAL_IMAGE_ADDING_TO_CART)}{$img_ps_dir|escape:'quotes':'UTF-8'}{$button_images.PAYPAL_IMAGE_ADDING_TO_CART|escape:'html':'UTF-8'}{/if}';
    {* for block header cart*}
    headerCartImageUrl = '{$paypal_image_header|escape:'quotes':'UTF-8'}';
    headerCartTitleButton = '{$paypal_labels.PAYPAL_TEXT_BLOCK_CART|escape:'html':'UTF-8'}';
    headerCartPaypalLable = '{$paypal_labels.PAYPAL_TEXT_BLOCK_CART|escape:'html':'UTF-8'}';
    headerCartButtonImage = '{if !empty($button_images.PAYPAL_IMAGE_BLOCK_CART)}{$img_ps_dir|escape:'quotes':'UTF-8'}{$button_images.PAYPAL_IMAGE_BLOCK_CART|escape:'html':'UTF-8'}{/if}';
    {* for block checkout page*}
    checkOutPageImageUrl = '{$paypal_image|escape:'quotes':'UTF-8'}';
    checkOutPageTitleButton = '{$paypal_labels.PAYPAL_TEXT_CHECKOUT_PAGE|escape:'html':'UTF-8'}';
    checkOutPagePaypalLable = '{$paypal_labels.PAYPAL_TEXT_CHECKOUT_PAGE|escape:'html':'UTF-8'}';
    checkOutPageButtonImage = '{if !empty($button_images.PAYPAL_IMAGE_CHECKOUT_PAGE)}{$img_ps_dir|escape:'quotes':'UTF-8'}{$button_images.PAYPAL_IMAGE_CHECKOUT_PAGE|escape:'html':'UTF-8'}{/if}';
    {* Text translate*}
    hsTranslationOr = '{$hs_translation['or']|escape:'html':'UTF-8'}';
    
    listButtonPaypalUrlAjax = '{$url_ajax nofilter}';
    listButtonPaypalDisplayPostcodeForm = '{$display_postcode_form|intval}';
    listButtonPaypalStPaypalInstant = '{$st_paypalinstant nofilter}';
    listButtonPaypalButtonListProductPage = '{$is_paypal_instant_button_list}';
</script>