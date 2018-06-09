<?php
 class SDS_Features{
        
        static function sds_features_wrap_cb($atts = array(), $content = null, $tag, $hook_name){
            return '<div class="row clearfix sds_features_wrap">'.SmartShortCode::do_shortcode($content,$hook_name).'</div>';        
        }
        static function sds_feature_cb($atts = array(), $content = null, $tag, $hook_name){
            extract(SmartShortCode::shortcode_atts(array(
                'col' => '4',
                'iconsrc' => '',
                'iconclass' => '',
                'title' => '',
              ), $atts));
            $class = '';
            if(!empty($col) && is_numeric($col)){
                switch((int) $col){                    
                    case 6:
                        $class .= 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
                        break;
                    case 4:
                        $class .= 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
                        break;
                    case 3:
                        $class .= 'col-lg-3 col-md-3 col-sm-4 col-xs-12';
                        break;
                    default: 
                        $class .= 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                        break;
                }
            }
            
            $html = "<div class='{$class} sds_feature_col'>";
            
            if(!empty($iconclass)){            
                $html .= "<span class='sds_icon'><i class='{$iconclass}'></i></span>";            
            }elseif(!empty($iconsrc)){
                $html .= "<span class='sds_icon'><img src='{$iconsrc}' alt='{$title}' /></span>";
            }
            $html .= "<div class='sds_feature_content'>";
            $html .= "<h3>{$title}</h3>";
            $html .= "<div>".SmartShortCode::do_shortcode($content,$hook_name)."</div>";
            
            $html .= '</div></div>';
            
            return $html;
            
        }
    }

    SmartShortCode::add_shortcode('sds_features_wrap', array('SDS_Features','sds_features_wrap_cb'));
    SmartShortCode::add_shortcode('sds_feature', array('SDS_Features','sds_feature_cb'));