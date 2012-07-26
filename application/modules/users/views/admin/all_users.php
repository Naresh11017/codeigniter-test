<?php
$this->load->helper('date_helper');
$this->load->helper('form_helper');
?>
<style type="text/css" >
    #usersTable{
        border-collapse: collapse;
        width: 100%;
    }
    #usersTable td, #usersTable th{
        border: 1px solid #EEEEEE;
    }
</style>
<script type="text/javascript" >
    function deleteConfirm(username)
    {
        if(confirm(lang['Bu kullanıcıyı silmek istediğinizden emin misiniz?'])){
            window.location = '<?php echo site_url('admin/users/delete'); ?>/' + username;
        }
    }
</script>
<div class="block">
    <div class="head">
        <h3 style="float: left;"><?php echo lang("Kullanıcılar") ?></h3>
        <div style="float:right;text-align: right; padding: 3px"><?php echo form_button('addUser', lang('Kullanıcı Ekle'), "onclick=\"window.location='".site_url('admin/users/add')."'\" class='blue'") ?></div>
        <span style="clear:both">&nbsp;</span>
    </div>
    <div>
        <table id="usersTable" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo lang("ID"); ?></th>
                    <th><?php echo lang("Kullanıcı Adı"); ?></th>
                    <th><?php echo lang("Seviye"); ?></th>
                    <th><?php echo lang("Ad Soyad"); ?></th>
                    <th><?php echo lang("Üyelik Tarihi"); ?></th>
                    <th><?php echo lang("Son Giriş Tarihi"); ?></th>
                    <th><?php echo lang("Tip"); ?></th>
                    <th><?php echo lang("Düzenle"); ?></th>
                    <th><?php echo lang("Sil"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->level; ?></td>
                        <td><?php echo $user->adsoyad; ?></td>
                        <td><?php echo dateFormat($user->uyeliktarihi); ?></td>
                        <td><?php echo dateFormat($user->songiristarihi); ?></td>
                        <td><?php echo $user->type; ?></td>
                        <td><?php echo anchor("admin/users/edit/".$user->username, 'Düzenle') ?></td>
                        <td><?php echo '<a href="javascript:void(0)" onclick="deleteConfirm(\''.$user->username.'\')">'.lang("Sil").'</a>'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>