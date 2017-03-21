<div class="main-container">
    <?php echo form_open_multipart('admin/permissions/save/', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <?php echo $this->theme->message(); ?>
        <div class="add-new">
                 <?php echo anchor(base_url().get_current_section($this).'/permissions', lang('view-all-permission'), 'title="View All Permissions" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#ffffff">
                <tr>
                    <th><?php echo lang('view-data') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="300px" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="100%" cellpadding="5" cellspacing="1" border="0">
                                        <tr>
                                            <td align="right"><?php echo lang('permission-label'); ?>:</td>
                                            <td><?php echo $data['permission_label']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo lang('permission-title'); ?>:</td>
                                            <td><?php echo $data['permission_title']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo lang('parent'); ?>:</td>
                                            <td>
                                                <?php if($data['title']==""){ echo "Root"; }else { echo $data['title']; } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo lang('status'); ?>:</td>
                                            <td>
                                                <?php if($data['status']==1) { echo lang('active'); }else { echo lang('inactive'); }  ?>
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

    <?php
        echo form_hidden('id', (isset($id)) ? $id : '0' );

    echo form_close();
    ?>
</div>



