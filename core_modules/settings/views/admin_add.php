<?php echo add_css('validationEngine.jquery'); ?>
<?php echo add_js(array('jquery-1.9.1.min', 'jqvalidation/languages/jquery.validationEngine-en', 'jqvalidation/jquery.validationEngine')); ?>

<div class="main-container">
    <div id="moduleMiddle" class="grid-data">
        <div class="add-new">
            <?php echo anchor(get_current_section($this).'/settings', lang('view-settings'), 'title="' . lang('view-settings') . '" style="text-align:center;width:100%;"'); ?>
        </div>
        <?php echo form_open(get_current_section($this)."/settings/save", array('id' => 'saveform', 'name' => 'saveform')); ?>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('add-edit-settings'); ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">

                        <table cellspacing="1" cellpadding="5" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td align="right"><span class="star">*&nbsp;</span><label for="setting_title"><?php echo lang('setting-title'); ?></label>:</td>
                                    <td>
                                        <?php
                                        $inputData = array(
                                            'name' => 'setting_title',
                                            'id' => 'setting_title',
                                            'value' => set_value('setting_title', htmlspecialchars_decode($setting_title)),
                                            'maxlength' => '100',
                                            'style' => 'width:198px',
                                            'class' => "validate[required]"
                                        );
                                        echo form_input($inputData);
                                        ?>
                                        <span class="validation_error"><?php echo form_error('setting_title'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><span class="star">*&nbsp;</span><label for="setting_label"><?php echo lang('setting-label'); ?></label>:</td>
                                    <td>
                                        <?php
                                        $inputData = array(
                                            'name' => 'setting_label',
                                            'id' => 'setting_label',
                                            'value' => set_value('setting_label', htmlspecialchars_decode($setting_label)),
                                            'maxlength' => '100',
                                            'style' => 'width:198px',
                                            'class' => "validate[required]"
                                        );
                                        echo form_input($inputData);
                                        ?>
                                        <span class="validation_error"><?php echo form_error('setting_label'); ?></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td align="right"><span class="star">*&nbsp;</span><label for="setting_value"><?php echo lang('setting-value'); ?></label>:</td>
                                    <td>
                                        <?php
                                        $inputData = array(
                                            'name' => 'setting_value',
                                            'id' => 'setting_value',
                                            'value' => set_value('setting_value', htmlspecialchars_decode($setting_value)),
                                            'maxlength' => '100',
                                            'style' => 'width:198px',
                                            'class' => "validate[required]"
                                        );
                                        echo form_input($inputData);
                                        ?>
                                        <span class="validation_error"><?php echo form_error('setting_value'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><label for="comment"><?php echo lang('setting-comment'); ?></label>:</td>
                                    <td>
                                        <?php
                                        $inputData = array(
                                            'name' => 'comment',
                                            'id' => 'comment',
                                            'value' => set_value('comment', htmlspecialchars_decode($comment)),
                                            'maxlength' => '100',
                                            'style' => 'width:198px'
                                        );
                                        echo form_input($inputData);
                                        ?>
                                    </td>
                                </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="submit-btns clearfix">
            <input type="hidden" id="id" name="id" value ="<?php echo (isset($id)) ? $id : '0'; ?>" />
            <?php
            $submit_button = array(
                'name' => 'saveSettings',
                'id' => 'saveSettings',
                'value' => 'Save',
                'title' => 'Save',
                'class' => 'inputbutton',
            );
            echo form_submit($submit_button);

            $cancel_button = array(
                'name' => 'button',
                'title' => lang('setting-cancel'),
                'class' => 'inputbutton',
                'onclick' => "location.href='" . site_url(get_current_section($this).'/settings') . "'"
            );
            echo "&nbsp;";
            echo form_button($cancel_button, lang('setting-cancel'));
            ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        jQuery("#saveform").validationEngine(
        {
            //promptPosition : '<?php echo VALIDATION_ERROR_POSITION; ?>',
            validationEventTrigger: "submit",
            'custom_error_messages': {
                // Custom Error Messages for Validation Types
                'required': {
                    'message': "<?php echo lang('required'); ?>"
                }
            }
        }
    );

    });
</script>