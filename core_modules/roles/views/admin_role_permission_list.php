<div class="main-container">
    <div id="success_msg" style="display: none;" class="msg-content-box" onclick="hide_msg();">
        <div class="alert alert-success">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <?php echo lang('permission-update-success'); ?>
        </div>
    </div>
	<div class="scroll_top"></div>
    <div class="grid-data grid-data-table">
        <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
            <?php echo form_open(); ?>
            <tbody bgcolor="#ffffff">
                <?php
                if(is_array($matrix_permissions) && is_array($matrix_roles))
                {
                    ?>
                    <tr>
                        <td colspan="8">
                            <?php
                            $save_button = array(
                                'content' => lang('btn-save'),
                                'title' => lang('btn-save'),
                                'class' => 'inputbutton',
                                'onclick' => "save_records()",
                            );
                            echo form_button($save_button);
                            ?>
                            &nbsp;
                            <?php
                            $reset_button = array(
                                'content' => lang('btn-reset'),
                                'title' => lang('btn-reset'),
                                'class' => 'inputbutton',
                                'type' => "reset",
                            );
                            echo form_button($reset_button);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo lang('permissions') ?></th>
                        <?php
                        foreach ($matrix_roles as $matrix_role)
                        {
                            $role_id = $matrix_role['R']['id'];
                            $check_box = array(
                                'value' => '0',
                                'class' => 'check_box',
                                'onclick' => 'check(' . $role_id . ')',
                            );
                            ?>
                            <th><?php echo form_checkbox($check_box); ?><?php echo $matrix_role['R']['role_name']; ?></th>
                            <?php
                            $cols[] = array('role_id' => $matrix_role['R']['id'], 'role_name' => $matrix_role['R']['role_name']);
                        }
                        ?>
                    </tr>
                    <?php
                    $j = 1;
                    foreach ($matrix_permissions as $matrix_permission)
                    {
                        if ($matrix_permission['parent_id'] != 0)
                        {
                            $class = "odd-row";
                        }
                        else
                        {
                            $class = "even-row";
                        }
                        ?>
                        <tr class="<?php echo $class; ?>">
                            <td>
                                <?php
                                if ($matrix_permission['parent_id'] == 0)
                                {
                                    echo $matrix_permission['permission_title'];
                                }
                                else
                                {
                                    echo "&nbsp;&nbsp;&nbsp;" . $matrix_permission['permission_title'];
                                }
                                ?>
                            </td>
                            <?php
                            for ($i = 0; $i < count($cols); $i++)
                            {
                                $checkbox_value = $cols[$i]['role_id'] . ',' . $matrix_permission['id'];
                                $checked = '';

                                if (!empty($matrix_role_permissions))
                                {
                                    $checked = in_array($checkbox_value, $matrix_role_permissions) ? ' "checked"' : '';
                                }

                                if ($checked != '')
                                {
                                    $delete = 1;
                                }
                                else
                                {
                                    $delete = 0;
                                }

                                $role_id = $cols[$i]['role_id'];
                                $permission_id = $matrix_permission['id'];
                                $check_box = array(
                                    'value' => $checkbox_value,
                                    'checked' => $checked,
                                    'class' => 'check_box' . $role_id,
                                );
                                ?>
                                <td class="text-center" title="<?php echo $cols[$i]['role_name']; ?>">
                                    <?php echo form_checkbox($check_box); ?>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                        $j++;
                    }
                    ?>
					<tr>
                        <td colspan="8">
                            <?php
                            $save_button = array(
                                'content' => lang('btn-save'),
                                'title' => lang('btn-save'),
                                'class' => 'inputbutton',
                                'onclick' => "save_records()",
                            );
                            echo form_button($save_button);
                            ?>
                            &nbsp;
                            <?php
                            $reset_button = array(
                                'content' => lang('btn-reset'),
                                'title' => lang('btn-reset'),
                                'class' => 'inputbutton',
                                'type' => "reset",
                            );
                            echo form_button($reset_button);
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo lang('ci_model_no_data');?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
                        <?php
                        $querystr = $this->theme->ci()->security->get_csrf_token_name() . '=' . urlencode($this->theme->ci()->security->get_csrf_hash());
                        ?>
                    <?php echo form_close(); ?>
        </table>
    </div>
</div>

<script type="text/javascript">
    //Function check to check all checkbox by role
    function check(role_id)
    {
        if ($(".check_box").is(':checked')) {
            $(".check_box"+role_id).prop("checked", true);
        } else {
            $(".check_box"+role_id).prop("checked", false);
        }
        //$(".check_box"+role_id).prop("checked", false);
    }

    //Function check_all to check all checkbox
    function check_all()
    {
        $(".check_box").prop("checked", true);
    }

    //Function uncheck_all to uncheck all checkbox
    function uncheck_all()
    {
        $(".check_box").prop("checked", false);
    }

    //Function save_records to save all permissions
    function save_records()
    {
        var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        });

        $.ajax({
            type:'POST',
            url: '<?php echo base_url() . get_current_section($this); ?>/roles/update_matrix_permission',
            data: {<?php echo $this->theme->ci()->security->get_csrf_token_name(); ?>:'<?php echo $this->theme->ci()->security->get_csrf_hash(); ?>',permission_id:val},
            success: function (data) {
                $("#success_msg").show();			
				$('html, body').animate({scrollTop:0}, 'slow');
            }
        });	
		
    }

    function hide_msg(){
        $('#success_msg').hide();
    }
</script>
