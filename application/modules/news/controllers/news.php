<?php

class news extends MY_Controller {

    function __construct() 
    {
        parent::__construct();
    }

    function index() 
    {
        $this->load->view("haberler");
    }
    
    function notemplate(){
        $this->template = NULL;
        $this->load->view("haberler");
    }

}

?>
