<div class="main-container">
    <?php echo form_open_multipart($this->_data['section_name'].'/users/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <div class="add-new">
            <?php echo anchor(site_url().$this->_data['section_name'].'/users', lang('view-all-user'), 'title="View All Users" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('view-user-data') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="500px" cellpadding="5" cellspacing="1" border="0">
                                        <tr>
                                           <td align="left" width='100px'><?php echo form_label(lang('first-name'), 'firstname'); ?>:</td>
                                           <td align="left"><?php echo $data['firstname']?></td>
                                        </tr>
                                        <tr>
                                           <td align="left"><?php echo form_label(lang('last-name'), 'lastname'); ?>:</td>
                                           <td align="left"><?php echo $data['lastname']?></td>
                                        </tr>
                                        <tr>
                                           <td align="left"><?php echo form_label(lang('email'), 'email'); ?>:</td>
                                           <td align="left"><?php echo $data['email']?></td>
                                        </tr>
                                        <tr>
                                           <td align="left"><?php echo form_label(lang('role'), 'Role'); ?>:</td>
                                           <td align="left"><?php echo $data['role_name']?></td>
                                        </tr>
                                        
                                        <tr>
                                           <td align="left"><?php echo form_label(lang('status'), 'Status'); ?>:</td>
                                           <td align="left"><?php if($data['status']=='1'){ echo lang('active'); }else{ echo lang('inactive'); }?></td>
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



