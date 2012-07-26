<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Site Template</title>
        <base href="<?php echo template_url();?>">
        <script src="js/jsfile.js"></script>
    </head>
    <body>
       <div style="background:#EEEEEE; padding:10px;">Header</div>
        <?php
            echo $module_output;
        ?>
       <div style="background:#EEEEEE; padding:10px;">Footer</div>
    </body>
</html>
