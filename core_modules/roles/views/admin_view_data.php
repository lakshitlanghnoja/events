<div class="main-container">
    <?php echo form_open_multipart(get_current_section($this).'/roles/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <?php echo $this->theme->message(); ?>
        <div class="add-new">
                 <?php echo anchor(site_url().get_current_section($this).'/roles', lang('view-all-role'), 'title="View All Roles" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#ffffff">
                <tr>
                    <th><?php echo lang('view-data') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                      <table width="200px" cellpadding="5" cellspacing="1" border="0">
                                        <tr>
                                           <td align="left"><?php echo lang('role-name'); ?>:</td>
                                           <td align="left"><?php echo $data['role_name']?></td>
                                        </tr>
                                         <tr>
                                           <td align="left"><?php echo lang('role-description'); ?>:</td>
                                           <td align="left"><?php echo $data['role_description']?></td>
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
    $(document).ready(function(){

        jQuery("#saveform").validationEngine(
            {promptPosition : '<?php echo VALIDATION_ERROR_POSITION;?>',validationEventTrigger: "submit"}
        );

    });
</script>


