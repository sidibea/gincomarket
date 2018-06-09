<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */
class Group extends GroupCore
{
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public static function getCurrent()
    {
        $context = Context::getContext();
        $caller = self::getCallerMethod();
        if ((!isset($context->customer) || !$context->customer->id)
            && strcmp($caller,'getCacheId') !== 0
            && isset($context->cookie)
            && isset($context->cookie->pc_group_default)) {
            $id_group = (int) $context->cookie->pc_group_default;
            if ($id_group > 0) {
                return new Group($context->cookie->pc_group_default);
            }
        }
        return parent::getCurrent();
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public static function getReduction($id_customer = null)
    {
        $context = Context::getContext();
        if (!$id_customer
            && isset($context->cookie)
            && isset($context->cookie->pc_group_default)) {
            $id_group = (int) $context->cookie->pc_group_default;
            if ($id_group > 0) {
                return Group::getReductionByIdGroup($context->cookie->pc_group_default);
            }
        }
        return parent::getReduction($id_customer);
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private static function getCallerMethod()
    {
        $traces = debug_backtrace();
        if (isset($traces[2])) {
            return $traces[2]['function'];
        }
        return null;
    }
}
