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
        $data['groups'] = $this->admin_model->getAllGroups();
        $this->load->view('admin/all_groups',$data);
    }
    
    function add()
    {
        $this->edit(array(0));
    }
    
    function edit($args)
    {
        $group = isset($args[0])? $args[0] : NULL;
        $data['group'] = $this->admin_model->getGroupById($group);
        $data['members'] = $this->admin_model->getMembers($group);
        $data['non_members'] = $this->admin_model->getNonMembers($group);
        $this->load->view('admin/edit_group',$data);
    }
    
    function save()
    {
        $this->load->library('form_validation');
        $id = $this->input->post('id');
        
        //  Kurallari belirliyoruz
        $this->form_validation->set_rules("id", "ID", "numeric");
        $this->form_validation->set_rules("groupname", "Grup Adı", "required");

        //  Kos aslanim!
        if($this->form_validation->run())
        {
            //  Dogrulama basarili
            if(empty($id))
            {
                //  ID bos, INSERT yapilacak
                $this->admin_model->addGroup($_POST);
            }
            else
            {
                //  ID dolu, UPDATE..
                $this->admin_model->editGroup($_POST);
            }
            redirect('admin/groups');
        }
        else
        {
            //  Dogrulama patladi! Tekrar forma gidiyoruz..
            $data['members'] = $this->admin_model->getMembers($id);
            $data['non_members'] = $this->admin_model->getNonMembers($id);
            $this->load->view('admin/edit_group',$data);
        }
    }
    
    function delete($args)
    {
        $groupid = isset($args[0])? $args[0] : NULL;
        $this->admin_model->deleteGroup($groupid);
        redirect('admin/groups');
    }

}