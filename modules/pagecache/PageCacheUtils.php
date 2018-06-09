<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

if (! defined('_CAN_LOAD_FILES_'))
    exit();

if (! class_exists('PageCacheUtils')) {

    class PageCacheUtils
    {
        /**
         * Original PHP code by Chirp Internet: www.chirp.com.au, Please acknowledge use of this code by including this header.
         *
         * @param unknown $html
         */
        public static function parseLinks($html, $base, $managedControllers, $tagIgnoreStart = false, $tagIgnoreEnd = false) {
            $startPos = false;
            if ($tagIgnoreStart !== false) {
                if (method_exists('Tools', 'strpos')) {
                    $startPos = Tools::strpos($html, $tagIgnoreStart);
                }
                else {
                    $startPos = strpos($html, $tagIgnoreStart);
                }
            }
            if ($startPos !== false) {
                $linksBefore = array();
                $linksAfter = array();
                if (method_exists('Tools', 'strpos')) {
                    $endPos = Tools::strpos($html, $tagIgnoreEnd, min(Tools::strlen($html), $startPos + 4));
                }
                else {
                    $endPos = strpos($html, $tagIgnoreEnd, min(Tools::strlen($html), $startPos + 4));
                }
                $linksBefore = self::parseLinks(Tools::substr($html, 0, $startPos), $base, $managedControllers, $tagIgnoreStart, $tagIgnoreEnd);
                if ($endPos !== false) {
                    $linksAfter = self::parseLinks(Tools::substr($html, $endPos + 4), $base, $managedControllers, $tagIgnoreStart, $tagIgnoreEnd);
                }
                return array_merge($linksBefore, $linksAfter);
            }
            else {
                $links = array();

                $base_relative = preg_replace('/https?:\/\//', '//', $base);
                $base_exp = preg_replace('/([^a-zA-Z0-9])/', '\\\\$1', $base);
                $base_exp = preg_replace('/https?/', 'http[s]?', $base_exp);
                $regexp = '<a\s[^>]*href=(\"??)' . $base_exp . '([^\" >]*?)\\1[^>]*>(.*)<\/a>';
                $isMultiLanguageActivated = Language::isMultiLanguageActivated();

                if(preg_match_all("/$regexp/siU", $html, $matches, PREG_SET_ORDER)) {

                    // The links array will help us to remove duplicates
                    foreach($matches as $match) {
                        // $match[2] = link address
                        // $match[3] = link text
                        // Insert backlinks that correspond to a possibily cached page into the database

                        $url = $match[2];
                        // Add leading /
                        if (strpos($url, "/") > 0 || strpos($url, "/") === false) {
                            $url = "/" . $url;
                        }

                        // Remove language part if any
                        $url_without_lang = $url;
                        if ($isMultiLanguageActivated && preg_match('#^/([a-z]{2})(?:/.*)?$#', $url, $m)) {
                            $url_without_lang = Tools::substr($url, 3);
                        }
                        $anchorPos = strpos($url_without_lang, '#');
                        if ($anchorPos !== false) {
                            $url_without_lang = Tools::substr($url_without_lang, 0, $anchorPos);
                        }

                        $bl_controller = Dispatcher::getInstance()->getControllerFromURL($url_without_lang);
                        if ($bl_controller === false) {
                            // To avoid re-installation of override we have this workaround
                            $bl_controller = Dispatcher::getInstance()->getControllerFromURL('en'. $url_without_lang);
                        }
                        if (in_array($bl_controller, $managedControllers)) {
                            $links[$match[2]] = $base_relative . $match[2];
                        }
                    }
                }
                return $links;
            }
        }

        public static function parseCSS($html, $base) {
            $links = array();
            $base_exp = preg_replace('/([^a-zA-Z0-9])/', '\\\\$1', $base);
            $regexp = '<link\s[^>]*href=(\"??)[^\" >]*' . $base_exp . '([^\" >]*?)\\1[^>]*>';
            if(preg_match_all("/$regexp/siU", $html, $matches, PREG_SET_ORDER)) {
                foreach($matches as $match) {
                    $links[] = $match[2];
                }
            }
            return $links;
        }

        public static function parseJS($html, $base) {
            $links = array();
            $base_exp = preg_replace('/([^a-zA-Z0-9])/', '\\\\$1', $base);
            $regexp = '<script\s[^>]*src=(\"??)[^\" >]*' . $base_exp . '([^\" >]*?)\\1[^>]*>';
            if(preg_match_all("/$regexp/siU", $html, $matches, PREG_SET_ORDER)) {
                foreach($matches as $match) {
                    $links[] = $match[2];
                }
            }
            return $links;
        }
    }
}