<?php echo add_css('validationEngine.jquery'); ?>
<?php echo add_js(array('jqvalidation/languages/jquery.validationEngine-en', 'jqvalidation/jquery.validationEngine')); ?>

<noscript><div style="color: red; position: fixed; top:0; background:#ccc; width:100%; text-align: center; padding-top:5px; padding-bottom: 5px; font-size:16px;">This site requires javascript enabled</div></noscript>
<div class="login-form-box midway-vertical midway-horizontal">
    <div class="login-header">
<!--<a href="javascript:void(0)" title="Logo"><?php // echo add_image(array('logo.jpg')); ?></a>-->
        <?php echo add_image(array('logo.png')); ?>
    </div>
    <div class="login-form-content">
        <h2><?php echo lang('admin-login'); ?></h2>
        <!-- display messages  -->
        <?php echo $this->message(); ?>
        <?php echo form_open($this->_data['section_name']."/users/login", array('id' => 'login_form_inner', 'name' => 'login_form_inner')); ?>
        <div class="login-form">
            <?php
            $email_data = array(
                'name' => 'email',
                'id' => 'email',
                'value' => set_value('email', ""),
                'maxlength'   => '150',
                'value' => set_value('address', ((isset($email)) ? $email : '')),
                'class' => 'validate[required,custom[email]]'
            );
            $password_data = array(
                'name' => 'password',
                'id' => 'password',
                'value' => '',
                'maxlength'   => '50',
                'class' => 'validate[required]'
            );
            ?>
            <div class="login-form-field">
                <?php echo form_label('Email <span class="mandatory">*</span>', 'Email'); ?>
                <div class="input-box"><?php echo form_input($email_data); ?></div>
                <span class="warning-msg"><?php echo form_error('email'); ?></span>
            </div>
            <div class="login-form-field">
                <?php echo form_label('Password <span class="mandatory">*</span>', 'Password'); ?>
                <div class="password-box"><?php echo form_password($password_data); ?></div>
               <?php
               if(isset($back_url))
               {
                   echo form_hidden('back_url', $back_url);
               }
                ?>
                <span class="warning-msg"><?php echo form_error('password'); ?></span>
            </div>

        </div>
        <div class="login-bot clearfix">
            <div class="form-submit"><?php echo form_submit('Login', 'Login'); ?></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
            jQuery("#email").focus();
            jQuery("#login_form_inner").validationEngine(
            {promptPosition : 'centerTop',validationEventTrigger: "submit"}
        );
    });


</script>