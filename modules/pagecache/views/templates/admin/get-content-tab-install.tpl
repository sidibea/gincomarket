{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<form id="pagecache_form_install" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="install"/>
    <input type="hidden" name="pagecache_disable_tokens" value="false" id="pagecache_disable_tokens"/>
    <fieldset>
    <div style="clear: both; padding-top:15px;">
    {if $pagecache_debug}

        <input type="hidden" name="pagecache_install_step" id="pagecache_install_step" value="{$cur_step + 1|escape:'html'}"/>
        <input type="hidden" name="pagecache_disable_loggedin" id="pagecache_disable_loggedin" value="0"/>
        <input type="hidden" name="pagecache_seller" id="pagecache_seller" value="{$pagecache_seller|escape:'html'}"/>
        <input type="hidden" name="pagecache_autoconf" id="pagecache_autoconf" value="false"/>

        {if $cur_step > $INSTALL_STEP_INSTALL}
            <div class="installstep">{l s='Congratulations!' mod='pagecache'} {$module_displayName|escape:'html'} {l s='is currently installed in' mod='pagecache'} <b>{l s='test mode' mod='pagecache'}</b>{l s=', that means it\'s not yet activated to your visitors.' mod='pagecache'}</div>
        {/if}

        <div class="installstep">{l s='To complete the installation, please follow these steps:' mod='pagecache'}

            {* INSTALL STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_INSTALL}stepok{elseif $cur_step < $INSTALL_STEP_INSTALL}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_INSTALL} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_INSTALL}
                   <span>{$INSTALL_STEP_INSTALL|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Install the module and enable test mode' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_INSTALL}
                <div class="stepdesc"><ol><li>{l s='Resolve displayed errors above' mod='pagecache'}</li></ol></div>
                {/if}
            </div>

            {* BUY FROM STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_BUY_FROM}stepok{elseif $cur_step < $INSTALL_STEP_BUY_FROM}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_BUY_FROM} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_BUY_FROM}
                   <span>{$INSTALL_STEP_BUY_FROM|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Tell us where did you buy the module' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_BUY_FROM}
                <div class="stepdesc">
                    <ol>
                        <li>{l s='In order to display correct links for support just tell us where you bought ' mod='pagecache'}{$module_displayName|escape:'html'}</li>
                    </ol>
                    <a href="#" class="okbtn" onclick="$('#pagecache_seller').val('addons');$('#pagecache_form_install').submit();return false;">{l s='Prestashop Addons' mod='pagecache'}</a>
                    <a href="#" class="okbtn" onclick="$('#pagecache_seller').val('jpresta');$('#pagecache_form_install').submit();return false;">{l s='JPresta.com' mod='pagecache'}</a>
                </div>
                {/if}
            </div>

            {* IN ACTION STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_IN_ACTION}stepok{elseif $cur_step < $INSTALL_STEP_IN_ACTION}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_IN_ACTION} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_IN_ACTION}
                   <span>{$INSTALL_STEP_IN_ACTION|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Check that the module is well installed' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_IN_ACTION}
                <div class="stepdesc">
                    <ol>
                        <li><a href="{$shop_link_debug|escape:'html'}" target="_blank">{l s='Click here to browse your site in test mode' mod='pagecache'}</a></li>
                        <li>{l s='You must see a box displayed in bottom left corner of your store' mod='pagecache'}</li>
                        <li>{l s='You must be able to play with these buttons' mod='pagecache'} &nbsp;&nbsp;<img src="../modules/{$module_name|escape:'html'}/views/img/on.png" alt="" width="16" height="16" /><img src="../modules/{$module_name|escape:'html'}/views/img/reload.png" alt="" width="16" height="16" /><img src="../modules/{$module_name|escape:'html'}/views/img/trash.png" alt="" width="16" height="16" /><img src="../modules/{$module_name|escape:'html'}/views/img/close.png" alt="" width="16" height="16" /></li>
                    </ol>
                    <a href="#" class="okbtn" onclick="$('#pagecache_form_install').submit();return false;">{l s='OK, I validate this step' mod='pagecache'}</a> 
                    <a href="#" class="kobtn" onclick="$('#helpINSTALL_STEP_IN_ACTION').toggle();return false;">{l s='No, I\'m having trouble' mod='pagecache'}</a>
                    <div class="stephelp" id="helpINSTALL_STEP_IN_ACTION">
                        <ol>
                            <li>{l s='Reset the module and see if it\'s better' mod='pagecache'}</li>
                            <li>{l s='If, after resetting the module, you are still having trouble,' mod='pagecache'} <a href="{$contact_url|escape:'html'}" target="_blank">{l s='contact us here' mod='pagecache'}</a></li>
                        </ol>
                    </div>
                </div>
                {/if}
            </div>

            {* AUTOCONF STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_AUTOCONF}stepok{elseif $cur_step < $INSTALL_STEP_AUTOCONF}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_AUTOCONF} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_AUTOCONF}
                   <span>{$INSTALL_STEP_AUTOCONF|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Auto-configuration of known modules' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_AUTOCONF}
                <div class="stepdesc">
                    <p>
                        <i>{l s='Contact our server to request the configuration of know modules so it\'s faster and easier for you' mod='pagecache'}</i>
                    </p>
                    <div class="bootstrap">
                        <div class="alert alert-info" style="display: block;">&nbsp;{l s='Warning: this will erase your current configuration' mod='pagecache'}</div>
                    </div>
                    <button class="okbtn" onclick="$('#pagecache_autoconf').val('true');$('#pagecache_form_install').submit();$(this).prop('disabled', 'true');return false;">{l s='Auto-configuration' mod='pagecache'}</button>
                    <a href="#" class="kobtn" onclick="$('#pagecache_autoconf').val('false');$('#pagecache_form_install').submit();return false;">{l s='Continue manually' mod='pagecache'}</a>
                </div>
                {/if}
            </div>

            {* CART STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_CART}stepok{elseif $cur_step < $INSTALL_STEP_CART}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_CART} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_CART}
                   <span>{$INSTALL_STEP_CART|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Check that the cart is working good' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_CART}
                <div class="stepdesc">
                    <ol>
                        <li><a href="{$shop_link_debug|escape:'html'}" target="_blank">{l s='Click here to browse your site in test mode' mod='pagecache'}</a></li>
                        <li>{l s='Check that you can add products into the cart as usual' mod='pagecache'}</li>
                        <li>{l s='Once you have a product in your cart, display an other page and see if cart still contains the products you added' mod='pagecache'}</li>
                    </ol>
                    <a href="#" class="okbtn" onclick="$('#pagecache_form_install').submit();return false;">{l s='OK, I validate this step' mod='pagecache'}</a> 
                    <a href="#" class="kobtn" onclick="$('#helpINSTALL_STEP_CART').toggle();return false;">{l s='No, I\'m having trouble' mod='pagecache'}</a>
                    <div class="stephelp" id="helpINSTALL_STEP_CART">
                        <ol>
                            <li>{l s='When you display an other page, check that you have the parameter dbgpagecache=1 in the URL. If not, just add it.' mod='pagecache'}</li>
                            <li>{l s='When refreshing the cart, PageCache may remove some "mouse over" behaviours. To set them back you can execute some javascript after all dynamics modules have been displayed.' mod='pagecache'} <a href="#tabdynhooksjs" onclick="displayTab('dynhooks');return true;">{l s='Go in "Dynamic modules" tab in Javascript form.' mod='pagecache'}</a></li>
                            <li>{l s='If you cannot make it work,' mod='pagecache'} <a href="{$contact_url|escape:'html'}" target="_blank">{l s='contact us here' mod='pagecache'}</a></li>
                        </ol>
                    </div>
                </div>
                {/if}
            </div>

            {* LOGGED_IN STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_LOGGED_IN}stepok{elseif $cur_step < $INSTALL_STEP_LOGGED_IN}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_LOGGED_IN} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_LOGGED_IN}
                   <span>{$INSTALL_STEP_LOGGED_IN|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Check that logged in users are recognized' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_LOGGED_IN}
                <div class="stepdesc">
                    <ol>
                        {if $pagecache_skiplogged}
                            {if $avec_bootstrap}
                                <div class="bootstrap">
                                    <div class="alert alert-info" style="display: block;">&nbsp;{l s='Cache is disabled for logged in users so this step should be OK now, but you should check this out anyway ;-)' mod='pagecache'}
                                        <br/>{l s='If you want you can' mod='pagecache'} <a href="#" class="browsebtn" onclick="$('#pagecache_disable_loggedin').val(-1);$('#pagecache_form_install').submit();return false;">{l s='reactivate cache for logged in users' mod='pagecache'}</a>
                                    </div>
                                </div>
                            {else}
                                <div class="hint clear" style="display: block;">&nbsp;{l s='Cache is disabled for logged in users so this step should be OK now, but you should check this out anyway ;-)' mod='pagecache'}
                                    <br/>{l s='If you want you can' mod='pagecache'} <a href="#" class="browsebtn" onclick="$('#pagecache_disable_loggedin').val(-1);$('#pagecache_form_install').submit();return false;">{l s='reactivate cache for logged in users' mod='pagecache'}</a>
                                </div>
                            {/if}
                        {/if}
                        <li><a href="{$shop_link_debug|escape:'html'}" target="_blank">{l s='Click here to browse your site in test mode' mod='pagecache'}</a></li>
                        <li>{l s='You must see the "sign in" link when you are not logged in' mod='pagecache'}</li>
                        <li>{l s='You must see the the user name when you are logged in' mod='pagecache'}</li>
                        <li>{l s='Of course it depends on your theme so just check that being logged in or not has the same behaviour with PageCache' mod='pagecache'}</li>
                    </ol>
                    <a href="#" class="okbtn" onclick="$('#pagecache_form_install').submit();return false;">{l s='OK, I validate this step' mod='pagecache'}</a> 
                    <a href="#" class="kobtn" onclick="$('#helpINSTALL_STEP_LOGGED_IN').toggle();return false;">{l s='No, I\'m having trouble' mod='pagecache'}</a>
                    <div class="stephelp" id="helpINSTALL_STEP_LOGGED_IN">
                        {if !$pagecache_skiplogged}
                            <ol>
                                <li>{l s='Make sure that module displaying user informations or sign in links are set as "dynamic".' mod='pagecache'}</li>
                                <li>{l s='Your theme may be uncompatible with this feature, specially if these informations are "hard coded" in theme without using a module. In this case just disable PageCache for logged in users.' mod='pagecache'}</li>
                            </ol>
                            <a href="#" class="browsebtn" onclick="$('#pagecache_disable_loggedin').val(1);$('#pagecache_form_install').submit();return false;">{l s='Disable cache for logged in users' mod='pagecache'}</a>
                        {else}
                            <ol>
                                <li>{l s='Still having problem? Then ' mod='pagecache'} <a href="{$contact_url|escape:'html'}" target="_blank">{l s='contact us here' mod='pagecache'}</a></li>
                            </ol>
                        {/if}
                    </div>
                </div>
                {/if}
            </div>

            {* EU_COOKIE STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_EU_COOKIE}stepok{elseif $cur_step < $INSTALL_STEP_EU_COOKIE}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_EU_COOKIE} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_EU_COOKIE}
                   <span>{$INSTALL_STEP_EU_COOKIE|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Check your european law module if any' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_EU_COOKIE}
                <div class="stepdesc">
                    <ol>
                        <li><a href="{$shop_link_debug|escape:'html'}" target="_blank">{l s='Click here to browse your site in test mode' mod='pagecache'}</a></li>
                        <li>{l s='Remove your cookies, reset the cache, then display a page' mod='pagecache'}</li>
                        <li>{l s='You should see the cookie law message; click to hide it' mod='pagecache'}</li>
                        <li>{l s='Reload the page, you should not see the message again' mod='pagecache'}</li>
                    </ol>
                    <a href="#" class="okbtn" onclick="$('#pagecache_form_install').submit();return false;">{l s='OK, I validate this step' mod='pagecache'}</a> 
                    <a href="#" class="kobtn" onclick="$('#helpINSTALL_STEP_EU_COOKIE').toggle();return false;">{l s='No, I\'m having trouble' mod='pagecache'}</a>
                    <div class="stephelp" id="helpINSTALL_STEP_EU_COOKIE">
                        <ol>
                            {if $smarty.const.lang_iso == 'fr'}
                                <li><a href="{$jpresta_proto|escape:'html'}{$jpresta_domain|escape:'html'}.com/fr/blog/le-message-d-information-pour-les-cookies-s-affiche-tout-le-temp-n4" target="_blank">{l s='Read this article' mod='pagecache'}</a> {l s='to know how to solve this issue' mod='pagecache'}
                            {else}
                                <li><a href="{$jpresta_proto|escape:'html'}{$jpresta_domain|escape:'html'}.com/en/blog/my-cookie-law-banner-module-always-display-n4" target="_blank">{l s='Read this article' mod='pagecache'}</a> {l s='to know how to solve this issue' mod='pagecache'}
                            {/if}
                        </ol>
                    </div>
                </div>
                {/if}
            </div>

            {* VALIDATE STEP *}
            <div class="step {if $cur_step > $INSTALL_STEP_VALIDATE}stepok{elseif $cur_step < $INSTALL_STEP_VALIDATE}steptodo{/if}">
                {if $cur_step > $INSTALL_STEP_VALIDATE} 
                   <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24" />
                {elseif $cur_step < $INSTALL_STEP_VALIDATE}
                   <span>{$INSTALL_STEP_VALIDATE|escape:'html'}</span>
                {else}
                   <img src="../modules/{$module_name|escape:'html'}/views/img/curstep.gif" alt="todo" width="24" height="24" />
                {/if}
                {l s='Push in production mode' mod='pagecache'}
                {if $cur_step == $INSTALL_STEP_VALIDATE}
                <div class="stepdesc">
                    <ol>
                        <li><a href="{$shop_link_debug|escape:'html'}" target="_blank">{l s='Click here to browse your site in test mode' mod='pagecache'}</a></li>
                        <li>{l s='You can do more tests and once your are ready...' mod='pagecache'}</li>
                    </ol>
                    <a href="#" class="okbtn" onclick="$('#pagecache_form_install').submit();return false;">{l s='Enable PageCache for my customers!' mod='pagecache'}</a> 
                    <a href="#" class="kobtn" onclick="$('#helpINSTALL_STEP_VALIDATE').toggle();return false;">{l s='No, I\'m having trouble' mod='pagecache'}</a>
                    <div class="stephelp" id="helpINSTALL_STEP_VALIDATE">
                        <ol>
                            <li>{l s='Make sure that the problem you have does not occur if you disable PageCache module' mod='pagecache'}</li>
                            <li>{l s='If your problem is only occuring with PageCache enabled, then' mod='pagecache'} <a href="{$contact_url|escape:'html'}" target="_blank">{l s='contact us here' mod='pagecache'}</a></li>
                        </ol>
                    </div>
                </div>
                {/if}
            </div>

            <div class="bootstrap actions">
                <button type="submit" value="1" onclick="$('#pagecache_install_step').val({$INSTALL_STEP_BUY_FROM|escape:'html'}); return true;" id="submitModuleRestartInstall" name="submitModuleRestartInstall" class="btn btn-default">
                    <i class="process-icon-cancel" style="color:red"></i> {l s='Restart from first step' mod='pagecache'}
                </button>
                <button type="submit" value="1" id="submitModuleClearCache" name="submitModuleClearCache" class="btn btn-default">
                    <i class="process-icon-delete" style="color:orange"></i> {l s='Clear cache' mod='pagecache'}
                </button>
            </div>

        </div>
    {else}
        <input type="hidden" name="pagecache_install_step" id="pagecache_install_step" value="{$INSTALL_STEP_BACK_TO_TEST|escape:'html'}"/>
        <div class="installstep">{l s='Congratulations!' mod='pagecache'} {$module_displayName|escape:'html'} {l s='is currently installed in' mod='pagecache'} <b>{l s='production mode' mod='pagecache'}</b>{if $pagecache_skiplogged}{l s=' for not logged in users' mod='pagecache'}{/if}{l s=', that means your site is now faster than ever!' mod='pagecache'}
        </div>
        <div class="installstep">{l s='If you are having trouble, ' mod='pagecache'}<a href="#" class="browsebtn" onclick="$('#pagecache_form_install').submit();return false;">{l s='go back to test mode' mod='pagecache'}</a></div>
        <div class="installstep">{l s='And now, what do I do?' mod='pagecache'}
            <ul>
                <li>{l s='Just enjoy the new speed of your store!' mod='pagecache'}</li>
                <li>{l s='Give us some feedback and' mod='pagecache'} <a href="{$rating_url|escape:'html'}" target="_blank"><img src="../modules/{$module_name|escape:'html'}/views/img/rating.png" alt="" style="vertical-align:baseline;padding: 0 0 0 4px;" width="16" height="16"/> {l s='rate the module and write a review' mod='pagecache'}</a></li>
                {if $smarty.const.lang_iso == 'fr'}
                    <li>{l s='Help or get help in ' mod='pagecache'} <a href="http://www.prestashop.com/forums/topic/280030-module-page-cache-boostez-votre-boutique/" target="_blank"><img src="../modules/{$module_name|escape:'html'}/views/img/forum.png" alt="" style="vertical-align:baseline;padding: 0 0 0 4px;" width="16" height="16"/> {l s='the PageCache forum thread' mod='pagecache'}</a></li>    
                    <li>{l s='You need to know more? Then you can read and comment ' mod='pagecache'} <a href="{$doc_proto|escape:'html'}{$doc_domain|escape:'html'}{$doc_url_fr|escape:'html'}" target="_blank"><img src="../modules/{$module_name|escape:'html'}/views/img/book.png" alt="" style="vertical-align:baseline;padding: 0 0 0 4px;" width="16" height="16"/> {l s='the online documentation' mod='pagecache'}</a></li>    
                {else}
                    <li>{l s='Help or get help in ' mod='pagecache'} <a href="http://www.prestashop.com/forums/topic/281654-module-page-cache-speedup-your-shop/" target="_blank"><img src="../modules/{$module_name|escape:'html'}/views/img/forum.png" alt="" style="vertical-align:baseline;padding: 0 0 0 4px;" width="16" height="16"/> {l s='the PageCache forum thread' mod='pagecache'}</a></li>    
                    <li>{l s='You need to know more? Then you can read and comment ' mod='pagecache'} <a href="{$doc_proto|escape:'html'}{$doc_domain|escape:'html'}{$doc_url_en|escape:'html'}" target="_blank"><img src="../modules/{$module_name|escape:'html'}/views/img/book.png" alt="" style="vertical-align:baseline;padding: 0 0 0 4px;" width="16" height="16"/> {l s='the online documentation' mod='pagecache'}</a></li>    
                {/if}
            </ul>
            <div class="bootstrap actions">
                <button type="submit" value="1" id="submitModuleClearCache" name="submitModuleClearCache" class="btn btn-default">
                    <i class="process-icon-delete" style="color:orange"></i> {l s='Clear cache' mod='pagecache'}
                </button>
            </div>
        </div>
    {/if}
    </div>
    {if isset($url_home)}
        {include file='./pagecache-speed-analyse.tpl'}
    {/if}
    </fieldset>
</form>