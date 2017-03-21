<div id="ajax_table">
    <div class="main-container">
        <div class="search-box">
            <table cellspacing="2" cellpadding="4" border="0">
                <tbody>
                <td align="right"><?php echo lang('search-by-botanicalname'); ?>:</td>
                <td align="left">
                    <?php
                    $input_data = array(
                        'name' => 'search_term',
                        'id' => 'search_term',
                        'title' => 'search',
                        'value' => set_value('search_term', urldecode($search_term))
                    );
                    echo form_input($input_data);
                    ?>
                </td>
                <td>
                    <?php
                    $search_button = array(
                        'content' => lang('btn-search'),
                        'title' => lang('btn-search'),
                        'class' => 'inputbutton',
                        'onclick' => "submit_search()",
                    );
                    echo form_button($search_button);
                    ?>
                </td>
                <td>
                    <?php
                    $reset_button = array(
                        'content' => lang('reset_button'),
                        'title' => lang('reset_button'),
                        'class' => 'inputbutton',
                        'onclick' => "reset_data()",
                    );
                    echo form_button($reset_button);
                    ?>
                </td>

                </tbody>
            </table>
        </div>
        <?php
        if (!empty($users))
        {
            ?>
            <div class="grid-data grid-data-table">
                <div class="add-new">
                    <span style="float: left;"><?php echo add_image(array('active.png'),"","",array('alt' => 'active','title' => "active")) . " " . lang('active') . "  " . add_image(array('inactive.png')) . " " . lang('inactive') . ""; ?></span>
                    <?php echo anchor(site_url() .$this->_data['section_name'].'/plants/action/add', lang('add-plant'), 'title="Add Plants" style="text-align:center;width:100%;"'); ?>
                </div>
                <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
                    <?php echo form_open(); ?>
                    <tbody bgcolor="#fff">
                        <tr>
                            <th><input type="checkbox" name="check_all" id="check_all" value="0"></th>
                            <th><?php echo lang('no') ?></th>
                            <th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'u.botanicalname' && $sort_order == 'asc')
                                {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('u.botanicalname', '<?php echo $field_sort_order; ?>');" >
                                    <?php echo lang('Botanical-Name'); ?>
                                    <?php
                                    if ($sort_by == 'u.botanicalname')
                                    {
                                        ?>
                                        <div class="sorting">
                                        <?php echo add_image(array($sort_image)); ?>
                                        </div>
                                        <?php }
                                    ?>
                                </a>
                            </th>
                            <th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'u.commonname' && $sort_order == 'asc')
                                {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('u.commonname', '<?php echo $field_sort_order; ?>');" >
                                    <?php echo lang('Common-Name'); ?>
                                    <?php
                                    if ($sort_by == 'u.commonname')
                                    {
                                        ?>
                                        <div class="sorting">
                                        <?php echo add_image(array($sort_image)); ?>
                                        </div>
                                <?php }
                            ?>
                                </a>
                            </th>
                            <th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'u.family' && $sort_order == 'asc')
                                {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('u.family', '<?php echo $field_sort_order; ?>');" >
                                    <?php echo lang('family'); ?>
                                    <?php
                                    if ($sort_by == 'u.family')
                                    {
                                        ?>
                                        <div class="sorting">
                                        <?php echo add_image(array($sort_image)); ?>
                                        </div>
                                <?php }
                            ?>
                                </a>
                            </th>


                                <?php
    $field_sort_order = 'asc';
    if ($sort_by == 'u.status' && $sort_order == 'asc') {
        $sort_image = 'srt_up.png';
        $field_sort_order = 'desc';
    }
    ?>
                                <a href="#" onclick="sort_data('u.status', '<?php echo $field_sort_order; ?>');" ><?php  echo lang('status') ?></a>
                                <?php if ($sort_by == 'u.status') { ?>
                    <div class="sorting">
        <?php echo add_image(array($sort_image)); ?>
                    </div>
                            <?php } ?>
                            </th>
                            <th><?php echo lang('actions') ?></th>
                        </tr>


                        <?php

                        if ($page_number > 1)
                        {
                            $i = ($this->_ci->session->userdata[$this->_data['section_name']]['record_per_page'] * ($page_number - 1)) + 1;
                        }
                        else
                        {
                            $i = 1;
                        }
                        foreach ($users as $user)
                        {
                            if ($i % 2 != 0)
                            {
                                $class = "odd-row";
                            }
                            else
                            {
                                $class = "even-row";
                            }
                            $user_id = $user['u']['id'];
                            ?>
                            <tr class="<?php echo $class; ?> rows" >
                                <td>
                                    <?php if ($user_id != 1 && $user_id != $this->_ci->session->userdata[$this->_data['section_name']]['user_id'])
                                    { ?>
                                    <input type="checkbox" id="<?php echo $user['u']['id']; ?>" name="check_box[]" class="check_box" value="<?php echo base64_encode($user['u']['id']); ?>">
                                    <?php } ?>
                                </td>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['u']['botanicalname']; ?></td>
                                <td><?php echo $user['u']['commonname']; ?></td>
                                <td><?php echo $user['u']['family']; ?></td>


                                <td>
                                    <?php
                                    if ($user['u']['status'] == 1)
                                    {
                                        echo add_image(array('active.png'), '', '', array('title'=>'active','alt' =>"active"));
                                    }
                                    else
                                    {
                                        echo add_image(array('inactive.png'), '', '', array('title'=>'inactive','alt' =>"inactive"));
                                    }

                                    ?>
                                </td>
                                <td>
                                    <div class="action">
                                        <div style="float:left;padding-right:10px;"><a title='View' href="<?php echo site_url().$this->_data['section_name']; ?>/plants/view_data/<?php echo $user_id; ?>"><?php echo add_image(array('viewIcon.png')); ?></a></div>
                                        <?php if ($this->_ci->session->userdata[$this->_data['section_name']]['user_id'] == 1 || $user_id != 1)
                                        { ?>
                                        <div class="edit"><a href="<?php echo site_url().$this->_data['section_name']; ?>/plants/action/edit/<?php echo $user_id ?>" title="<?php echo lang('edit') ?>"><?php echo add_image(array('edit.png')); ?></a></div>
                                        <?php } ?>

                                            <?php


                                            $encrypted_id = base64_encode($user_id);

                                            $deletelink = "<a href='javascript:;' title='Delete' onclick='delete_plant(\"$encrypted_id\")'>" . add_image(array('delete.png')) . "</a>"; ?>
                                            <div class="delete"><?php echo $deletelink ?></div>

                                    </div>
                                </td>
                            </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                        <tr class="odd-row">
                            <td colspan="9">
                                <?php
                                $reset_button = array(
                                    'content' => lang('delete'),
                                    'title' => lang('delete'),
                                    'class' => 'inputbutton',
                                    'onclick' => "delete_records()",
                                );
                                echo form_button($reset_button);
                                ?>
                                <?php
                                $reset_button = array(
                                    'content' => lang('active'),
                                    'title' => lang('active'),
                                    'class' => 'inputbutton',
                                    'onclick' => "active_records()",
                                );
                                echo form_button($reset_button);
                                ?>
                                <?php
                                $reset_button = array(
                                    'content' => lang('inactive'),
                                    'title' => lang('inactive'),
                                    'class' => 'inputbutton',
                                    'onclick' => "inactive_records()",
                                );
                                echo form_button($reset_button);
                                ?>
                                <?php
                                $reset_button = array(
                                    'content' => lang('active-all'),
                                    'title' => lang('active-all'),
                                    'class' => 'inputbutton',
                                    'onclick' => "active_all_records()",
                                );
                                echo form_button($reset_button);
                                ?>
                                <?php
                                $reset_button = array(
                                    'content' => lang('inactive-all'),
                                    'title' => lang('inactive-all'),
                                    'class' => 'inputbutton',
                                    'onclick' => "inactive_all_records()",
                                );
                                echo form_button($reset_button);
                                ?>
                            </td>
                        </tr>

                    </tbody>
            <?php echo form_close(); ?>
                </table>
            </div>
    <?php
}
else
{
    ?>
            <table>
                <tr>
                    <td><?php echo lang('no-records') ?></td>
                </tr>
            </table>
            <?php
        }
        $querystr = $this->_ci->security->get_csrf_token_name() . '=' . urlencode($this->_ci->security->get_csrf_hash()) . '&search_term=' . urlencode($search_term) . '&sort_by=' . $sort_by . '&sort_order=' . $sort_order . '';
        $options = array(
            'total_records' => $total_records,
            'page_number' => $page_number,
            'isAjaxRequest' => 1,
            'base_url' => base_url() .$this->_data['section_name']."/plants/index",
            'params' => $querystr,
            'element' => 'ajax_table'

        );

        widget('custom_pagination', $options);
        ?>

    </div>
</div>
<script type="text/javascript">
    //remove dynamically populate error
    $("#search_term").keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                submit_search();
            }
    });
    function attach_error_event(){
        $('div.formError').bind('click',function(){
            $(this).fadeOut(1000, removeError);
        });
    }
    function removeError()
    {
        jQuery(this).remove();
    }

    $(function () {
        $("#check_all").click(function () {
            if ($("#check_all").is(':checked')) {
                $(".check_box").prop("checked", true);
            } else {
                $(".check_box").prop("checked", false);
            }
        });
        $(".check_box").click(function(){

            if($(".check_box").length == $(".check_box:checked").length) {
                $("#check_all").prop("checked", true);
                $(".check_box").attr("checked", "checked");
            } else {
                $("#check_all").removeAttr("checked");
            }

        });
    });

    function delete_records()
    {
        var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        });

        if(val=="")
        {
            alert('Please select at least one record for delete');
            return false;
        }

        res = confirm('<?php echo lang('delete-alert') ?>');
        if(res){
        $.ajax({
            type:'POST',
            url: '<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',type:'delete',ids:val},
            success: function (data) {
//                    alert(data); return;

                //for managing same state while record delete
                if($('.rows') && $('.rows').length > 1){
                    pageno = "&page_number=<?php echo $page_number; ?>";
                }else{
                    pageno = "&page_number=<?php echo $page_number - 1; ?>";
                }
                ajaxLink('<?php echo base_url().$this->_data['section_name']; ?>/plants/index','ajax_table','<?php echo $querystr; ?>'+pageno);
                $("#messages").show();
                $("#messages").html(data);
            }
        });
        }else
        {
            return false;
        }
    }

    function active_records()
    {
        var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        });
        if(val=="")
        {
            alert('Please select at least one plant for active');
            return false;
        }
        $.ajax({
            type:'POST',
            url: '<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',type:'active',ids:val},
            success: function (data) {
                //for managing same state while record delete
                pageno = "&page_number=<?php echo $page_number; ?>";
                ajaxLink('<?php echo base_url().$this->_data['section_name']; ?>/plants/index','ajax_table','<?php echo $querystr; ?>'+pageno);
                $("#messages").show();
                $("#messages").html(data);
            }
        });
    }

    function inactive_records()
    {
        var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        });
        if(val=="")
        {
            alert('Please select at least one record for inactive');
            return false;
        }
        $.ajax({
            type:'POST',
            url: '<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',type:'inactive',ids:val},
            success: function (data) {
                //for managing same state while record delete
                pageno = "&page_number=<?php echo $page_number; ?>";
                ajaxLink('<?php echo base_url().$this->_data['section_name']; ?>/plants/index','ajax_table','<?php echo $querystr; ?>'+pageno);
                $("#messages").show();
                $("#messages").html(data);
            }
        });
    }

    function active_all_records()
    {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',type:'active_all'},
            success: function (data) {
                //for managing same state while record delete
                pageno = "&page_number=<?php echo $page_number; ?>";
                ajaxLink('<?php echo base_url().$this->_data['section_name']; ?>/plants/index','ajax_table','<?php echo $querystr; ?>'+pageno);
                $("#messages").show();
                $("#messages").html(data);
            }
        });
    }

    function inactive_all_records()
    {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',type:'inactive_all'},
            success: function (data) {
                //for managing same state while record delete
                pageno = "&page_number=<?php echo $page_number; ?>";
                ajaxLink('<?php echo base_url().$this->_data['section_name']; ?>/plants/index','ajax_table','<?php echo $querystr; ?>'+pageno);
                $("#messages").show();
                $("#messages").html(data);
            }
        });
    }

    function delete_plant(id){

        res = confirm('<?php echo lang('delete-alert') ?>');
        if(res){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url().$this->_data['section_name']; ?>/plants/delete',
                data:{<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',id:id},
                success: function(data) {



                    //for managing same state while record delete
                    if($('.rows') && $('.rows').length > 1){
                        pageno = "&page_number=<?php echo $page_number; ?>";
                    }else{
                        pageno = "&page_number=<?php echo $page_number - 1; ?>";
                    }
                    ajaxLink('<?php echo base_url().$this->_data['section_name']; ?>/users/index','ajax_table','<?php echo $querystr; ?>'+pageno);

                    //set responce message
                    $("#messages").show();
                    $("#messages").html(data);
                }
            });

        }else{
            return false;
        }
    }

    function submit_search()
    {
        $('#error_msg').fadeOut(1000); //hide error message it shown up while search
        /*if($('#search_term').val() == ''){
            $('#search_term').validationEngine('showPrompt', '<?php echo lang('msg-search-req'); ?>', 'error');
            attach_error_event(); //for remove dynamically populate popup
            return false;
        } */
        blockUI();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data:{<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',search_term:encodeURIComponent($('#search_term').val())},
            success: function(data) {
                $("#ajax_table").html(data);
                unblockUI();
            }
        });

    }

    function sort_data(sort_by,sort_order)
    {
        $('#error_msg').fadeOut(1000); //hide error message it shown up while search
        blockUI();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data:{<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',search_term:encodeURIComponent($('#search_term').val()),sort_by:sort_by,sort_order:sort_order},
            success: function(data) {
                $("#ajax_table").html(data);
                unblockUI();
            }
        });

    }
    function reset_data()
    {
        $('#error_msg').fadeOut(1000); //hide error message it shown up while search
        blockUI();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url().$this->_data['section_name']; ?>/plants/index',
            data:{<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',search_term:""},
            success: function(data) {
                $("#ajax_table").html(data);
                unblockUI();
            }
        });
    }

</script>