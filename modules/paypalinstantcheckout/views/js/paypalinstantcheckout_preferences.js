/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

$(document).ready(function () {
    displayConfigurationTab(currentFormTab);  
});

/**
 * 
 * @param {string} currentTab current active tab
 */
function displayConfigurationTab(currentTab)
{        
	$('.configuration-tab').hide();
	$('.tab-row.active').removeClass('active');
	$('.configuration_fieldset_' + currentTab).show();        
	$('#configuration_link_' + currentTab).parent().addClass('active');
	$('#currentFormTab').val(currentTab);
        $('#currentFormTab').remove();
        $("<input id='currentFormTab' name='currentFormTab' type='hidden' value='"+currentTab+"' />").appendTo('#configuration_form');
}