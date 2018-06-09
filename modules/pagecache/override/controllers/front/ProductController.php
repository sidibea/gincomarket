<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

class ProductController extends ProductControllerCore
{

    public function displayAjax()
    {
        // Some smarty variable (like logo_url) are set here
        $this->initHeader();
        // Display ajax content (this function is called instead of classic display, in ajax mode)
        $result = array();
        $index = 0;
        do
        {
            $val = Tools::getValue('hook_' . $index);
            if ($val !== false)
            {
                list($hook_name, $id_module) = explode('|', $val);
                if (Validate::isHookName($hook_name)) {
                    $result[$hook_name . '_' . (int)$id_module] = Hook::exec($hook_name, array('product' => $this->product, 'category' => $this->category) , (int)$id_module);
                }
            }
            $index++;
        } while ($val !== false);

        // Javascript definition need to be updated with correct values, i.e. wit contextual datas (logged in user)
        if (Tools::version_compare(_PS_VERSION_,'1.6','>')) {
            Media::addJsDef(array(
                'isLogged' => (bool)$this->context->customer->isLogged(),
                'isGuest' => (bool)$this->context->customer->isGuest(),
                'comparedProductsIds' => $this->context->smarty->getTemplateVars('compared_products'),
            ));
            // Add JS def but keep original baseDir and baseUrl
            $defs = Media::getJsDef();
            unset($defs['baseDir']);
            unset($defs['baseUrl']);
            $this->context->smarty->assign(array(
                'js_def' => $defs,
            ));
            $result['js'] = $this->context->smarty->fetch(_PS_ALL_THEMES_DIR_.'javascript.tpl');
        }

        // Write cookie set by dynamic modules if needed
        $this->context->cookie->write();

        header('Content-Type: application/json');
        header('Cache-Control: no-cache');
        header('X-Robots-Tag: noindex');
        die(Tools::jsonEncode($result));
    }
}