{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<script type="text/javascript">
    var slidersServer = [];
    var slidersBrowser = [];
    function onSliderChange(value, controller) {
        switch (value) {
            case 0:
                text = "{l s='Disabled' mod='pagecache'}";
                break;
            case 1:
                text = "{l s='1 day' mod='pagecache'}";
                break;
            case 10:
                text = "{l s='To infinity...' mod='pagecache'}";
                break;
            case 8:
                value = 14;
                text = value + " {l s='days' mod='pagecache'}";
                break;
            case 9:
                value = 30;
                text = value + " {l s='days' mod='pagecache'}";
                break;
            default:
                text = value + " {l s='days' mod='pagecache'}";
                break;
        }
        $("#pc"+controller+"SliderVal").text(text);
        if (value === 0) {
            // ULTIMATE
            if (slidersBrowser[controller]) { slidersBrowser[controller].setValue(0); onBrowserSliderChange(0, controller+"2"); slidersBrowser[controller].disable(); }
            // ULTIMATE£
            $("#pc"+controller).parent().find(".slider-handle").css("background-color", "gray").css("background-image", "none");
        }
        else {
            // ULTIMATE
            if (slidersBrowser[controller]) slidersBrowser[controller].enable();
            // ULTIMATE£
            $("#pc"+controller).parent().find(".slider-handle").css("background-image", "linear-gradient(to bottom,#149bdf 0,#0480be 100%);");
        }
    }
    function onBrowserSliderChange(value, controller) {
        switch (value) {
            case 0:
                text = "{l s='Disabled' mod='pagecache'}";
                break;
            default:
                text = value + " {l s='minutes' mod='pagecache'}";
                break;
        }
        $("#pc"+controller+"SliderVal").text(text);
        if (value === 0) {
            $("#pc"+controller).parent().find(".slider-handle").css("background-color", "gray").css("background-image", "none");
        }
        else {
            $("#pc"+controller).parent().find(".slider-handle").css("background-image", "linear-gradient(to bottom,#149bdf 0,#0480be 100%);");
        }
    }
$( document ).ready(function() {
    {foreach $managed_controllers as $controller_name => $controller}
        slidersServer["{$controller_name|escape:'javascript'}"] = new Slider('#pc{$controller_name|escape:'javascript'}');
        slidersServer["{$controller_name|escape:'javascript'}"].setValue({$controller['timeout']|default:'0'});
        {*ULTIMATE*}
        slidersBrowser["{$controller_name|escape:'javascript'}"] = new Slider('#pc{$controller_name|escape:'javascript'}2');
        slidersBrowser["{$controller_name|escape:'javascript'}"].setValue({$controller['expires']|default:'0'});
        {*ULTIMATE£*}
        onSliderChange({$controller['timeout']|escape:'html'|default:'0'}, "{$controller_name|escape:'javascript'}");
        {*ULTIMATE*}
        onBrowserSliderChange({$controller['expires']|escape:'html'|default:'0'}, "{$controller_name|escape:'javascript'}2");
        {*ULTIMATE£*}
        $("#pc{$controller_name|escape:'javascript'}").on("change", function(slideEvt) { onSliderChange(slideEvt.value.newValue, "{$controller_name|escape:'javascript'}"); });
        {*ULTIMATE*}
        $("#pc{$controller_name|escape:'javascript'}2").on("change", function(slideEvt) { onBrowserSliderChange(slideEvt.value.newValue, "{$controller_name|escape:'javascript'}2"); });
        {*ULTIMATE£*}
    {/foreach}
});
</script>
<form id="pagecache_form_timeouts" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="timeouts"/>
    <fieldset>
        <div style="clear: both; padding-top:15px;">
            <table>
            {foreach $managed_controllers as $controller_name => $controller}
                <tr class="first">
                    <td class="label">{$controller['title']|escape:'html'}</td>
                    <td>{l s='Server cache maximum duration' mod='pagecache'}:</td><td class="slider"><input id="pc{$controller_name|escape:'html'}" name="pagecache_{$controller_name|escape:'html'}_timeout" style="padding: 0 10px;" type="text" data-slider-ticks="[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]" data-slider-value="{$controller['timeout']|escape:'html'}" data-slider-tooltip="hide" data-slider-handle="square"/>&nbsp;<span id="pc{$controller_name|escape:'html'}SliderVal" style="font-weight:bold"></span></td>
                </tr>
                {*ULTIMATE*}
                <tr>
                    <td></td>
                    <td>{l s='Browser cache duration' mod='pagecache'}:</td><td class="slider"><input id="pc{$controller_name|escape:'html'}2" name="pagecache_{$controller_name|escape:'html'}_expires" style="padding: 0 10px;" type="text" data-slider-ticks="[0, 15, 30, 45, 60]" data-slider-value="{$controller['expires']|escape:'html'}" data-slider-tooltip="hide" data-slider-ticks-snap-bounds="3" data-slider-handle="square"/>&nbsp;<span id="pc{$controller_name|escape:'html'}2SliderVal" style="font-weight:bold"></span></td>
                </tr>
                {*ULTIMATE£*}
            {/foreach}
            </table>
        </div>
        <div class="bootstrap">
            <button type="submit" value="1" id="submitModuleTimeouts" name="submitModuleTimeouts" class="btn btn-default pull-right">
                <i class="process-icon-save"></i> {l s='Save' mod='pagecache'}
            </button>
        </div>
    </fieldset>
</form>