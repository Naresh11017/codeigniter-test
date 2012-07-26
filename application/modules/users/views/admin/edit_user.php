<?php $this->load->helper('form'); ?>
<style type="text/css">
    #userDiv{
        width: 50%;
    }
    #userTable{
        width: 100%;
        border-collapse: collapse;
    }
    #userTable th,td{
        text-align: left;
        border: 1px solid #EEEEEE;
    }
</style>
<div class="block" align="center">
    <div class="head"><h3><?php echo lang("Kullanıcı Bilgileri"); ?></h3></div>
    <div><?php echo validation_errors(); ?></div>
    <div id="userDiv">
        <?php echo form_open('admin/users/save', 'id="userForm"', array('id' => @set_value("id", $user->id))); ?>
        <table id="userTable" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th><?php echo lang("ID"); ?></th>
                    <td><?php echo @set_value("id", $user->id); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Kullanıcı Adı"); ?></th>
                    <td><?php echo form_input('username', @set_value("username", $user->username)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Şifre"); ?></th>
                    <td><?php echo form_password('password', ''); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Şifre (Tekrar)"); ?></th>
                    <td><?php echo form_password('password2', ''); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Seviye"); ?></th>
                    <td><?php echo form_input('level', @set_value("level", $user->level)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Ad Soyad"); ?></th>
                    <td><?php echo form_input('adsoyad', @set_value("adsoyad", $user->adsoyad)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Üyelik Tarihi"); ?></th>
                    <td><?php echo form_input('uyeliktarihi', @set_value("uyeliktarihi", $user->uyeliktarihi)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Son Giriş Tarihi"); ?></th>
                    <td><?php echo form_input('songiristarihi', @set_value("songiristarihi", $user->songiristarihi)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Tip"); ?></th>
                    <td><?php echo form_input('type', @set_value("type", $user->type)); ?></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td style="text-align: right">
                        <?php echo form_button('submitBtn', 'Kaydet', "class='blue' onclick='$(\"#userForm\").submit()'"); ?>
                        <?php echo form_button('backBtn', 'Vazgeç', "class='grey' onclick='window.location=\"" . site_url('admin/users') . "\"'"); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>