/**
 * Paypal instant checkout for PrestaShop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * handle envent
 * @param {json} options
 * @returns {PaypalInstantListButtonController}
 */

var PaypalInstantListButtonController = function (options)
{
    /**
     * syn url with current location protocol
     * @param url string
     * @returns string
     */
    this.synUrl = function (url)
    {
        var synUrl = '';
        if (typeof url !== 'undefined')
            synUrl = url.indexOf('https:') > -1 ? url.replace("https:", document.location.protocol) : url.replace("http:", document.location.protocol);
        return synUrl;
    };

    /**
     * url action direct to module
     */
    this._ajaxUrl = typeof options.ajaxUrl !== 'undefined' ? this.synUrl(options.ajaxUrl) : null;

    /**
     * assign translate message
     */
    this._stPaypalInstant = typeof options.stPaypalInstant !== 'undefined' ? options.stPaypalInstant : null;

    /**
     * set show list button on list product page
     */
    this._isPaypalInstantButtonListProductPage = typeof options.isPaypalInstantButtonListProductPage !== 'undefined' ? options.isPaypalInstantButtonListProductPage : null;
    this._displayPostcodeForm = typeof options.displayPostcodeForm !== 'undefined' ? options.displayPostcodeForm : 0;

    /**
     * Define array actions
     */
    this._actions = {
        AddProductToPaypalInstant: 'AddProductToPaypalInstant'
    };

    /**
     * Define array selectors
     */
    this._selectors = {
        idProduct: '#product_page_product_id', // id input hidden contain id product
        classAjaxBlockProduct: '.ajax_block_product', // define block product
        ajaxAddToCartButton: '.ajax_add_to_cart_button', // define class add to cart
        ajaxAddToPaypalInstantListButton: '.ajax_add_to_paypalinstant_list_button', // define class add product to quote
        footer: '#footer', // define id to add hidden payment form
        quoteButton: '.ajax_add_to_quote_button' //define check is enable quote button
    };

    /**
     * instance of PaypalInstantButton
     */
    this.paypalinstantlistbutton = {};

    PaypalInstantListButtonController.instance = this;

    /**
     * Event load default
     */
    this.onLoad = function () {
        if (this._isPaypalInstantButtonListProductPage === 1)
            this._initPaypalInstantListButtons();

        // event click list button in home page or category page
        $(document).on('click', this._selectors.ajaxAddToPaypalInstantListButton, function (e)
        {
            e.preventDefault();
            PaypalInstantListButtonController.instance.onAddToPaypalInstant(this);
        });
    };

    /**
     * Add product to Paypal Instant in page list product
     * @param {jQuery} PaypalInstantListButton
     */
    this.onAddToPaypalInstant = function (PaypalInstantListButton)
    {
        var idPaypalInstantListButton = this._getIdPaypalInstantListButton(PaypalInstantListButton);
        var paypalInstantListButton = this._getPaypalInstantListButtonById(idPaypalInstantListButton);
        if (typeof paypalInstantListButton === 'object')
        {
            var jsonData = paypalInstantListButton.add();
            if (jsonData.success) {
                if (this._displayPostcodeForm) {
                    window.location.href = jsonData.urlPostcodePage;
                } else {
                    PaypalInstantListButtonController.instance._updateBlockPaypalInstant(jsonData.contentBlock);
                }
            } else {
                alert(PaypalInstantListButtonController.instance._stPaypalInstant.error);
            }
        }
    };

    /**
     * Get id of PaypalInstantListButton
     * @param {jQuery} PaypalInstantListButton
     * @returns {String}
     */
    this._getIdPaypalInstantListButton = function (PaypalInstantListButton) {

        var idPaypalInstantListButton = '';
        if ($(PaypalInstantListButton).data('id'))
            idPaypalInstantListButton = $(PaypalInstantListButton).data('id');
        return idPaypalInstantListButton;
    };

    /**
     * Get PaypalInstantListButton by id
     * @param {string} idPaypalInstantListButton
     * @returns {Boolean|PaypalInstantListButton}
     */
    this._getPaypalInstantListButtonById = function (idPaypalInstantListButton) {

        if (this.paypalinstantlistbutton[idPaypalInstantListButton])
            return this.paypalinstantlistbutton[idPaypalInstantListButton];
        else
            return false;
    };

    /**
     * Set PaypalInstantListButton to attribute
     * @param {jQuery} PaypalInstantListButton
     */
    this._setPaypalInstantListButton = function (PaypalInstantListButton) {

        if (typeof PaypalInstantListButton === 'object')
            this.paypalinstantlistbutton[PaypalInstantListButton.getId()] = PaypalInstantListButton;

    };

    /**
     * Loop all list products
     */
    this._initPaypalInstantListButtons = function () {

        $(this._selectors.classAjaxBlockProduct).each(function () {

            var links = $(this).find('a');
            var idProduct = 0;

            for (var i = 0; i < links.length; i++)
            {
                var href = decodeURIComponent($(links[i]).attr('href'));
                if (href.indexOf('id_product') > 0)
                {
                    i = links.length;
                    idProduct = href.substring(href.indexOf('id_product') + 11, href.length);
                }
            }
            if (isNaN(idProduct) && idProduct.indexOf('&') > 0)
                idProduct = idProduct.substring(0, idProduct.indexOf('&'));

            if (parseInt(idProduct) > 0)
                $(this).find(PaypalInstantListButtonController.instance._selectors.ajaxAddToCartButton).parent().append($(PaypalInstantListButtonController.instance._initPaypalInstantListButton(idProduct)));
        });
    };

    /**
     * Get all values of block products
     * @param {int} idProduct
     * @returns {html}
     */
    this._initPaypalInstantListButton = function (idProduct) {
        var paypalInstantListButton = new PaypalInstantListButton(this._stPaypalInstant);
        paypalInstantListButton.setIdProduct(idProduct);
        paypalInstantListButton.setAjaxUrl(this._ajaxUrl);
        paypalInstantListButton.setAction(this._actions.AddProductToPaypalInstant);
        this._setPaypalInstantListButton(paypalInstantListButton);
        return paypalInstantListButton.render();
    };

    /**
     * Update payment form
     * @param {html} contentBlock
     */
    this._updateBlockPaypalInstant = function (contentBlock) {
        window.parent.$(PaypalInstantListButtonController.instance._selectors.footer).html(contentBlock);
    };
};

/**
 * handle event
 * @param {json} name
 * @returns {PaypalInstantListButton}
 */
var PaypalInstantListButton = function (name)
{
    /**
     * url action direct to module
     */
    this.ajaxUrl;

    /**
     * id random of PaypalInstantListButton
     */
    this.id;

    /**
     * id of each product
     */
    this.idProduct;

    /**
     * id attribute of each product
     */
    this.idProductAttribute;

    /**
     * Action request to server
     */
    this.action;

    /**
     * Text multi language of elements html
     */
    this.name = {};

    $.extend(this.name, name);

    /**
     * Render a button list of a product
     */
    this.render = function ()
    {
        return '<a data-id=\'' + this.id + '\' href="javascript:void(0);" title=\'' + this.name.title + '\' class=\'ajax_add_to_paypalinstant_list_button btn btn-default\'>' + this.name.text + '</a>';
    };

    /**
     * Add button to each product
     */
    this.add = function ()
    {
        if (!this.getAction() || !this.getAjaxUrl() || !this.getIdProduct())
            return;
        var jsonData;
        $.ajax({
            url: this.getAjaxUrl(),
            dataType: 'json',
            async: false,
            data: {
                id_product: this.getIdProduct(),
                id_product_attribute: this.getIdProductAttribute(),
                action: this.getAction(),
                ajax: true
            },
            type: 'POST',
            success: function (data)
            {
                jsonData = data;
            },
            error: function () {
                alert(PaypalinstantListButtonController.instance._stPaypalInstant.error);
            }
        });
        return jsonData;
    };

    /**
     * Set random id PaypalInstantListButton
     * @param {int} id
     */
    this.setId = function (id)
    {
        if (typeof id !== 'undefined')
            this.id = id;
    };

    /**
     * Get random id PaypalInstantListButton
     */
    this.getId = function ()
    {
        if (typeof this.id === 'undefined')
            this.setId(this._getRandomId());
        return this.id;
    };

    /**
     * Render random id PaypalInstantListButton
     * @returns {string}
     */
    this._getRandomId = function ()
    {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZ";
        var stringLength = 32;
        var randomId = [], randomNumber;

        while (stringLength--)
        {
            randomNumber = Math.floor(Math.random() * chars.length);
            randomId.push(chars.substr(randomNumber, 1));
        }
        return randomId.join('');
    };

    /**
     * Set id product to PaypalInstantListButton
     * @param {int} idProduct
     */
    this.setIdProduct = function (idProduct)
    {
        if (typeof idProduct !== 'undefined')
            this.idProduct = parseInt(idProduct);

    };

    /**
     * Get id product of PaypalInstantListButton
     */
    this.getIdProduct = function ()
    {
        return this.idProduct;
    };

    /**
     * Get ajax url of PayppalInstantListButton
     */
    this.getAjaxUrl = function ()
    {
        return this.ajaxUrl;
    };

    /**
     * Set ajax url of PaypalInstantListButton
     * @param {string} ajaxUrl
     */
    this.setAjaxUrl = function (ajaxUrl)
    {
        if (typeof ajaxUrl !== 'undefined')
            this.ajaxUrl = this.synUrl(ajaxUrl);
    };

    /**
     * Set id attribute of product
     * @param {int} idProductAttribute
     */
    this.setIdProductAttribute = function (idProductAttribute)
    {
        if (typeof idProductAttribute !== 'undefined')
            this.idProductAttribute = idProductAttribute;
    };

    /**
     * Get id attribute of product
     */
    this.getIdProductAttribute = function ()
    {
        return this.idProductAttribute;
    };

    /**
     * Set action of product
     * @param {string} action
     */
    this.setAction = function (action)
    {
        if (typeof action !== 'undefined')
            this.action = action;
    };

    /**
     * Get action of product
     */
    this.getAction = function ()
    {
        return this.action;
    };

    /**
     * syn url with current location protocol
     * @param url string
     * @returns string
     */
    this.synUrl = function (url)
    {
        var synUrl = '';
        if (typeof url !== 'undefined')
            synUrl = url.indexOf('https:') > -1 ? url.replace("https:", document.location.protocol) : url.replace("http:", document.location.protocol);
        return synUrl;
    }
};


/**
 * It's helpful for rendering Paypal in block payment
 * @returns {PaypalMethod}
 */
var PaypalInstantCheckoutPayment = function ()
{

    /**
     * Contain content paypal payment
     * @var string
     */
    this.html = null;

    /**
     * Remove warning in block payment method
     */
    this.removeWarning = 0;

    /**
     * Define block show paypal method
     * TOP_PAYMENT > show in block top payment
     * PAYMENT > show in block payment
     */
    this.position = 'TOP_PAYMENT';


    /**
     * Define array selectors
     */
    this._selectors = {
        hookTopPayment: '#HOOK_TOP_PAYMENT', //define id div containt contents hook top payment
        hookPayment: '#HOOK_PAYMENT', // define id div contain contents hook payment
        warning: '#HOOK_PAYMENT .warning' // define class warning of block HOOK_PAYMENT
    };

    PaypalInstantCheckoutPayment.instance = this;

    /**
     * Set paypal content 
     * @param {object} html
     */
    this.setHtml = function (html) {

        if (html !== 'undefined' && typeof html === 'object')
            this.html = html;
    };

    /**
     * Event load default
     */
    this.onLoad = function () {

        this._display();
    };

    /**
     * Display paypal method to block payment method  
     */
    this._display = function ()
    {
        if (this.html)
        {
            if (this.position === 'TOP_PAYMENT')
                $(this._selectors.hookTopPayment).append(this.html.html);
            else
                $(this._selectors.hookPayment).prepend(this.html.html);

            if (this.removeWarning)
                $(this._selectors.warning).remove();
        }
    };

};

/**
 * Paypal instant checkout for PrestaShop
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * It's helpful for rendering Paypal button
 * @returns {PaypalInstantCheckoutButton}
 */
var PaypalInstantCheckoutButton = function ()
{
    this.selectors = {
        colorPick: '.color_pick',
        attributeSelect: '.attribute_select',
        attributeRadio: '.attribute_radio',
        radioInputCheckedClass: '#attributes .checked > input[type=radio]',
        radioInputChecked: '#attributes input[type=radio]:checked',
        selectElements: '#attributes select',
        inputElements: '#attributes input[type=hidden]',
        paypalCheckoutButton: '.pp-checkout-btn'
    };

    /**
     * Url action direct to module
     * @var string
     */
    this._actionUrl = null;

    /**
     * Link image
     * @var string
     */
    this._imageUrl = null;

    /**
     * Title button
     * @var string
     */
    this._titleButton = null;

    /**
     * Text translation of button Paypal
     * @var string
     */
    this._texTranslationButtonPayPal = null;

    /**
     * Class css of button Paypal
     * @var string
     */
    this._classCssButton = null;

    /**
     * Text option checkout
     */
    this._title = null;

    /**
     * Add image instead text
     * @var string
     */
    this._imageButtonUrl = null;

    /**
     * @object PaypalInstantCheckoutButton
     */
    var PaypalInstantCheckoutButton = this;

    /**
     * Render button paypal instant checkout
     * @returns {html}
     */
    this.getButton = function () {

        if (this._actionUrl === null || typeof this._actionUrl === 'undefined')
            return;

        var titleButton = (this._titleButton !== null) ? this._titleButton : '';
        var classCssButton = (this._classCssButton !== null) ? this._classCssButton : '';
        var texTranslationButtonPayPal = (this._texTranslationButtonPayPal !== null) ? this._texTranslationButtonPayPal : '';
        var headerBlock = '';
        if (this._title !== null)
            headerBlock = '<p class="hs_option_checkout">' + this._title + '</p>';
        if (this._imageButton !== '')
            return headerBlock + '<h5 style="text-align: right;"><a class="hs_paypal_img_btn page_check_out ' + classCssButton + '" href="' + this._actionUrl + '" alt="' + titleButton + '"><img src="' + this._imageButton + '" title="' + titleButton + '" /></a></h5>';
        else
            return headerBlock + '<h5 style="text-align: right;"><a class="hs_paypal_btn page_check_out ' + classCssButton + '" href="' + this._actionUrl + '" alt="' + titleButton + '">' + texTranslationButtonPayPal + '</a></h5>';
    };

    this.init = function () {
        $(document).on('click', this.selectors.colorPick, function () {
            PaypalInstantCheckoutButton.findMatchCombination();
        });

        $(document).on('change', this.selectors.attributeSelect, function () {
            PaypalInstantCheckoutButton.findMatchCombination();
        });

        $(document).on('click', this.selectors.attributeRadio, function () {
            PaypalInstantCheckoutButton.findMatchCombination();
        });
        $(document).on('change', '.product-variants [data-product-attribute]', function () {
            PaypalInstantCheckoutButton.showButtonPaypal();
        });
        PaypalInstantCheckoutButton.showButtonPaypal();
        PaypalInstantCheckoutButton.findMatchCombination();
    };

    this.showButtonPaypal = function () {
        setTimeout(function () {
            if ($('.product-add-to-cart').find('.add-to-cart').attr('disabled')) {
                $(PaypalInstantCheckoutButton.selectors.paypalCheckoutButton).hide('quick');
            } else {
                $(PaypalInstantCheckoutButton.selectors.paypalCheckoutButton).show('quick');
            }
        }, 1000);
    };

    this.findMatchCombination = function () {
        var choice = [];
        var radio_inputs = parseInt($(PaypalInstantCheckoutButton.selectors.radioInputCheckedClass).length);
        if (radio_inputs)
            radio_inputs = PaypalInstantCheckoutButton.selectors.radioInputCheckedClass;
        else
            radio_inputs = PaypalInstantCheckoutButton.selectors.radioInputChecked;
        $(PaypalInstantCheckoutButton.selectors.selectElements + ',' + PaypalInstantCheckoutButton.selectors.inputElements + ',' + radio_inputs).each(function () {
            choice.push(parseInt($(this).val()));
        });

        if (typeof combinations == 'undefined' || !combinations)
            combinations = [];
        //testing every combination to find the conbination's attributes' case of the user
        for (var combination = 0; combination < combinations.length; ++combination)
        {
            //verify if this combinaison is the same that the user's choice
            var combinationMatchForm = true;
            $.each(combinations[combination]['idsAttributes'], function (key, value)
            {
                if (!in_array(parseInt(value), choice))
                    combinationMatchForm = false;
            });

            if (combinationMatchForm)
            {
                if (combinations[combination]['quantity'] <= 0 || (typeof productAvailableForOrder != 'undefined' && productAvailableForOrder == 0)) {
                    $(PaypalInstantCheckoutButton.selectors.paypalCheckoutButton).hide('slow');
                } else {
                    $(PaypalInstantCheckoutButton.selectors.paypalCheckoutButton).show('slow');
                }
            }
        }
    };

    /**
     * Set url action
     * @param {string} actionUrl
     */
    this.setActionUrl = function (actionUrl) {

        if (typeof actionUrl !== 'undefined')
            this._actionUrl = actionUrl;
    };

    /**
     * Set title
     * @param {string} setTitle
     */
    this.setTitle = function (setTitle) {

        if (typeof setTitle !== 'undefined')
            this._title = setTitle;
    };

    /**
     * Set image url
     * @param {string} imageUrl
     */
    this.setImageUrl = function (imageUrl) {

        if (typeof imageUrl !== 'undefined')
            this._imageUrl = imageUrl;
    };

    /**
     * Set title button
     * @param {string} titleButton
     */
    this.setTitleButton = function (titleButton) {

        if (typeof titleButton !== 'undefined')
            this._titleButton = titleButton;
    };

    /**
     * Set title button
     * @param {string} titleButton
     */
    this.setLabel = function (texTranslationButtonPayPal) {

        if (typeof texTranslationButtonPayPal !== 'undefined')
            this._texTranslationButtonPayPal = texTranslationButtonPayPal;
    };

    /**
     * Set class css of button
     * @param {string} titleButton
     */
    this.setClassCssButton = function (classCssButton) {

        if (typeof classCssButton !== 'undefined')
            this._classCssButton = classCssButton;
    };

    /**
     * Set button image link
     * @param {string} imageUrl
     */
    this.setButtonImage = function (imageButtonUrl) {
        if (typeof imageButtonUrl !== 'undefined')
            this._imageButton = imageButtonUrl;
    }
};

$(document).ready(function ()
{
    // Add  button to shopping cart popup (after adding to basket)
    paypalInstantCheckoutButton = new PaypalInstantCheckoutButton();
    paypalInstantCheckoutButton.setActionUrl(payPalActionUrl);
    paypalInstantCheckoutButton.setImageUrl(shoppingCartImageUrl);
    paypalInstantCheckoutButton.setTitleButton(shoppingCartTitleButton);
    paypalInstantCheckoutButton.setClassCssButton(shoppingCartClassCssButton);
    paypalInstantCheckoutButton.setLabel(shoppingCartPaypalLable);
    paypalInstantCheckoutButton.setButtonImage(shoppingCartPaypalButtonImage);
    paypalInstantCheckoutButton.init();
    if (parseInt(buttonPositions.PAYPAL_POSITION_ADDING_TO_CART) === 1)
    {
        paypalButton = paypalInstantCheckoutButton.getButton();
        if (paypalButton) {
            $('#layer_cart .layer_cart_cart .button-container').append(paypalButton);
            $(document).on('shown.bs.modal', function (e) {
                $('.cart-content').append(paypalButton);
            });
        }
    }

    if (parseInt(buttonPositions.PAYPAL_POSITION_BLOCK_CART) === 1)
    {
        // Add button in block header cart
        var paypalInstantCheckoutButtonHeader = $.extend({}, paypalInstantCheckoutButton);
        paypalInstantCheckoutButtonHeader.setImageUrl(headerCartImageUrl);
        paypalInstantCheckoutButtonHeader.setTitleButton(headerCartTitleButton);
        paypalInstantCheckoutButtonHeader.setLabel(headerCartPaypalLable);
        paypalInstantCheckoutButtonHeader.setButtonImage(headerCartButtonImage);
        var paypalButtonHeader = paypalInstantCheckoutButtonHeader.getButton();
        if (paypalButtonHeader)
            $(paypalButtonHeader).insertAfter('#button_order_cart');
    }

    if (parseInt(buttonPositions.PAYPAL_POSITION_CHECKOUT_PAGE) === 1)
    {
        // Add button in checkout page
        var paypalInstantCheckoutButtonCheckoutPage = $.extend({}, paypalInstantCheckoutButton);
        paypalInstantCheckoutButtonCheckoutPage.setImageUrl(checkOutPageImageUrl);
        paypalInstantCheckoutButtonCheckoutPage.setTitleButton(checkOutPageTitleButton);
        paypalInstantCheckoutButtonCheckoutPage.setLabel(checkOutPagePaypalLable);
        paypalInstantCheckoutButtonCheckoutPage.setButtonImage(checkOutPageButtonImage);
        if (parseInt(isOneStepCheckOut) !== 1)
            paypalInstantCheckoutButtonCheckoutPage.setTitle(hsTranslationOr);
        var paypalButtonCheckoutPage = paypalInstantCheckoutButtonCheckoutPage.getButton();
        var positionButtonPaypalCheckoutStep1 = $('#HOOK_SHOPPING_CART').next();
        if (!isPrestashop16)
            positionButtonPaypalCheckoutStep1 = positionButtonPaypalCheckoutStep1.next();
        if (positionButtonPaypalCheckoutStep1.length > 0)
        {
            $(paypalButtonCheckoutPage).insertAfter(positionButtonPaypalCheckoutStep1);
            $('.hs_option_checkout').css('padding-top', '0');
        }
        var positionButtonPaypalStep3 = document.getElementsByName('processAddress');
        var positionButtonPaypalStep4 = document.getElementsByName('processCarrier');
        if (typeof positionButtonPaypalStep3 !== 'undefined')
            $(paypalButtonCheckoutPage).insertAfter(positionButtonPaypalStep3);
        if (typeof positionButtonPaypalStep4 !== 'undefined')
            $(paypalButtonCheckoutPage).insertAfter(positionButtonPaypalStep4);
    }

    if (typeof paypalInstantCheckoutOptionPayment.html !== 'undefined')
    {
        var paypalInstantCheckoutPayment = new PaypalInstantCheckoutPayment();
        paypalInstantCheckoutPayment.setHtml(paypalInstantCheckoutOptionPayment);
        paypalInstantCheckoutPayment.onLoad();
    }
    new PaypalInstantListButtonController({
        ajaxUrl: listButtonPaypalUrlAjax,
        displayPostcodeForm: listButtonPaypalDisplayPostcodeForm,
        stPaypalInstant: listButtonPaypalStPaypalInstant,
        isPaypalInstantButtonListProductPage: listButtonPaypalButtonListProductPage
    }).onLoad();
    $('.pp-checkout-btn .page_check_out').click(function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        if (url.indexOf('?') !== -1) {
            url += '&';
        } else {
            url += '?';
        }
        if (isPrestashop17) {
            _redirectPaypalPayment17(url);
        } else {
            _redirectPaypalPayment16(url);
        }
    });
    function _redirectPaypalPayment16(url)
    {
        var idProduct = $("#buy_block").children().find("#product_page_product_id").val();
        var idProductAttribute = $("#buy_block").children().find("#idCombination").val();
        var quantityWanted = $("#buy_block").children().find("#quantity_wanted").val();
        if (typeof isPrestashop16 !== 'undefined' && isPrestashop16) {
            if (contentOnly !== 'undefined' && contentOnly === true)
                parent.$.fancybox.close();
        }
        if (typeof idProduct !== 'undefined') {
            url += "id_product=" + parseInt(idProduct);
        }
        if (typeof idProductAttribute !== 'undefined' && idProductAttribute !== '') {
            url += "&id_product_attribute=" + parseInt(idProductAttribute);
        } else {
            url += "&id_product_attribute=" + 0;
        }
        quantity = (typeof quantityWanted !== 'undefined' && quantityWanted > 0) ? quantityWanted : 1;
        url += "&qty=" + parseInt(quantity);
        window.parent.document.location.href = url;
        return false;
    }

    function _redirectPaypalPayment17(url)
    {
        var query = $('#add-to-cart-or-refresh').serialize();
        url = url + query;
        window.parent.document.location.href = url;
        return false;
    }
});