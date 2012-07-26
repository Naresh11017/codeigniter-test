<?php $this->load->helper('form'); ?>
<style type="text/css">
    #groupDiv{
        width: 50%;
    }
    #groupTable, .dataGrid{
        width: 100%;
        border-collapse: collapse;
    }
    #groupTable th, #groupTable td, .dataGrid th, .dataGrid td{
        text-align: left;
        border: 1px solid #EEEEEE;
    }
</style>

<script type="text/javascript">
    function subscribe(link)
    {
        $(link).attr("onclick", "unsubscribe(this)");
        $(link).html("<?php echo lang("Çıkar"); ?>");
        $(link).siblings("input").attr("name", "members[]");
        var row = $(link).parent().parent().remove();
        row.appendTo("#members");
    }

    function unsubscribe(link)
    {
        $(link).attr("onclick", "subscribe(this)");
        $(link).html("<?php echo lang("Ekle"); ?>");
        $(link).siblings("input").attr("name", "non_members[]");
        var row = $(link).parent().parent().remove();
        row.appendTo("#non_members");
    }
</script>

<?php echo form_open('admin/groups/save', 'id="groupForm"', array('id' => @set_value("id", $group->id))); ?>

<div class="block" align="center">
    <div class="head"><h3><?php echo lang("Grup Bilgileri"); ?></h3></div>
    <div><?php echo validation_errors(); ?></div>
    <div id="groupDiv">
        <table id="groupTable" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th><?php echo lang("ID"); ?></th>
                    <td><?php echo @set_value("id", $group->id); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang("Grup Adı"); ?></th>
                    <td><?php echo form_input('groupname', @set_value("groupname", $group->groupname)); ?></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td style="text-align: right">
                        <?php echo form_button('submitBtn', 'Kaydet', "class='blue' onclick='$(\"#groupForm\").submit()'"); ?>
                        <?php echo form_button('backBtn', 'Vazgeç', "class='grey' onclick='window.location=\"" . site_url('admin/groups') . "\"'"); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="block" style="float: left; width: 490px; margin-top: 4px">
    <div class="head">
        <h3><?php echo lang("Gruba Kayıtlı Kullanıcılar"); ?></h3>
    </div>
    <table cellpadding="5" cellspacing="0" class="dataGrid">
        <thead>
            <tr>
                <th><?php echo lang("Kullanıcı Adı"); ?></th>
                <th><?php echo lang("Ad Soyad"); ?></th>
                <th><?php echo lang("Gruptan Çıkar"); ?></th>
            </tr>
        </thead>
        <tbody id="members">
            <?php if(is_array($members)): ?>
                <?php foreach($members as $member): ?>
                <tr>
                    <td><?php echo $member->username; ?></td>
                    <td><?php echo $member->adsoyad ?></td>
                    <td>
                        <?php echo form_hidden('members[]', $member->id)?>
                        <a href="javascript:void(0)" onclick="unsubscribe(this)"><?php echo lang("Çıkar"); ?></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="block" style="float: right; width: 490px; margin-top: 4px">
    <div class="head">
        <h3><?php echo lang("Gruba Kayıtlı Olmayan Kullanıcılar"); ?></h3>
    </div>
    <table cellpadding="5" cellspacing="0" class="dataGrid">
        <thead>
            <tr>
                <th><?php echo lang("Kullanıcı Adı"); ?></th>
                <th><?php echo lang("Ad Soyad"); ?></th>
                <th><?php echo lang("Gruba Ekle"); ?></th>
            </tr>
        </thead>
        <tbody id="non_members">
            <?php if(is_array($non_members)): ?>
                <?php foreach($non_members as $non_member): ?>
                <tr>
                    <td><?php echo $non_member->username; ?></td>
                    <td><?php echo $non_member->adsoyad ?></td>
                    <td>
                        <?php echo form_hidden('non_members[]', $non_member->id)?>
                        <a href="javascript:void(0)" onclick="subscribe(this)"><?php echo lang("Ekle"); ?></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php echo form_close(); ?>