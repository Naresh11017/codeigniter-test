<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->template="admin";
    }
    
    function index(){
        $this->load->view("admin/ayarlar");
    }

}

?>
