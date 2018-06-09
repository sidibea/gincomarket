<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

if (!defined('_PS_VERSION_'))
    exit;

include_once(dirname(__FILE__) . '/../../pagecache.php');

class pagecachePcspeedanalysisModuleFrontController extends ModuleFrontController
{
    public $php_self = null;

    public function init()
    {
        parent::init();
    }

    public function initContent()
    {
        parent::initContent();

        $result = 'Not OK';
        if (Module::isEnabled("pagecache")) {
            $module = Module::getInstanceByName("pagecache");
            $token = Tools::getValue('token', '');
            $url = Tools::getValue('url', '');
            $goodToken = Configuration::get('pagecache_cron_token');
            if ((!$goodToken || strcmp($goodToken, $token) === 0) && Tools::strlen($url) > 0) {
                $page = Tools::file_get_contents($url, false, null, 60);
                if ($page !== false && Tools::strlen($page) > 0) {
                    $result = 'OK';
                }
                else {
                    if (strpos($url, 'http://') === 0) {
                        // Try with HTTPs protocol
                        $url = str_replace('http://', 'https://', $url);
                        $page = Tools::file_get_contents($url, false, null, 60);
                        if ($page !== false && Tools::strlen($page) > 0) {
                            $result = 'OK';
                        }
                        else {
                            header("HTTP/1.0 404 Not Found");
                            $result = $module->l('Cannot read URL, there is probably a redirection') . ' (' . str_replace('&amp;', '&', $url) . '). ';
                            $result .= $module->l('This may also occur when allow_url_fopen is enabled but SSL is not correctly configured on your server.');
                        }
                    }
                    else {
                        header("HTTP/1.0 404 Not Found");
                        $result = $module->l('Cannot read URL, there is probably a redirection') . ' (' . str_replace('&amp;', '&', $url) . '). ';
                        $result .= $module->l('This may also occur when allow_url_fopen is enabled but SSL is not correctly configured on your server.');
                    }
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                $result = 'Bad security token ' . $token;
            }
        } else {
            $result = 'The module is not enabled';
        }
        die($result);
    }
}
