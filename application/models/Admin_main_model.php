<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class admin_main_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function loginCheck() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $query = $this->db->query("SELECT id,username,adsoyad FROM sys_users WHERE username=" . $this->db->escape($username) . " AND password='" . md5($password) . "'");
        if ($username != "") {
            if ($password != "") {
                if ($query->num_rows() == 1) {
                    echo '{"success":"true"}';

                    //Sessionları oluşturuyoruz..
                    $row = $query->row();
                    $sessions["user_id"] = $row->id;
                    $sessions["user_name"] = $row->username;
                    $sessions["user_adsoyad"] = $row->adsoyad;
                    $sessions["user_loggedIn"] = true;
                    $this->session->set_userdata($sessions);
                    
                    //Son Giriş Tarihini güncelliyoruz..
                    $this->db->query("UPDATE sys_users SET songiristarihi=NOW() WHERE id='".$row->id."'");
                   
                    
                } else {
                    echo '{"success":"false","msg":"' . lang("Kullanıcı adı ve şifreniz uyuşmuyor!") . '"}';
                }
            } else {
                echo '{"success":"false","msg":"' . lang("Kullanıcı adı giriniz!") . '"}';
            }
        } else {
            echo '{"success":"false","msg":"' . lang("Şifre giriniz!") . '"}';
        }
    }

    function isLoggedIn() {
        if (isset($this->session->userdata["user_loggedIn"])) {
            $loggedIn = $this->session->userdata["user_loggedIn"];
            if ($loggedIn == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    function languages() {
        $query = $this->db->query("SELECT * FROM sys_langs ORDER BY `order` ASC");
        return $query->result();
    }

    function setLang($language) {
        $query = $this->db->query("SELECT lang_name FROM sys_langs WHERE lang_short='" . $language[0] . "'");
        $row = $query->row();
        $this->session->set_userdata("user_lang", $row->lang_name);
    }

}

?>
