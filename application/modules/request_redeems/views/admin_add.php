<div class="main-container">
    <?php echo form_open_multipart('admin/test/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <div class="add-new">
            <?php echo anchor(site_url() . 'admin/test', lang('view-all-records'), 'title="View All Users" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('add-edit-record') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="100%" cellpadding="5" cellspacing="1" border="0">
                                        <?php
                                        $id = ((isset($id)) ? $id : 0);
                                        $event_name_data = array(
                                                'name' => 'event_name',
                                                'id' => 'event_name',
                                                'value' => set_value('event_name', ((isset($event_name)) ? $event_name : '')),
                                                'style' => 'width:198px;',
                                                'class' => 'validate[required]'
                                            );?>
                                            <tr>
                                                <td align="right"><span class="star">*&nbsp;</span><?php echo form_label('event name', 'event_name'); ?>:</td>
                                                <td><?php echo form_input($event_name_data); ?><br/><span class="warning-msg"><?php echo form_error('event_name'); ?></span></td>
                                                </td>
                                            </tr>
                                            <?php
                                            $user_name_data = array(
                                                'name' => 'user_name',
                                                'id' => 'user_name',
                                                'value' => set_value('user_name', ((isset($user_name)) ? $user_name : '')),
                                                'style' => 'width:198px;',
                                                'class' => 'validate[required]'
                                            );?>
                                            <tr>
                                                <td align="right"><span class="star">*&nbsp;</span><?php echo form_label('User Name', 'user_name'); ?>:</td>
                                                <td><?php echo form_input($user_name_data); ?><br/><span class="warning-msg"><?php echo form_error('user_name'); ?></span></td>
                                                </td>
                                            </tr>
                                            <?php
                                            $amount_data = array(
                                                'name' => 'amount',
                                                'id' => 'amount',
                                                'value' => set_value('amount', ((isset($amount)) ? $amount : '')),
                                                'style' => 'width:198px;',
                                                'class' => 'validate[required]'
                                            );?>
                                            <tr>
                                                <td align="right"><span class="star">*&nbsp;</span><?php echo form_label('amount', 'amount'); ?>:</td>
                                                <td><?php echo form_input($amount_data); ?><br/><span class="warning-msg"><?php echo form_error('amount'); ?></span></td>
                                                </td>
                                            </tr>
                                            <?php
                                            
                                        ?>
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
            'name' => 'cancel',
            'value' => lang('btn-cancel'),
            'title' => lang('btn-cancel'),
            'class' => 'inputbutton',
            'onclick' => "location.href='" . site_url('admin/test') . "'",
        );
        echo "&nbsp;";
        echo form_reset($cancel_button);
        ?>
    </div>
<?php
echo form_hidden('id', (isset($id)) ? $id : '0' );
echo form_close();
?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        jQuery("#saveform").validationEngine(
                {promptPosition: '<?php echo VALIDATION_ERROR_POSITION; ?>', validationEventTrigger: "submit"}
        );
    });
</script>