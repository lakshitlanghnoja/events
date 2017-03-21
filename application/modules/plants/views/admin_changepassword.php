<?php echo add_css('validationEngine.jquery'); ?>
<?php echo add_js(array('jquery-1.9.1.min', 'jqvalidation/languages/jquery.validationEngine-en', 'jqvalidation/jquery.validationEngine')); ?>
<?php
$attributes = array('name' => 'forgot_password', 'id' => 'forgot_password');
$current_password_data = array(
    'name' => 'current_password',
    'id' => 'current_password',
    'maxlength' => '50',
    'value' => set_value('current_password',$cur_pass),
    "class" => "validate[required]"
);
$password_data = array(
    'name' => 'password',
    'id' => 'password',
     'maxlength' => '50',
    'value' => set_value('password', ""),
    "class" => "validate[required]"
);
$passconf_data = array(
    'name' => 'passconf',
    'id' => 'passconf',
     'maxlength' => '50',
    'value' => set_value('passconf', ""),
    "class" => "validate[required]"
);

echo form_open($this->_data['section_name']."/users/changepassword", $attributes);
?>
<table cellspacing="10" cellpadding="0">
       <tr>
           <td align="right" style="width: 300px;">
            <span class="star">*&nbsp;</span>
            <?php echo form_label(lang('current-password').':', 'password'); ?>
        </td>
        <td>
            <?php
            echo form_password($current_password_data);
            echo '<span class="validation_error">' . form_error('current_password') . '</span>';
            ?>
        </td>
    </tr>
<!--     <tr>
        <td height="20">&nbsp;</td>
    </tr>-->

    <tr>
        <td align="right">
        <span class="star">*&nbsp;</span>
            <?php echo form_label(lang('password') . ':', 'password'); ?>
        </td>
        <td>
            <?php echo form_password($password_data);
            echo '<span class="validation_error">' . form_error('password') . '</span>';
            ?>
        </td>
    </tr>
<!--    <tr>
        <td height="20">&nbsp;</td>
    </tr>-->
    <tr>
        <td align="right">
            <span class="star">*&nbsp;</span>
            <?php echo form_label(lang('c-password') . ':', 'passconf'); ?>
        </td>
        <td>
            <?php echo form_password($passconf_data);
            echo '<span class="validation_error">' . form_error('passconf') . '</span>';
            ?>
        </td>
    </tr>
    <tr>
        <td height="20">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" align="right">

        <?php
          $passconf_data = array(
              'name' => 'Submit',
              'id' => 'Submit',
              'value' =>'Submit',
              "class" => "inputbutton"
          );
          ?>

<?php echo form_submit($passconf_data); ?>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
<script type="text/javascript">
        $(document).ready(function() {
        jQuery("#current_password").focus();
    });

    $(document).ready(function() {
        //jQuery("#forgot_password").validationEngine();

        jQuery("#forgot_password").validationEngine(
                {
                    //promptPosition: '<?php echo VALIDATION_ERROR_POSITION; ?>',
                    validationEventTrigger: "submit"
                }
        );
    });
</script>