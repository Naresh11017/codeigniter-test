<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<div id="menu">
   <ul id="qm0" class="qmmc">
      <li><a class="qmparent" href="<?=base_url()?>admin/dashboard"><img alt="<?php echo lang("Anasayfa") ?>" src="images/home.png"></a></li>
      <li><a class="qmparent" href="<?=base_url()?>admin/account"><?php echo lang("Profilim") ?></a></li>
      <li><a class="qmparent" href="<?=base_url()?>admin/config"><?php echo lang("Ayarlar") ?></a></li>
      <li><a class="qmparent" href="<?=base_url()?>admin/users"><?php echo lang("Kullanıcılar") ?></a></li>
      <li><a class="qmparent" href="<?=base_url()?>admin/groups"><?php echo lang("Gruplar") ?></a></li>
</ul>
</div>
<div style="clear: both"></div>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click (options: 'all' * 'all-always-open' * 'main' * 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>

<div id="submenu">
   
</div>
