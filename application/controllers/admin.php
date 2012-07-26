<?php

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->template = "admin";
        (!$this->session->userdata("user_lang")) ? $this->session->set_userdata("user_lang", $this->config->item("yonetim_language")) : "";
    }

    function index() {
        $this->login();
    }

    function login() {
        $this->template = "none";

        //Giriş Yaptıysa admin anasayfasına yönlendiriyoruz..
        $this->load->model("admin_main_model");
        ($this->admin_main_model->isLoggedIn() == true) ? redirect(base_url() . "admin/dashboard") : "";
        $data["data"] = $this->admin_main_model->languages();
        $this->load->view("admin/login", $data);
    }

    function loginCheck() {
        $this->template = "none";
        $this->load->model("admin_main_model");
        $this->admin_main_model->loginCheck();
    }

    function dashboard() {
        $this->load->model("admin_main_model");
        ($this->admin_main_model->isLoggedIn() == false) ? redirect(base_url() . "admin/") : "";
        $this->load->view("admin/dashboard");
    }

    function logout() {
        $this->session->unset_userdata("user_name");
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_adsoyad");
        $this->session->unset_userdata("user_loggedIn");
        redirect(base_url() . "admin");
    }

    function lang($language) {
        $this->load->model("admin_main_model");
        $this->admin_main_model->setLang($language);
        redirect(base_url() . "admin/dashboard");
    }

}

?>
