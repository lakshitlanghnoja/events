<div class="main-container">
    <?php echo form_open_multipart(get_current_section($this).'/permissions/save/', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <?php echo $this->theme->message(); ?>
        <div class="add-new">
                 <?php echo anchor(site_url().get_current_section($this).'/permissions', lang('view-all-permission'), 'title="View All Permissions" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('add-edit-permission') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="100%" cellpadding="5" cellspacing="1" border="0">
                                        <?php
                                        $permission_lable_data = array(
                                            'name' => 'permission_label',
                                            'id' => 'permission_label',
                                            'value' => set_value('permission_label', ((isset($permission_label)) ? $permission_label : '')),
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required]',
                                            'maxlength' => '250'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('permission-label'), 'permission_label'); ?>:</td>
                                            <td><?php echo form_input($permission_lable_data); ?><span class="validation_error"><?php echo form_error('permission_label'); ?></span></td>
                                        </tr><?php
                                        $permission_title_data = array(
                                            'name' => 'permission_title',
                                            'id' => 'permission_title',
                                            'value' => set_value('permission_title', ((isset($permission_title)) ? $permission_title : '')),
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required]',
                                            'maxlength' => '250'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('permission-title'), 'permission_title'); ?>:</td>
                                            <td><?php echo form_input($permission_title_data); ?><span class="validation_error"><?php echo form_error('permission_title'); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('parent'), 'parent_id'); ?>:</td>
                                            <td>
                                                <?php
                                                echo form_dropdown('parent_id', $parent_list, ((isset($parent_id)) ? $parent_id : ''));
                                                ?>
                                                <span class="warning-msg"><?php echo form_error('parent_id'); ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                            $statuslist = array('1' => lang('active'),'0' => lang('inactive')); ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('status'), 'status'); ?>:</td>
                                            <td>
                                                <?php
                                                echo form_dropdown('status', $statuslist, ((isset($status)) ? $status : ''));
                                                ?>
                                                <span class="warning-msg"><?php echo form_error('status'); ?></span>
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
            'onclick' => "location.href='".site_url(get_current_section($this).'/permissions')."'",
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
        jQuery("#permission_label").focus();
        jQuery("#saveform").validationEngine(
            {
                //promptPosition : '<?php echo VALIDATION_ERROR_POSITION;?>',
                validationEventTrigger: "submit"
            }

        );

    });
</script>



