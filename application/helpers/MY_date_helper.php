<?php (defined('BASEPATH')) or exit('No direct script access allowed');

if (!function_exists('dateFormat'))
{
    /**
     * Date formatını türkçeye çevirir
     * 
     * @param string $date
     * @param type $type
     * @return string 
     */
    function dateFormat($date,$type="short")
    {
       if($type=="short"){
          return date("d/m/Y",strtotime($date));
       } 
       return date("d/m/Y H:i",strtotime($date));
       
    }
    
}