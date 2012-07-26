<?php

class admin extends MY_Controller {

   function __construct() {
      parent::__construct();
      $this->template="admin";
   }
   
   function index(){
      $this->load->view("admin/haberler");
   }

}
?>
