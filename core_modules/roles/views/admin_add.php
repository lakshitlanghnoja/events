<div class="main-container">
    <?php echo form_open_multipart(get_current_section($this).'/roles/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <?php // echo $this->theme->message(); ?>
        <div class="add-new">
                 <?php echo anchor(site_url().get_current_section($this).'/roles', lang('view-all-role'), 'title="View All Roles" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('add-edit-role') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="100%" cellpadding="5" cellspacing="1" border="0">
                                        <?php
                                        $role_data = array(
                                            'name' => 'role_name',
                                            'id' => 'role_name',
                                            'value' => set_value('role_name', ((isset($role_name)) ? htmlspecialchars_decode($role_name) : '')),
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required]',
                                            'maxlength' => '100'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('role-name'), 'role_name'); ?>:</td>
                                            <td><?php echo form_input($role_data); ?><span class="validation_error"><?php echo form_error('role_name'); ?></span></td>
                                            </td>
                                        </tr>
                                        <?php
                                        $role_description_data = array(
                                            'name' => 'role_description',
                                            'id' => 'role_description',
                                            'value' => set_value('role_description', ((isset($role_description)) ? htmlspecialchars_decode($role_description) : '')),
                                            'style' => 'width:198px;height:50px;',
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><?php echo form_label(lang('role-description'), 'role_description'); ?>:</td>
                                            <td><?php echo form_textarea($role_description_data); ?><span class="validation_error"><?php echo form_error('role_description'); ?></span></td>
                                            </td>
                                        </tr>
                                        <?php
                                            $statuslist = array('1' => lang('active'),'0' => lang('inactive')); ?>
                                        <tr>
                                            <td align="right"><?php echo form_label(lang('status'), 'status'); ?>:</td>
                                            <td>
                                                <?php
                                                echo form_dropdown('status', $statuslist, ((isset($status)) ? $status : ''));
                                                ?>
                                                <span class="validation_error"><?php echo form_error('status'); ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="submit-btns clearfix">
        <?php
        $submit_button = array(
            'name' => 'mysubmit',
            'id' => 'mysubmit',
            'value' => lang('btn-save'),
            'title' => lang('btn-save'),
            'class' => 'inputbutton',
        );
        echo form_submit($submit_button);
        $cancel_button = array(
            'content' => lang('btn-cancel'),
            'title' => lang('btn-cancel'),
            'class' => 'inputbutton',
            'onclick' => "location.href='".site_url(get_current_section($this).'/roles')."'",
        );
        echo "&nbsp;";echo form_button($cancel_button);?>
    </div>
    <?php
        echo form_hidden('id', (isset($id)) ? $id : '0' );

    echo form_close();
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery("#role_name").focus();
        jQuery("#saveform").validationEngine(
            {
                // promptPosition : '<?php echo VALIDATION_ERROR_POSITION;?>',
                validationEventTrigger: "submit"}

        );

    });
</script>


