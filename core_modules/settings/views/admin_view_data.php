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
                    <th><?php echo lang('view-data'); ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">

                         <table width="500px" cellpadding="5" cellspacing="1" border="0">
                            <tr>
                               <td align="left"><?php echo lang('setting-title'); ?>:</td>
                               <td align="left"><?php echo $data[0]['s']['setting_label']?></td>
                            </tr>                                        
                            <tr>
                               <td align="left"><?php echo lang('setting-label'); ?>:</td>
                               <td align="left"><?php echo $data[0]['s']['setting_title']?></td>
                            </tr>
                            <tr>
                               <td align="left"><?php echo lang('setting-value'); ?>:</td>
                               <td align="left"><?php if(isset($data[0]['s']['setting_value'])){ echo $data[0]['s']['setting_value']; } ?></td>
                            </tr>                                    
                            <tr>
                               <td align="left"><?php echo lang('setting-comment'); ?>:</td>
                               <td align="left"><?php echo $data[0]['s']['comment']; ?></td>
                            </tr>

                        </table>                                                   
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php echo form_close(); ?>
    </div>    
</div>

<script type="text/javascript">    
    $(document).ready(function(){        
        
        jQuery("#saveform").validationEngine(
        {  
            promptPosition : '<?php echo VALIDATION_ERROR_POSITION; ?>',
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