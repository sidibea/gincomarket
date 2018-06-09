<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Magic Toolbox <support@magictoolbox.com>
*  @copyright Copyright (c) 2015 Magic Toolbox <support@magictoolbox.com>. All rights reserved
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$settings = $GLOBALS['magictoolbox_temp_settings'];
$trial = $GLOBALS['magictoolbox_temp_trial'];
$params = $GLOBALS['magictoolbox_temp_params'];

$html = array();

$html[] = '<link rel="stylesheet" href="'.$settings->getResourcesURL('css').'mt-form.css">';
$html[] = '<link rel="stylesheet" href="'.$settings->getResourcesURL('css').'mt-form-font.css">';
$html[] = $settings->getCSS();
$html[] = '
<script type="text/javascript">
//<![CDATA[
var jQueryNoConflictLevel = '.$settings->jQueryNoConflictLevel().'
//]]>
</script>';

if ($settings->loadJQuery()) {
    $html[] = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
}

$html[] = '<script src="'.$settings->getResourcesURL('js').'jquery.highlight-4.js"></script>';
$html[] = '<script src="'.$settings->getResourcesURL('js').'mt-form.js"></script>';
$html[] = '<script src="'.$settings->getResourcesURL('js').'affix.js"></script>';
$html[] = $settings->getScripts();

$html[] = '<div class="mt-settings-form mt-tabs-left mt-border-r-4px">';

if ($settings->showPageTitle()) {
    $html[] = '<h1>'.$settings->pageTitle.'</h1>';
}

$html[] = '<div class="mt-left-sidebar">';
$html[] = '<ul class="mt-tabs mt-border-r-4px">';

$tabIndex = 0;

foreach ($settings->profiles as $profileId => $profileTitle) {
    $html[] = '<li class="mt-'.($settings->profileEnabled($profileId) ? 'on' : 'off').'">';
    $html[] = '<a id="'.$profileId.'-tab" class="'.($profileId == $settings->activeTab ? 'mt-active' : '').'" data-mt-tab="mt-tab-'.$tabIndex.'" href="#">';
    $html[] = $profileTitle;
    $html[] = '</a>';
    $html[] = '</li>';
    $tabIndex++;
}

$html[] = '</ul>';

$html[] = '<ul class="mt-tabs mt-tabs-license mt-border-r-4px">';
$html[] = '<li class="mt-'.($trial ? 'off' : 'on').'">';
$html[] = '<a id="licenses-tab" class="'.('licenses' == $settings->activeTab ? 'mt-active' : '').'" data-mt-tab="mt-tab-'.$tabIndex.'" href="#">License</a>';
$html[] = '</li>';
$html[] = '</ul>';
$html[] = '
<div class="mt-support-block">
    <span class="mt-icon-question"></span>
    Got an issue or question?<br/>
    <a target="_blank" class="mt-support-link" href="https://addons.prestashop.com/en/write-to-developper?id_product=2196"><b>Email support</b></a>
    <div class="mt-clearfix"></div>
</div>';
$html[] = '</div>';/* mt-left-sidebar */

$html[] = '<form id="magictoolbox-settings-form" action="'.$settings->getFormAction().'" method="post" enctype="multipart/form-data" autocomplete="off">';
$html[] = '<input type="hidden" name="magicscroll-active-tab" id="magicscroll-active-tab" value="'.$settings->activeTab.'" />';
$html[] = '<input type="hidden" name="magicscroll-submit-action" id="magicscroll-submit-action" value="save" />';
$html[] = $settings->getInputsHTML();

$html[] = '<div class="mt-buttons">';
$html[] = '<input type="button" class="mt-button mt-border-r-4px" data-submit-action="save" value="Save settings"/>';
$html[] = '<input type="button" class="mt-button mt-border-r-4px" data-submit-action="reset" value="Reset to defaults"/>';
$html[] = $settings->getAdditionalButtons();
$html[] = '</div>';

$tabIndex = 0;

foreach ($settings->paramsMap as $profileId => $groups) {
    $params->setProfile($profileId);

    $html[] = '<div class="mt-tab-pane '.($profileId == $settings->activeTab ? 'mt-active' : '').'" id="mt-tab-'.$tabIndex.'">';

    $html[] = '<h1>'.$settings->profiles[$profileId].'</h1>';
    if (!empty($settings->profilesDescription[$profileId])) {
        $html[] = '<h4 class="mt-profile-description">'.$settings->profilesDescription[$profileId].'</h4>';
    }

    /*
    $html[] = '<div class="mt-tab-controls mt-border-r-4px">';
    $html[] = '<div class="mt-table-row">';
    $html[] = '<span><label><input type="checkbox" class="mt-show-hide-advanced" data-search-source="mt-tab-'.$tabIndex.'"/>Advanced options</label></span>';
    $html[] = '<span><input type="text" class="mt-parameter-keyword" data-search-source="mt-tab-'.$tabIndex.'" placeholder="Search for parameter..."/></span>';
    $html[] = '</div>';
    $html[] = '</div>';
    */

    foreach ($groups as $groupTitle => $ids) {
        $groupId = preg_replace('#[^a-z0-9]#i', '', Tools::strtolower($groupTitle));
        $html[] = '<fieldset class="mt-border-r-4px"><legend>'.$groupTitle.'</legend>';
        $html[] = '<div class="params-block" id="block-'.$groupId.'" >';

        if ($profileId == $settings->customSlideshowProfileId && $groupTitle == $settings->customSlideshowGroupTitle) {
            $html[] = '<div class="mt-form-item">';
            ob_start();
            require(dirname(__FILE__).DIRECTORY_SEPARATOR.'magictoolbox.settings.slideshow.tpl.php');
            $html[] = ob_get_clean();
            $html[] = '</div>';
        }

        foreach ($ids as $id => $required) {
            $value = $params->getValue($id);
            $type = $params->getType($id);
            $subType = $params->getSubType($id);
            $enabled = $required || $settings->isEnabledParam($id, $profileId);
            $disabled = $enabled ? '' : ' disabled="disabled"';

            //$html[] = '<div class="mt-form-item'.($params->isAdvanced($id) ? ' mt-advanced' : '').'">';
            $html[] = '<div class="mt-form-item">';
            $html[] = '<div class="mt-param-name"><label for="'.$profileId.'-'.$id.'">'.$params->getLabel($id).'</label></div>';
            $html[] = '<div class="mt-param-holder '.$type.'" data-default="'.$params->getDefaultValue($id).'" data-type="'.$type.(empty($subType) ? '' : '-'.$subType).'">';
            $html[] = '<div class="mt-param-holder-inner">';

            switch ($type) {
                case 'array':
                    if ($subType == 'radio') {
                        $html[] = '<span>';
                        $firstChild = true;
                        foreach ($params->getValues($id) as $index => $v) {
                            $html[] = '<input type="radio" value="'.$v.'"'.($value == $v ? ' checked="checked"' : '').' name="'.$settings->getName($profileId, $id).'" id="'.$profileId.'-'.$id.'-'.$index.'"'.$disabled.'/>';
                            $labelClass = '';
                            if ($v == 'No') {
                                $labelClass = 'mt-no-radio';
                            }
                            if ($firstChild) {
                                $labelClass .= ' mt-fchild';
                                $firstChild = false;
                            }
                            $html[] = '<label class="'.$labelClass.'" for="'.$profileId.'-'.$id.'-'.$index.'">';
                            $html[] = '<span>'.$settings->getValueForDisplay($v).'</span>';
                            $html[] = '</label>';
                        }
                        $html[] = '</span>';
                    } elseif ($subType == 'select') {
                        $html[] = '<select name="'.$settings->getName($profileId, $id).'" id="'.$profileId.'-'.$id.'"'.$disabled.'>';

                        foreach ($params->getValues($id) as $v) {
                            $html[] = '<option value="'.$v.'"'.($value == $v ? ' selected="selected"' : '').'>'.$v.'</option>';
                        }

                        $html[] = '</select>';
                    } else {
                        $html[] = '<input type="text" class="mt-input text" name="'.$settings->getName($profileId, $id).'" id="'.$profileId.'-'.$id.'"'.$disabled.' value="'.$value.'" />';
                    }
                    break;
                case 'num':
                case 'text':
                default:
                    $html[] = '<input type="text" class="mt-input '.$type.'" name="'.$settings->getName($profileId, $id).'" id="'.$profileId.'-'.$id.'"'.$disabled.' value="'.$value.'" />';
            }

            if (!$required) {
                if ($enabled) {
                    $html[] = '&nbsp;&nbsp;<a href="#" class="mt-switch-option-link" data-name="'.$settings->getName($profileId, $id).'" data-general-name="'.$settings->getName($params->generalProfile, $id).'" onclick="return false;">use default option</a>';
                } else {
                    $html[] = '&nbsp;&nbsp;<a href="#" class="mt-switch-option-link option-disabled" data-name="'.$settings->getName($profileId, $id).'" data-general-name="'.$settings->getName($params->generalProfile, $id).'" onclick="return false;">edit</a>';
                }
            }

            $html[] = '</div>';/* mt-param-holder-inner */

            $hint = '';

            if ($description = $params->getDescription($id)) {
                $hint = $description;
            }

            if ($type != 'array' && $params->valuesExists($id, '', false)) {
                if ($hint != '') {
                    $hint .= '<br />';
                }
                $hint .= '#allowed values: '.implode(', ', $params->getValues($id));
            }

            if ($hint != '') {
                $html[] = '<span class="mt-help-block">'.$hint.'</span>';
            }

            $html[] = '</div>';/* mt-param-holder */
            $html[] = '</div>';/* mt-form-item */
        }
        $html[] = '</div>';/* params-block */
        $html[] = '</fieldset>';
    }
    $html[] = '</div>';/* mt-tab-pane */

    $tabIndex++;
}

$html[] = '<div class="mt-tab-pane '.('licenses' == $settings->activeTab ? 'mt-active' : '').'" id="mt-tab-'.$tabIndex.'" data-skip-showhide="1">';

if (!empty($settings->message)) {
    $html[] = '<div class="mt-alert-message">';
    $html[] = $settings->message;
    $html[] = '</div>';
}

$license = $settings->getLicenseType('magicscroll');

$html[] = '
<fieldset class="mt-border-r-4px">
    <legend>Magic Scroll&trade;</legend>
    <p>License status: <b class="mt-'.$license.'">'.$license.'</b>'.($license == 'trial' ? ' (<a class="show-upgrade-instructions" href="#">upgrade</a>)' : '').'.</p>
    <ol class="mt-instructions">
        <li>Please purchase license <a target="_blank" href="https://www.magictoolbox.com/buy/magicscroll">here</a>.</li>
        <li>
            <p>Enter your license key (XXXXXXX) for:</p>
            <input type="text" class="form-control" name="magicscroll-license-key" id="magicscroll-license-key" placeholder="License key" value="" autocomplete="off" />
            <input type="button" class="mt-button mt-border-r-4px mt-button-small" data-submit-action="license" value="Submit"/>
        </li>
    </ol>
</fieldset>';

if ($settings->core->type == 'standard' && $settings->isMagicScrollBundled) {
    $license = $settings->getLicenseType('magicscroll');
    $html[] = '
    <fieldset class="mt-border-r-4px">
        <legend>Magic Scroll&trade;</legend>
        <p>The trial version of <a target="_blank" href="https://www.magictoolbox.com/magicscroll">Magic Scroll</a> comes bundled in this Magic Scroll module. Perfect if you have many images per product, activate Magic Scroll to neatly organise images in a scrolling area above/below/left/right of the main image.</p>
        <p>Enable the free trial to see how it works. Buy it for <a target="_blank" href="http://www.magictoolbox.com/buy/magicscroll/">only £19</a> (normally £29).</p>
        <p>License status: <b class="mt-'.$license.'">'.$license.'</b>'.($license == 'trial' ? ' (<a class="show-upgrade-instructions" href="#">upgrade</a>)' : '').'.</p>
        <ol class="mt-instructions">
            <li>Please purchase license <a target="_blank" href="https://www.magictoolbox.com/buy/magicscroll">here</a>.</li>
            <li>
                <p>Enter your license key (XXXXXXX) for:</p>
                <input type="text" class="form-control" name="magicscroll-license-key" id="magicscroll-license-key" placeholder="License key" value="" autocomplete="off" />
                <input type="button" class="mt-button mt-border-r-4px mt-button-small" data-submit-action="license" value="Submit"/>
            </li>
        </ol>
    </fieldset>';
}

$html[] = '</div>';/* mt-tab-pane */

$html[] = '
<script type="text/javascript">
//<![CDATA[
var magictoolboxProfiles = [\''.implode("', '", array_keys($settings->profiles)).'\'];
//]]>
</script>';

$html[] = '</form>';

$html[] = '</div>';/* mt-settings-form */

echo implode("\n", $html);
