<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrator</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
            <!-- Start CSS -->
            <?php echo add_css(array('stylesheet')); ?>
            <!-- End CSS -->
            <!-- Start Script -->
            <?php echo add_js(array('jquery-1.9.1.min','jquery.blockUI', 'jqvalidation/languages/jquery.validationEngine-en', 'jqvalidation/jquery.validationEngine','ddaccordion','common')); ?>
            <?php echo add_css('validationEngine.jquery'); ?>

            <!-- End Script -->
            <!-- Start Script -->
            <script type="text/javascript">
                ddaccordion.init({
                    headerclass: "expandable", //Shared CSS class name of headers group that are expandable
                    contentclass: "left-subnav", //Shared CSS class name of contents group
                    revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
                    mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
                    collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
                    defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
                    onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
                    animatedefault: false, //Should contents open by default be animated into view?
                    persiststate: true, //persist state of opened contents within browser session?
                    toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
                    togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
                    animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
                    oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                        //do nothing
                    },
                    onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                        //do nothing
                    }
                });

                //Function to hide message
                function hide_msg(){
                    $('#error_msg').hide();
                    ///$('#error_msg').remove();
                }

            </script>
            <!--Accordion Jquery -->
            <!-- Start Meta content -->
            <!-- meta name="bug.blocked" content="15476" -->
            <!-- End Meta content-->
    </head>
    <body>
        <noscript><div style="color: red; position: fixed; top:0; background:#ccc; width:100%; text-align: center; padding-top:5px; padding-bottom: 5px; font-size:16px;">This site requires javascript enabled</div><br>
        </noscript>
        <div id="wrapper">
            <div class="header clearfix">
                <h1 class="logo"><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/users" title="Logo"><?php echo add_image(array('logo.jpg')); ?></a></h1>
                <div class="welcome">
                    <a class="logout" href="<?php echo site_url().$ci->theme->get('section_name'); ?>/users/logout" title="Logout"><?php echo add_image(array('logout.png')); ?></a><p class="welcome-text">Welcome, <span><?php echo $ci->session->userdata[$ci->theme->get('section_name')]['firstname']; ?></span>&nbsp;|&nbsp;<a class="logout" href="<?php echo site_url().$ci->theme->get('section_name'); ?>/users/changepassword" title="Change Password">Change Password</a></p> <?php echo add_image(array('user_icon.png')); ?></div>
            </div>
            <div id="menu" class="navigation">

                <?php

                //echo buildMenu(0, $menu_data['menu']);
                widget('menu', array('menu_name' => 'admin_menu','section_name'=>$ci->theme->get('section_name')));
                ?>
                <?php if ($ci->config->config['multilang_option'] == 1) { ?>
                <span style="float:right;margin-top:8px">
                    <label style="color:#fff;font-size: 13px; font-weight: bold;">Language:</label> &nbsp;
                    <div style="float:right"><?php widget('language',array('section_name'=>$ci->theme->get('section_name'))); ?></div>
                </span>
                <?php  } ?>
            </div>
            <div class="content clearfix">
                <table class="main-content-table" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="201px" class="left-sidebar" valign="top">
                            <div class="left-menu">
				<ul class="clearfix">
                                    <li class="<?php echo $ci->uri->segment(2)=='users'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/users" title="User Management">User</a></li>
                                    <li class="<?php echo $ci->uri->segment(2)=='cms'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/cms" title="CMS Management">CMS</a></li>
                                    <li class="<?php echo $ci->uri->segment(2)=='urls'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/urls" title="URL Management">URL</a></li>
                                    <li class="<?php echo $ci->uri->segment(2)=='permissions'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/permissions" title="Permissions">Permissions</a></li>
                                    <li class="<?php echo $ci->uri->segment(3)=='permission_matrix'?'':$ci->uri->segment(2)=='roles'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/roles" title="Roles">Roles</a></li>
                                    <li class="<?php echo $ci->uri->segment(3)=='permission_matrix'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/roles/permission_matrix" title="Permission Matrix">Permission Matrix</a></li>
                                    <li class="<?php echo $ci->uri->segment(2)=='modulebuilder'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/modulebuilder/generate_module" title="Module Builder">Module Builder</a></li>
                                    <li class="<?php echo $ci->uri->segment(2)=='plants'?'selected':'';?>" ><a href="<?php echo site_url().$ci->theme->get('section_name'); ?>/plants" title="Plants">Plants</a></li>
                                 </ul>
                            </div>
                        </td>
                        <td valign="top">
                            <div class="main-content">
                                <div class="main-content-top">
                                    <?php echo $ci->breadcrumb->output(); ?>
                                    <?php if(isset($page_title)){ ?>
                                        <div class="page-title"><h1><?php echo $page_title; ?></h1></div>
                                    <?php } ?>
                                </div>
                                <!-- set success/error messages -->
                                <div id="messages" style="display:<?php echo (($ci->theme->message() == '') ? 'none' : ''); ?>;">
                                    <?php echo $ci->theme->message(); ?>
                                </div>
