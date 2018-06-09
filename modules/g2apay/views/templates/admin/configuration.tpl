{*
* @author      G2A Team
* @copyright   Copyright (c) 2016 G2A.COM
* @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*}
<div class="row">
    <div class="g2a_pay">
        <img src="{$base_url|escape:'htmlall':'UTF-8'}modules/{$module_name|escape:'htmlall':'UTF-8'}/views/img/logo_big.png" alt="G2A Pay">
        <div class="title">All-in-one solution with <strong>100+</strong> global and local payment methods</div>

        <div class="blocks">
            <div class="block">
                <div class="img">
                    <img src="{$base_url|escape:'htmlall':'UTF-8'}modules/{$module_name|escape:'htmlall':'UTF-8'}/views/img/0eur.png" alt="0 EUR">
                </div>
                <div class="desc">No monthly charges,<br> no set up cost</div>
            </div>
            <div class="block second">
                <div class="img">
                    <img src="{$base_url|escape:'htmlall':'UTF-8'}modules/{$module_name|escape:'htmlall':'UTF-8'}/views/img/pp.png" alt="Payment methods">
                </div>
                <div class="desc">2.49% + 0.30 EUR for the  most <br> popular payment methods. </div>
            </div>
            <div class="block">
                <div class="img">
                    <img src="{$base_url|escape:'htmlall':'UTF-8'}modules/{$module_name|escape:'htmlall':'UTF-8'}/views/img/dtm.png" alt="Desktop, tablet & mobile">
                </div>
                <div class="desc">Desktop, tablet <br> & mobile covered</div>
            </div>
        </div>
        <div class="buttons">
            <a target="_blank" href="https://pay.g2a.com/contact" class="btn"><img src="{$base_url|escape:'htmlall':'UTF-8'}modules/{$module_name|escape:'htmlall':'UTF-8'}/views/img/mail_icon.png" alt="Email"> SEND US AN EMAIL</a>
            <a onclick="window.open('https://livechat.g2a.com/chatserver/chatwindow.aspx?planId=341&siteId=1000086&pageTitle=G2A%20Pay&pageUrl=https%3A%2F%2Fpay.g2a.com%2Fintegrate&newurl=1&r=5&embInv=0&dirChat=0&guid=','wsa_2681_501','height=700,width=700')" href="#" class="btn"><img src="{$base_url|escape:'htmlall':'UTF-8'}modules/{$module_name|escape:'htmlall':'UTF-8'}/views/img/chat_icon.png" alt="Chat"> 24/7 LIVE CHAT FOR MERCHANTS</a>
        </div>
    </div>
</div>
{$form}
<div class="row">
    <div class="col-lg-12">
        <p>{l s='Your IPN url:' mod='g2apay'} <em>{$ipn_url|escape:'htmlall':'UTF-8'}</em></p>
    </div>
</div>

