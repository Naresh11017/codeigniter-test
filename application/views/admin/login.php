<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

/* Dil Dosyamızı yüklüyoruz
 * ilk parametre admin_lang.php dosyasının yükleneceği gösteriyor.. ikinci parametre ise dili temsil ediyor..
 */
$this->lang->load("admin", $this->session->userdata["user_lang"]);
$this->load->helper("form");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?php echo $this->config->item("site_title") ?></title>
    <meta name="author" content="<?php echo $this->config->item("site_author") ?>">
    <meta name="description" content="<?php echo $this->config->item("site_description") ?>">
    <meta name="keywords" content="<?php echo $this->config->item("site_keywords") ?>">
    <base href="<?php echo template_url('admin'); ?>">
    <link type="text/css" rel="stylesheet" href="css/default.css"/>
    <script type="text/javascript" src="js/jsfile.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/custom.js"></script>
    <script type="text/javascript" src="<?php echo base_url().APPPATH ?>language/<?php echo $this->session->userdata["user_lang"] ?>/lang.js"></script>
    <script type="text/javascript">
   
        var pageUrl='<?= base_url() ?>';
        $(function(){
            $('#username,#password').keypress(function(e){
                if(e.which == 13){
                    loginSubmit();
                }
            });
 
        });

        function formReset(){
            document.getElementById("loginForm").reset();
            $("#result").html("");
        }

        function loginSubmit(){
      
            if($("#username").val()==""){
                $("#result").html(resultFormat("warning",lang["Kullanıcı Adı Giriniz!"]));
                return false;
            }
            if($("#password").val()==""){
                $("#result").html(resultFormat("warning","Şifre Giriniz!"));
                return false;
            }
         
            $("#result").html(resultFormat("pending","Sorgulanıyor..."));   
            $.ajax({
                type:'POST',
                url:pageUrl+'admin/loginCheck',
                data: $("#loginForm").serialize(),
                dataType:'json',
                success:function(respond){  
                    if(respond.success=="true"){
                        document.getElementById("loginForm").reset();
                        $("#result").html(resultFormat("success","Başarıyla Giriş Yapıldı.. Yönlendiriliyorsunuz...."));
                        setTimeout("window.location='"+pageUrl+"admin/dashboard'",1000);
                    }else if (respond.success=="false") {
                        $("#result").html(resultFormat("alert","Kullanıcı adı ile şifreniz uyumsuz! Tekrar deneyiniz.."));
                    }
                }
            });  
        }
   
    </script>
</head>
<body>
<div id="header">
    <div id="wrapper">
        <div id="user">
            <img src="images/user/userPic.png"> 
            <span><?php echo lang("Hoşgeldiniz") ?>!</span>
        </div>
        <div id="topmenu">
            <ul>
                <?php foreach ($data as $row) : ?>
                    <li><a href="<?php echo base_url() ?>admin/lang/<?php echo $row->lang_short ?>"><img src="images/lang/<?php echo $row->lang_short ?>.png"><span><?php echo $row->lang_description ?></span></a></li>
                <?php endforeach; ?>
                <li><a href="<?php echo base_url() ?>"><img src="images/topnav/mainWebsite.png"><span><?php echo lang("Siteye Dön") ?></span></a></li>
                <li><a href="<?php echo base_url() ?>admin/help"><img src="images/topnav/help.png"><span><?php echo lang("Yardım") ?></span></a></li>
            </ul>
        </div>
    </div>
</div> 
<div id="content">
    <div align="center">
        <div class="block" style="width:500px; margin-top:40px; text-align: left">
            <div class="head"><h3><?php echo lang("Yönetici Girişi"); ?></h3></div>
            <div style="width:130px; float:left; padding:10px;">
                <img src="images/user/users.png"/>   
            </div>
            <div style="padding:10px; float:left; width: 330px;">
                <?php echo form_open("", array("name" => "loginForm", "id" => "loginForm")); ?>
                <table width="100%" cellpadding="4" class="formTable">
                    <tr>
                        <td>
                            <span class="smalldesc"><?php echo lang("login_form_aciklama") ?></span>
                    <div id="result" style="margin-top:5px;"></div>
                    </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid #EEEEEE; padding-bottom:5px;"><?php echo form_label(lang("Kullanıcı Adı") . ":", "username") ?>
                            <?php echo form_input(array("id" => "username", "name" => "username", "style" => "width:180px; padding-left:25px; background:url(images/user/user-login.png) no-repeat")); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid #EEEEEE; padding-bottom:5px;"><?php echo form_label(lang("Şifre") . ":", "password") ?>
                            <?php echo form_password(array("id" => "password", "name" => "password", "style" => "width:180px; padding-left:25px; background:url(images/user/user-password.png) no-repeat")); ?>
                        </td>
                    </tr>
                    <tr>
                        <td> 
                            <?php echo form_button(array("name" => "login", "content" => lang("Giriş Yap"), "class" => "blue", "style" => "width:135px;"), "", "onclick='loginSubmit()'") ?>
                            <?php echo form_button(array("name" => "resett", "content" => lang("Temizle"), "class" => "grey", "style" => "width:72px;"), "", "onclick='this.form.reset()'") ?>
                        </td>
                    </tr>
                </table>
                <?php echo form_close() ?>
            </div>
            <div class="fix"></div>
        </div>
        <div style="font-size:11px; padding:5px; color:#666666;"> <?php echo lang("Tüm Hakları Saklıdır") ?> &copy; 2011-<?= date("Y") ?> </div>
    </div>
</div>
</body>
</html>
