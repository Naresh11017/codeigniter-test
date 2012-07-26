<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings {

    public $CI;

    function __construct() {
        $this->CI = &get_instance();
    }

    /*
     * Ön tanımlı değişkenlerimizi ayarlıyoruz.. sys_config tablosu içerisindekileri
     */

    function setConstants() {
        //Ayarlar
        $query = $this->CI->db->query("SELECT * FROM sys_config");
        foreach ($query->result() as $row) {
            $this->CI->config->set_item($row->option_name, $row->option_value);
        }      
        
    }

}

?>
