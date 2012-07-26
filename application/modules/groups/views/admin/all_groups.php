<?php
$this->load->helper('date_helper');
$this->load->helper('form_helper');
?>
<style type="text/css">
    #groupsTable{
        border-collapse: collapse;
        width: 100%;
    }
    #groupsTable td, #groupsTable th{
        border: 1px solid #EEEEEE;
    }
</style>
<script type="text/javascript">
    function deleteConfirm(id)
    {
        if(confirm(lang['Bu grubu silmek istediğinizden emin misiniz?'])){
            window.location = '<?php echo site_url('admin/groups/delete'); ?>/' + id;
        }
    }
</script>
<div class="block">
    <div class="head">
        <h3 style="float: left;"><?php echo lang("Gruplar") ?></h3>
        <div style="float:right;text-align: right; padding: 3px"><?php echo form_button('addUser', lang('Grup Ekle'), "onclick=\"window.location='".site_url('admin/groups/add')."'\" class='blue'") ?></div>
        <span style="clear:both">&nbsp;</span>
    </div>
    <div>
        <table id="groupsTable" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo lang("ID"); ?></th>
                    <th><?php echo lang("Grup Adı"); ?></th>
                    <th><?php echo lang("Oluşturma Tarihi"); ?></th>
                    <th><?php echo lang("Son Değişiklik Tarihi"); ?></th>
                    <th><?php echo lang("Düzenle"); ?></th>
                    <th><?php echo lang("Sil"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groups as $group): ?>
                    <tr>
                        <td><?php echo $group->id; ?></td>
                        <td><?php echo $group->groupname; ?></td>
                        <td><?php echo dateFormat($group->create_date,"long"); ?></td>
                        <td><?php echo dateFormat($group->update_date,"long"); ?></td>
                        <td><?php echo anchor("admin/groups/edit/".$group->id, 'Düzenle') ?></td>
                        <td><?php echo '<a href="javascript:void(0)" onclick="deleteConfirm(\''.$group->id.'\')">'.lang("Sil").'</a>'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo anchor('ci.sql'); ?>