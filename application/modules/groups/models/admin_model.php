<?php

class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Tum gruplara ait bilgileri ceker.
     * 
     * @return object
     */
    function getAllGroups()
    {
        $query = $this->db->get('sys_groups');
        return $query->result();
    }

    /**
     * Verilen gruba ait bilgileri ceker.
     * 
     * @param int $groupid
     * @return object
     */
    function getGroupById($groupid)
    {
        $query = $this->db->get_where('sys_groups', array('id' => $groupid));
        return $query->row();
    }
    
    /**
     * Yeni bir grup oluşturur.
     * 
     * @param array $group 
     */
    function addGroup($group)
    {
        //  ID auto-increment oldugu icin kendiliginden uretilecek
        unset($group['id']);
        $members = $group['members'];
        unset($group['members']);
        unset($group['non_members']);

        //  Create_date'i kendimiz veriyoruz
        $now = $this->db->query("SELECT NOW() now")->row()->now;
        $group['create_date'] = $now;
        
        $this->db->insert('sys_groups', $group);
        
        if($this->db->affected_rows() <= 0)
        {
            show_error("Veritabanına grup kaydı eklenmesi esnasında bir hata oluştu!");
        }

        $group['id'] = $this->db->insert_id();

        $this->deleteMembers($group['id']);

        if(is_array($members))
        {
            foreach($members as $userid)
            {
                $this->addMember($group['id'], $userid);
            }
        }
    }
    
    /**
     * Varolan bir grubun bilgilerini degistirir.
     * 
     * @param array $group 
     */
    function editGroup($group)
    {
        $members = $group['members'];
        unset($group['members']);
        unset($group['non_members']);
        
        if($this->db->update('sys_groups', $group, array("id" => $group['id'])) === FALSE)
        {
            show_error("Veritabanındaki grup kaydının düzenlenmesi esnasında bir hata oluştu!");
        }

        $this->deleteMembers($group['id']);

        if(is_array($members))
        {
            foreach($members as $userid)
            {
                $this->addMember($group['id'], $userid);
            }
        }
    }
    
    /**
     * Kullaniciyi siler.
     * 
     * @param int $groupid 
     */
    function deleteGroup($groupid)
    {
        if($this->db->delete('sys_groups', array('id' => $groupid)) === FALSE)
        {
            show_error("Veritabanından grup kaydının silinmesi esnasında bir hata oluştu!");
        }
    }

    /**
     * Gruba uye olan kullanicilarin bilgilerini getirir.
     *
     * @param int $groupid
     */
    function getMembers($groupid)
    {
        $this->db->select(array('sys_users.id','sys_users.username','sys_users.adsoyad'));
        $this->db->from('sys_subscriptions');
        $this->db->join('sys_users', 'sys_subscriptions.userid=sys_users.id', 'left');
        $this->db->where(array('sys_subscriptions.groupid' => $groupid));

        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Gruba uye olmayan kullanicilarin bilgilerini getirir.
     *
     * @param int $groupid
     */
    function getNonMembers($groupid)
    {
        $query = $this->db->query("
            SELECT sys_users.id, sys_users.username, sys_users.adsoyad
            FROM sys_users
            WHERE NOT EXISTS(
                SELECT 1
                FROM sys_subscriptions
                WHERE
                    sys_subscriptions.userid = sys_users.id
                    AND sys_subscriptions.groupid = ?
            )
        ", $groupid);

        return $query->result();
    }

    /**
     * Grubun tum uyelerini siler.
     *
     * @param int $groupid
     */
    function deleteMembers($groupid)
    {
        $this->db->delete('sys_subscriptions', array('groupid' => $groupid));
    }

    /**
     * Verilen kullaniciyi verilen gruba uye yapar.
     *
     * @param int $groupid
     * @param int $userid
     */
    function addMember($groupid, $userid)
    {
        $this->db->insert('sys_subscriptions', array('userid' => $userid, 'groupid' => $groupid));
    }
}