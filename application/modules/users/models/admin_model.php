<?php

class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Tum kullanicilara ait bilgileri ceker.
     * 
     * @return object
     */
    function getAllUsers()
    {
        $query = $this->db->get('sys_users');
        return $query->result();
    }

    /**
     * Verilen kullanici adina ait bilgileri ceker.
     * 
     * @param string $username
     * @return object
     */
    function getUserByUsername($username)
    {
        $query = $this->db->get_where('sys_users', array('username' => $username));
        return $query->row();
    }
    
    /**
     * Yeni bir kullanıcı oluşturur.
     * 
     * @param array $user 
     */
    function addUser($user)
    {
        //  ID auto-increment oldugu icin kendiliginden uretilecek
        unset($user['id']);
        //  password2 veritabanina gitmeyecek
        unset($user['password2']);
        //  password varsa md5'lenecek
        if(!empty($user['password']))
        {
            $user['password'] = md5($user['password']);
        }
        else
        {
            unset($user['password']);
        }

        $this->db->insert('sys_users', $user);
        
        if($this->db->affected_rows() <= 0)
        {
            show_error("Veritabanına kullanıcı kaydı eklenmesi esnasında bir hata oluştu!");
        }
    }
    
    /**
     * Varolan bir kullanicinin bilgilerini degistirir.
     * 
     * @param array $user 
     */
    function editUser($user)
    {
        //  password2 veritabanina gitmeyecek
        unset($user['password2']);
        //  password varsa md5'lenecek
        if(!empty($user['password']))
        {
            $user['password'] = md5($user['password']);
        }
        else
        {
            unset($user['password']);
        }
        
        if($this->db->update('sys_users', $user, array("id" => $user['id'])) === FALSE)
        {
            show_error("Veritabanındaki kullanıcı kaydının düzenlenmesi esnasında bir hata oluştu!");
        }
    }
    
    /**
     * Kullaniciyi siler.
     * 
     * @param string $username 
     */
    function deleteUser($username)
    {
        if($this->db->delete('sys_users', array('username' => $username)) === FALSE)
        {
            show_error("Veritabanından kullanıcı kaydının silinmesi esnasında bir hata oluştu!");
        }
    }

}