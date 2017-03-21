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
    <?php echo form_open_multipart($this->_data['section_name'] . '/users/save', array('id' => 'saveform', 'name' => 'saveform')); ?>
    <div class="grid-data">
        <div class="add-new">
            <?php echo anchor(site_url() . $this->_data['section_name'] . '/users', lang('view-all-user'), 'title="View All Users" style="text-align:center;width:100%;"'); ?>
        </div>
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <tbody bgcolor="#fff">
                <tr>
                    <th><?php echo lang('add-edit-user') ?></th>
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
                                        $firstname_data = array(
                                            'name' => 'firstname',
                                            'id' => 'firstname',
                                            'value' => set_value('firstname', ((isset($firstname)) ? htmlspecialchars_decode($firstname) : '')),
                                            //'value' => (htmlspecialchars_decode($firstname)),
                                            //max lenght use if you want to limit characters
                                            'maxlength' => 50,
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required,maxSize[50]]'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('first-name'), 'firstname'); ?>:</td>
                                            <td><?php echo form_input($firstname_data); ?><span class="validation_error"><?php echo form_error('firstname'); ?></span></td>
                                        </tr>
                                        <?php
                                        $lastname_data = array(
                                            'name' => 'lastname',
                                            'id' => 'lastname',
                                            'maxlength' => 50,
                                            'value' => set_value('lastname', ((isset($lastname)) ? htmlspecialchars_decode($lastname) : '')),
                                            'style' => 'width:198px;',
                                            'class' => 'validate[required,maxSize[50]]'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('last-name'), 'lastname'); ?>:</td>
                                            <td><?php echo form_input($lastname_data); ?><span class="validation_error"><?php echo form_error('lastname'); ?></span></td>
                                            </td>
                                        </tr>
                                        <?php
                                        $email_data = array(
                                            'name' => 'email',
                                            'id' => 'email',
                                            'value' => set_value('email', ((isset($email)) ? htmlspecialchars_decode($email) : '')),
                                            'style' => 'width:198px;',
                                            'maxlength' => '150',
                                            'class' => 'validate[required,custom[email],maxSize[150]]'
                                        );
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('email'), 'email'); ?>:</td>
                                            <td><?php echo form_input($email_data); ?><span class="validation_error"><?php echo form_error('email'); ?></span></td>
                                            </td>
                                        </tr>


                                        <?php
                                        $password_data['name'] = 'password';
                                        $password_data['id'] = 'password';
                                        $password_data['maxlength'] = '40';
                                        $password_data['value'] = set_value('password', ((isset($password)) ? $password : ''));
                                        if ($id == "" || $id == 0) {
                                            $password_data['class'] = 'validate[required]';
                                        } else {
                                            $password_data['onblur'] = 'addClassforemail(this);';
                                        }
                                        $passconf_data['name'] = 'passconf';
                                        $passconf_data['id'] = 'passconf';
                                        $passconf_data['maxlength'] = '40';
                                        $passconf_data['value'] = set_value('passconf', ((isset($passconf)) ? $passconf : ''));
                                        if ($id == "" || $id == 0)
                                            $passconf_data['class'] = 'validate[required]';
                                        ?>
                                        <tr>
                                            <td align="right"><?php if ($id == '' || $id == 0) {
                                            ?><span class="star">*&nbsp;</span><?php } ?><?php echo form_label(lang('password'), 'password'); ?>:</td>
                                            <td><?php echo form_password($password_data); ?><span class="validation_error"><?php echo form_error('password'); ?></span></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php if ($id == '' || $id == 0) {
                                            ?><span class="star">*&nbsp;</span><?php } ?><?php echo form_label(lang('c-password'), 'passconf'); ?>:</td>
                                            <td><?php echo form_password($passconf_data); ?><span class="validation_error"><?php echo form_error('passconf'); ?></span></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo form_label(lang('role'), 'Role'); ?>:</td>
                                            <td>
                                                <?php
                                                if ($user_id == 1) {
                                                    $disable = "disabled='disabled'";
                                                } else {
                                                    $disable = "";
                                                }

                                                $additional_info = $disable . ' style="width:105px;"';
                                                echo form_dropdown('role_id', $role_list, ((isset($role_id)) ? $role_id : 0), $additional_info);
                                                ?>
                                                <span class="validation_error"><?php echo form_error('role_id'); ?></span>
                                            </td>
                                        </tr>


                                        <?php
//                                                if ($id != "" && $id != 0)
//                                                {
                                        $statuslist = array('1' => 'Active', '0' => 'Inactive');
                                        ?>
                                        <tr>
                                            <td align="right"><span class="star">*&nbsp;</span><?php echo form_label(lang('status'), 'Status'); ?>:</td>
                                            <td>
                                                <?php
                                                if ($user_id == 1) {
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
            'onclick' => "location.href='" . site_url($this->_data['section_name'] . '/users') . "'",
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



