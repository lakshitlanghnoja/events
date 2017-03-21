<script type="text/javascript">
    (function ($) {

        $.fn.maxlength = function(){

            $("textarea[maxlength]").keypress(function(event){
                var key = event.which;

                //all keys including return.
                if(key >= 33 || key == 13 || key == 32) {
                    var maxLength = $(this).attr("maxlength");
                    var length = this.value.length;
                    if(length >= maxLength) {
                        event.preventDefault();
                    }
                }
            });
        }

    })(jQuery);

    $(document).ready(function($) {
        //Set maxlength of all the textarea (call plugin)
        $().maxlength();
    })


</script>

<div class="main-container">
    <?php echo form_open_multipart($this->_data['section_name'] . '/plants/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <div class="add-new">
            <?php echo anchor(site_url() . $this->_data['section_name'] . '/plants', lang('view-all-plant'), 'title="View All Plants" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('add-edit-plant') ?></th>
                </tr>
                <tr>
                    <td class="add-user-form-box">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">
                                    <table width="100%" cellpadding="5" cellspacing="1" border="0">
                                        <?php
                                        $id = ((isset($id)) ? $id : 0);
                                        ?>
                                        <?php
                                        $botanicalname_data = array(
                                            'name' => 'botanicalname',
                                            'id' => 'botanicalname',
                                            'value' => set_value('botanicalname', ((isset($botanicalname)) ? htmlspecialchars_decode($botanicalname) : '')),
                                            //'value' => (htmlspecialchars_decode($firstname)),
                                            //max lenght use if you want to limit characters
                                            'maxlength' => 50,
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required,maxSize[50]]'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('Botanical-Name'), 'botanicalname'); ?>:</td>
                                            <td><?php echo form_input($botanicalname_data); ?><span class="validation_error"><?php echo form_error('botanicalname'); ?></span></td>
                                        </tr>
                                        <?php
                                        $commonname_data = array(
                                            'name' => 'commonname',
                                            'id' => 'commonname',
                                            'maxlength' => 50,
                                            'value' => set_value('commonname', ((isset($commonname)) ? htmlspecialchars_decode($commonname) : '')),
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required,maxSize[50]]'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('Common-Name'), 'commonname'); ?>:</td>
                                            <td><?php echo form_input($commonname_data); ?><span class="validation_error"><?php echo form_error('commonname'); ?></span></td>
                                            </td>
                                        </tr>
                                        <?php
                                        $family_data = array(
                                            'name' => 'family',
                                            'id' => 'family',
                                            'value' => set_value('Family', ((isset($family)) ? htmlspecialchars_decode($family) : '')),
                                            'style' => 'width:198px;',
                                            'maxlength' => '150',
                                            'class' => 'validate[required,maxSize[50]]'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('family'), 'family'); ?>:</td>
                                            <td><?php echo form_input($family_data); ?><span class="validation_error"><?php echo form_error('family'); ?></span></td>
                                            </td>
                                        </tr>

                                        <?php
//                                                if ($id != "" && $id != 0)
//                                                {
                                        $statuslist = array('1' => 'Active', '0' => 'Inactive');
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('status'), 'status'); ?>:</td>
                                            <td>
                                                <?php
                                                if ($id == 1) {
                                                    $disable = "disabled='disabled'";
                                                } else {
                                                    $disable = "";
                                                }
                                                echo form_dropdown('status', $statuslist, $status, $disable);
                                                ?>
                                                <span class="validation_error"><?php echo form_error('status'); ?></span>
                                            </td>
                                        </tr>
                                        <?php //}  ?>
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
            'onclick' => "location.href='" . site_url($this->_data['section_name'] . '/plants') . "'",
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

        $(":input").each(function (i) { $(this).attr('tabindex', i + 1); })
        jQuery("#saveform").validationEngine(
        {
            //promptPosition: '<?php echo VALIDATION_ERROR_POSITION; ?>',
            validationEventTrigger: "submit"
        }
    );

        $("input:text:visible:first").focus().val($('input:text:visible:first').val());
        //  $('input').focus().val($('input').val());

        //$("input:text").focus(function() { $(this).select(); } );


    });
    function addClassforemail()
    {
        var email_text=$('#password').val();
        if(email_text!="")
        {
            // $('#email').removeClass();
            $('#passconf').addClass("validate[required]");
        }else
        {  $('#passconf').removeClass();
            // $('#email').addClass("input validate[required]");
        }


    }

    //    $(function() {
    //        $("saveform:not(.filter) :input:visible:enabled:first").focus();
    //      });
</script>



