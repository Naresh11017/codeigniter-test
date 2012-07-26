<?php (defined('BASEPATH')) or exit('No direct script access allowed');

if (!function_exists('template_url'))
{
    /**
     * Verilen template ile ilgili (css, js, resim) vs.
     * icerigi barindiran klasorun url'sini doner.
     * 
     * @param type $template_name
     * @param type $uri
     * @return type 
     */
    function template_url($template_name = 'site', $uri = '')
    {
        $CI = & get_instance();
        $new_uri = ($template_name=="admin") ? "/themes/".$template_name : "/themes/".$CI->config->item("site_theme");
        if ($uri != '')
        {
            $new_uri .= '/'.$uri;
        }
        return $CI->config->base_url($new_uri).'/';
    }

}