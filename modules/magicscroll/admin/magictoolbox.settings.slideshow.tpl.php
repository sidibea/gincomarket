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

if (count($settings->customSlideshowImagesData)) {
    ?>
    <table id="custom-slideshow-images" cellspacing="0" cellpadding="0" class="mt-table">
        <thead>
            <tr>
                <th title="">#</th>
                <th title="">Delete</th>
                <th title="">Order</th>
                <th title="">Exclude</th>
                <?php
                if (!empty($settings->languagesData)) {
                    ?>
                    <th title="">Lang</th>
                    <?php
                }
                ?>
                <th title="">Image</th>
                <th title="">Title/Description/Link</th>
            </tr>
        </thead>
        <?php
        $index = 0;
        foreach ($settings->customSlideshowImagesData as $imageData) {
            $index++;
            ?>
            <tr id="row-<?php echo $imageData['id']; ?>">
                <td><?php echo $index; ?></td>
                <td>
                    <a href="#" onclick="return deleteImage('<?php echo $imageData['id'] ?>');" title="Delete image"><span class="mt-icon-trash"></span></a>
                    <input type="hidden" name="images-update-data[<?php echo $imageData['id'] ?>][delete]" id="delete-<?php echo $imageData['id'] ?>" value="0"/>
                </td>
                <td>
                    <input type="text" name="images-update-data[<?php echo $imageData['id'] ?>][order]" value="<?php echo $imageData['order'] ?>" class="mt-input-order"/>
                </td>
                <td>
                    <input type="checkbox" name="images-update-data[<?php echo $imageData['id'] ?>][exclude]" value="<?php echo $imageData['exclude'] ?>"<?php echo ($imageData['exclude'] ? ' checked="checked"' : '') ?>/>
                </td>
                <?php
                if (!empty($settings->languagesData)) {
                    ?>
                    <td>
                        <select name="images-update-data[<?php echo $imageData['id'] ?>][lang]">
                            <option value="0" <?php echo (!$imageData['lang'] ? 'selected="selected"' : '') ?>>all</option>
                            <?php
                            foreach ($settings->languagesData as $language) {
                                ?>
                                <option value="<?php echo $language['id'] ?>"
                                <?php
                                if ($imageData['lang'] == $language['id']) {
                                    echo ' selected="selected"';
                                }
                                if (!$language['active']) {
                                    echo ' disabled="disabled"';
                                }
                                ?>><?php echo $language['code']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <?php
                }
                ?>
                <td>
                    <img src="<?php echo $settings->imageBaseUrl.$imageData['name'] ?>" alt="<?php echo basename($imageData['name']) ?>" title="<?php echo basename($imageData['name']) ?>" style="max-width: 60px; max-height: 180px;" />
                    <input type="hidden" name="images-update-data[<?php echo $imageData['id'] ?>][name]" value="<?php echo $imageData['name'] ?>" />
                </td>
                <td class="mt-slide-td">
                    <b>Title:</b>
                    <input type="text" name="images-update-data[<?php echo $imageData['id'] ?>][title]" value="<?php echo $imageData['title'] ?>">
                    <b>Description:</b>
                    <textarea name="images-update-data[<?php echo $imageData['id'] ?>][description]"><?php echo $imageData['description']; ?></textarea>
                    <b>Link:</b>
                    <input type="text" name="images-update-data[<?php echo $imageData['id'] ?>][link]" value="<?php echo $imageData['link'] ?>">
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>
<div class="mt-upload-container">
    <input type="button" class="mt-upload-button mt-border-r-4px" value="Upload images"/>
    <input class="mt-upload-file" type="file" name="magicscroll-image-files[]" id="upload-file" multiple="multiple" accept="image/*" size="1" onchange="uploadFiles();" />
</div>
<script type="text/javascript">
//<![CDATA[

$jq(document).ready(function($) {
    $('#upload-file').mouseover(function() {
        $('.mt-upload-button').addClass('mt-upload-button-hover');
    }).mouseout(function() {
        $('.mt-upload-button').removeClass('mt-upload-button-hover');
    });
});

function uploadFiles()
{
    $jq('#magicscroll-submit-action').val('upload');
    $jq('#magictoolbox-settings-form').submit();
}

function deleteImage(imageId)
{
    if (parseInt($jq('#delete-'+imageId).val())) {
        $jq('#row-'+imageId).removeClass('mt-delete');
        $jq('#delete-'+imageId).val(0);
    } else {
        $jq('#row-'+imageId).addClass('mt-delete');
        $jq('#delete-'+imageId).val(1);
    }
    return false;
}

//]]>
</script>
