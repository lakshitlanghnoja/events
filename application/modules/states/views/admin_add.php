<div class="main-container">
    <?php echo form_open_multipart('admin/states/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <div class="add-new">
            <?php echo anchor(site_url() . 'admin/states', lang('view-all-records'), 'title="View All Users" style="text-align:center;width:100%;"'); ?>
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
                                        $name_data = array(
                                                'name' => 'name',
                                                'id' => 'name',
                                                'value' => set_value('name', ((isset($name)) ? $name : '')),
                                                'style' => 'width:198px;',
                                                'class' => 'validate[required]'
                                            );?>
                                            <tr>
                                                <td align="right"><span class="star">*&nbsp;</span><?php echo form_label('Name', 'name'); ?>:</td>
                                                <td><?php echo form_input($name_data); ?><br/><span class="warning-msg"><?php echo form_error('name'); ?></span></td>
                                                </td>
                                            </tr>
                                            <?php
                                            $tax_data = array(
                                                'name' => 'tax',
                                                'id' => 'tax',
                                                'value' => set_value('tax', ((isset($tax)) ? $tax : '')),
                                                'style' => 'width:198px;',
                                                'class' => 'validate[required]'
                                            );?>
                                            <tr>
                                                <td align="right"><span class="star">*&nbsp;</span><?php echo form_label('Tax', 'tax'); ?>:</td>
                                                <td><?php echo form_input($tax_data); ?> % <br/><span class="warning-msg"><?php echo form_error('tax'); ?></span></td>
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
            'onclick' => "location.href='" . site_url('admin/states') . "'",
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