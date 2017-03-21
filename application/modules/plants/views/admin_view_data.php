<div class="main-container">
    <?php echo form_open_multipart($this->_data['section_name'].'/plants/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <div class="add-new">
            <?php echo anchor(site_url().$this->_data['section_name'].'/plants', lang('view-all-plant'), 'title="View All Plants" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('view-plant-data') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="500px" cellpadding="5" cellspacing="1" border="0">
                                        <tr>
                                           <td align="left" width='100px'><?php echo form_label(lang('Botanical-Name'), 'botanicalname'); ?>:</td>
                                           <td align="left"><?php echo $data['botanicalname']?></td>
                                        </tr>
                                        <tr>
                                           <td align="left"><?php echo form_label(lang('Common-Name'), 'commonname'); ?>:</td>
                                           <td align="left"><?php echo $data['commonname']?></td>
                                        </tr>
                                        <tr>
                                           <td align="left"><?php echo form_label(lang('family'), 'family'); ?>:</td>
                                           <td align="left"><?php echo $data['family']?></td>
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



