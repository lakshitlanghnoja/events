<?php
$ci = $this->_ci;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrator Login</title>          
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">            
            <!-- Start CSS -->
                <?php echo add_css(array('stylesheet')); ?>  
                <?php echo add_js(array('jquery-1.9.1.min')); ?>  
                <script type="text/javascript">
                    function hide_msg(){
                        $('#error_msg').hide();
                    }    
                </script>
                </head>
                <body class="login-wrapper">

                    <div id="login-wrapper">
                        <?php //display content (the view) ?>
                        <?php echo $this->content(); ?>

                    </div>
                </body>
                </html>