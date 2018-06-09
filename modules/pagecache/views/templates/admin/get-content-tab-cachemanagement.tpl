{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

{*
        //
        // Advanced cache management
        //
        if ($advanced_mode) {
            $distinct_module_list = array();
            foreach ($module_list as $hook_name => $modules) {
                foreach ($modules as $module) {
                    $distinct_module_list[$module['module']] = $module['id_module'];
                }
            }
            $options_array = array();
            $options = '<option value="">'.$this->l('Select to add an impacted module').'</option>';
            foreach ($distinct_module_list as $module => $id_module) {
                if (strcmp($this->name, $module) != 0) {
                    if (isset($instances[$id_module])) {
                        $options_array[Tools::strtolower(Tools::replaceAccentedChars($instances[$id_module]->displayName))] = '<option value="'.$module.'">'.$instances[$id_module]->displayName.'</option>';
                    } else {
                        $options_array[$module] = '<option value="'.$module.'">'.$module.'</option>';
                    }
                }
            }
            ksort($options_array);
            foreach ($options_array as $option) {
                $options .= $option;
            }
            $html .= '<script type="text/javascript">';
            $html .= 'function addModule(tr, trigered_event) {';
            $html .=     'if (tr.find("select").get(0).selectedIndex == 0) {alert("'.$this->l('Please select a module before').'");return;};';
            $html .=     'if ($("#"+tr.attr("id")+"_mods").val().indexOf(" "+tr.find("select").val()+" ") != -1) {alert("'.$this->l('This module is already in the list').'");return;};';
            $html .=     '$("#"+tr.attr("id")+"_mods").val($("#"+tr.attr("id")+"_mods").val()+" "+tr.find("select").val()+" ");';
            $html .=     'tr.find(".tags").append(\'<span class="tag"><img src="../modules/\'+tr.find("select").val()+\'/logo.gif" width="16" height="16" alt=""/>\'+tr.find("select option:selected").text()+\'<a href="#" onclick="removeModule($(this).parent(), \\\'\'+tr.find("select").val()+\'\\\', \\\'\'+trigered_event+\'\\\');return false"><img style="margin:0 0 0 3px" src="../img/admin/forbbiden.gif" alt=""/></a></span>\')';
            $html .= '}';
            $html .= 'function removeModule(tag, module, trigered_event) {';
            $html .=     '$("#"+trigered_event+"_mods").val($("#"+trigered_event+"_mods").val().replace(" "+module+" ", ""));';
            $html .=     'tag.fadeOut();';
            $html .= '}';
            $html .= '</script>';

            $html .= '<form id="pagecache_form_cachemanagement" action="'.Tools::htmlentitiesutf8(self::getServerValue('REQUEST_URI')).'" method="post">';
            $html .= '<fieldset class="cachemanagement pctab" id="cachemanagement" '.(Tools::getValue('pctab') == 'cachemanagement' ? '' : 'style="display:none"').'>';
            $html .= '<input type="hidden" name="submitModule" value="true"/>';
            $html .= '<input type="hidden" name="pctab" value="cachemanagement"/>';
            $html .= '<p>'.$this->l('Here you can customize how the cache will be refreshed when you do modifications in the backoffice.').'</p>';
            $html .= '<p>'.$this->l('Prestashop triggers events when you create, modify or delete something (a product, a category, a CMS page, etc.). In this table you can define which module must be updated on each event; for example the CMS block will be impacted "on new CMS" event. This will cause all pages with CMS block to be refreshed each time you create a new CMS page.').'</p>';
            $html .= '<p>'.$this->l('An other possibility is to refresh only pages that have a link on the modified or deleted object. For example, when you modify a product price, if some modules display a resume of this product on some pages these will be refreshed because they have a link to this product.').'</p>';
            $html .= '<div style="clear: both; padding-top:15px;">
                    <table cellspacing="0" cellspadding="0"><tr><th width="15%">'.$this->l('Event').'</th><th width="20%">'.$this->l('Impacts pages that link to it').'</th><th width="50%">'.$this->l('Impacted modules').'</th><th width="20%"></th></tr>';
            foreach($trigered_events as $key => $trigered_event) {
                $impacted_modules = Configuration::get($key.'_mods');
                $html .= '<tr id="'.$key.'">
                    <td><span title="'.$trigered_event['desc'].'">'.$trigered_event['title'].'</span><input type="hidden" name="'.$key.'_mods" id="'.$key.'_mods" value="'.$impacted_modules.'"/></td>
                    <td style="text-align:center">';
                if ($trigered_event['bl']) {
                    $html .= '<input type="checkbox" name="'.$key.'_bl" id="'.$key.'_bl" value="1" '. (Configuration::get($key.'_bl') ? 'checked' : '') .'></td>';
                }
                $html .= '<td class="tags">';
                    if ($impacted_modules) {
                        $impacted_modules = explode(' ', $impacted_modules);
                        foreach ($impacted_modules as $impacted_module) {
                            $impacted_module = trim($impacted_module);
                            if (Tools::strlen($impacted_module) > 0) {
                                if (isset($distinct_module_list[$impacted_module]) && isset($instances[$distinct_module_list[$impacted_module]])) {
                                    $html .= '<span class="tag"><img src="../modules/'.$impacted_module.'/logo.gif" width="16" height="16" alt=""/>'.$instances[$distinct_module_list[$impacted_module]]->displayName.'<a href="#" onclick="removeModule($(this).parent(), \''.$impacted_module.'\', \''.$key.'\');return false"><img style="margin:0 0 0 3px" src="../img/admin/forbbiden.gif" alt=""/></a></span>';
                                } else {
                                    $html .= '<span class="tag"><img src="../modules/'.$impacted_module.'/logo.gif" width="16" height="16" alt=""/>'.$impacted_module.'<a href="#" onclick="removeModule($(this).parent(), \''.$impacted_module.'\', \''.$key.'\');return false"><img style="margin:0 0 0 3px" src="../img/admin/forbbiden.gif" alt=""/></a></span>';
                                }
                            }
                        }
                    }
                    $html .= '</td>
                    <td style="white-space:nowrap"><select>'.$options.'</select><a href="#" onclick="addModule($(this).parent().parent(), \''.$key.'\');return false"><img style="margin:3px" src="../img/admin/add.gif" alt=""/></a></td>
                </tr>';
            }
            $html .= '</table></div>';
            $html .= '<br/><br/><div class="bootstrap">
                    <button type="submit" value="1" id="submitModuleCacheManagement" name="submitModuleCacheManagement" class="btn btn-default pull-right">
                        <i class="process-icon-save"></i> '.$this->l('Save').'
                    </button>
                  </div></fieldset></form>';
        }
        $html .="</div>";

        return $html;
*}