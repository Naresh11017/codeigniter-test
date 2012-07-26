<?php

class Admin extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->template = "admin";
        $this->load->model("admin_model");
        //  Olan bitenden haberimiz olsun
        $this->output->enable_profiler();        
    }

    function index()
    {
        $data['users'] = $this->admin_model->getAllUsers();
        $this->load->view('admin/all_users',$data);
    }
    
    function add()
    {
        $this->load->view('admin/edit_user');
    }
    
    function edit($args)
    {
        $username = isset($args[0])? $args[0] : NULL;
        $data['user'] = $this->admin_model->getUserByUsername($username);
        $this->load->view('admin/edit_user',$data);
    }
    
    function save()
    {
        //  'Validation' ya Rabbi..
        $this->load->library('form_validation');
        $id = $this->input->post('id');
        
        //  Kurallari belirliyoruz
        $this->form_validation->set_rules("id", lang("ID"), "");
        $this->form_validation->set_rules("username", lang("Kullanıcı Adı"), "required|alpha_dash");
        //  $id bossa, yani yeni kayit ekliyorsak sifre bos olamaz
        if(empty ($id))
        {
            $this->form_validation->set_rules("password", lang("Şifre"), "required");
        }
        else
        {
            $this->form_validation->set_rules("password", lang("Şifre"), "");
        }
        $this->form_validation->set_rules("password2", lang("Şifre (Tekrar)"), "matches[password]");
        $this->form_validation->set_rules("level", lang("Seviye"), "required|numeric");
        $this->form_validation->set_rules("adsoyad", lang("Ad Soyad"), "required");
        // TODO: Tarihleri kontrol etmek icin Form_validation'a valid_date metodu eklenecek..
        $this->form_validation->set_rules("uyeliktarihi", lang("Üyelik Tarihi"), "required");
        $this->form_validation->set_rules("songiristarihi", lang("Son Giriş Tarihi"), "required");
        $this->form_validation->set_rules("type", lang("Tip"), "required|numeric");
                
        //  Kos aslanim!
        if($this->form_validation->run())
        {
            //  Dogrulama basarili
            if(empty($id))
            {
                //  ID bos, INSERT yapilacak
                $this->admin_model->addUser($_POST);
            }
            else
            {
                //  ID dolu, UPDATE..
                $this->admin_model->editUser($_POST);
            }
            redirect('admin/users');
        }
        else
        {
            //  Dogrulama patladi! Tekrar forma gidiyoruz..
            $this->load->view('admin/edit_user');
        }
    }
    
    function delete($args)
    {
        $username = isset($args[0])? $args[0] : NULL;
        $this->admin_model->deleteUser($username);
        redirect('admin/users');
    }

}