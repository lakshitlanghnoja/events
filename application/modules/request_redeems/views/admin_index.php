<div id="ajax_table">
    <div class="main-container">
        <div class="search-box">
            <table cellspacing="2" cellpadding="4" border="0">
                <tbody>
                <td align="right"><span class="star">*&nbsp;</span><?php echo lang('btn-search'); ?>:</td>
                <td align="left">
                    <?php
                    $input_data = array(
                        'name' => 'search_term',
                        'id' => 'search_term',
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
                        'content' => lang('btn-reset'),
                        'title' => lang('btn-reset'),
                        'class' => 'inputbutton',
                        'onclick' => "reset_data()",
                    );
                    echo form_button($reset_button);
                    ?>
                </td>
                </tbody>
            </table>
        </div>
        <div class="grid-data grid-data-table">
            <div class="add-new">
                <?php
                if (!empty($records)) {
                    ?>
                    <span style="float: left;"><?php echo add_image(array('active.png')) . " " . lang('active') . "  " . add_image(array('inactive.png')) . " " . lang('inactive') . ""; ?></span>
                <?php } ?>
                <?php echo anchor(site_url() . 'admin/request_redeems/action/add', lang('add-record'), 'title="Add Record" style="text-align:center;width:100%;"'); ?>
            </div>
            <?php
            $querystr = $this->_ci->security->get_csrf_token_name() . '=' . urlencode($this->_ci->security->get_csrf_hash()) . '&search_term=' . urlencode($search_term) . '&sort_by=' . $sort_by . '&sort_order=' . $sort_order . '';

            if (!empty($records)) {
                ?>
                <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
                    <?php echo form_open(); ?>
                    <tbody bgcolor="#fff">
                        <tr>
                            <!--<th width="30px"><input type="checkbox" name="check_all" id="check_all" value="0"></th>-->
                            <th width="30px"><?php echo lang('no') ?></th><th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'event_name' && $sort_order == 'asc') {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('e.title', '<?php echo $field_sort_order; ?>');" >
                                    event name
                                    <?php
                                    if ($sort_by == 'e.title') {
                                        ?>
                                        <div class="sorting">
                                            <?php echo add_image(array($sort_image)); ?>
                                        </div>
                                    <?php }
                                    ?>
                                </a>     
                            </th><th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'u.firstname' && $sort_order == 'asc') {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('u.firstname', '<?php echo $field_sort_order; ?>');" >
                                    User Name
                                    <?php
                                    if ($sort_by == 'u.firstname') {
                                        ?>
                                        <div class="sorting">
                                            <?php echo add_image(array($sort_image)); ?>
                                        </div>
                                    <?php }
                                    ?>
                                </a>     
                            </th><th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'amount' && $sort_order == 'asc') {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('amount', '<?php echo $field_sort_order; ?>');" >
                                    amount
                                    <?php
                                    if ($sort_by == 'amount') {
                                        ?>
                                        <div class="sorting">
                                            <?php echo add_image(array($sort_image)); ?>
                                        </div>
                                    <?php }
                                    ?>
                                </a>     
                            </th>
                            <th><?php echo lang('actions') ?></th>
                        </tr>
                        <?php
                        if ($page_number > 1) {
                            $i = ($this->_ci->session->userdata[get_section($this->_ci)]['record_per_page'] * ($page_number - 1)) + 1;
                        } else {
                            $i = 1;
                        }
                        foreach ($records as $record) {
                            if ($i % 2 != 0) {
                                $class = "odd-row";
                            } else {
                                $class = "even-row";
                            }
                            ?>
                            <tr class="<?php echo $class; ?> rows" >
                                <!--<td><input type="checkbox" id="<?php //echo $record['R']['id'];      ?>" name="check_box[]" class="check_box" value="<?php //echo $record['R']['id'];      ?>"></td>-->
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php echo $record['e']['event_names']; ?>
                                </td>
                                <td>
                                    <?php echo $record['u']['firstname'] . ' ' . $record['u']['lastname']; ?>
                                </td>
                                <td>
                                    <?php echo $record['R']['amount']; ?>
                                </td>
                                <td>
                                    <div class="action" style="margin: 10px 0 34px 0;">
                                        <?php $record_id = $record['R']['id']; ?>
                                        <input type="hidden" id="request_id_<?php echo $record_id; ?>" value="<?php echo $record_id; ?>">
                                        <input type="hidden" id="event_id_<?php echo $record_id; ?>" value="<?php echo $record['e']['event_id']; ?>">
                                        <input type="hidden" id="user_id_<?php echo $record_id; ?>" value="<?php echo $record['u']['user_id']; ?>">
                                        <input type="hidden" id="event_join_id_<?php echo $record_id; ?>" value="<?php echo $record['R']['event_join_ids']; ?>">
                                        <input type="hidden" id="event_name_id_<?php echo $record_id; ?>" value="<?php echo $record['e']['event_names']; ?>">
                                        <input type="hidden" id="amount_<?php echo $record_id; ?>" value="<?php echo $record['R']['amount']; ?>">
                                        <div class="edit">
                                            <a href="javascript:void(0)" class="payment_action" record_id="<?php echo $record_id; ?>" style="border: 1px solid; background-color: #1D5283; color: #fff; padding: 6px;">
                                                Make Payment
                                            </a>
                                        </div>

                                        <?php $deletelink = "<a href='javascript:;' title='Delete' onclick='delete_record($record_id)'>" . add_image(array('delete.png')) . "</a>"; ?>
                                        <div class="delete"><?php echo $deletelink ?></div>
                                    </div>    
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        <?php
                        echo form_hidden('search_text', (isset($search_text)) ? $search_text : '' );
                        echo form_hidden('page_number', "", "page_number");
                        echo form_hidden('per_page_result', "", "per_page_result");
                        ?>
                    </tbody>
                    <?php echo form_close(); ?>
                </table>
            </div>
            <?php
            $options = array(
                'total_records' => $total_records,
                'page_number' => $page_number,
                'isAjaxRequest' => 1,
                'base_url' => base_url() . "admin/request_redeems/index",
                'params' => $querystr,
                'element' => 'ajax_table'
            );

            widget('custom_pagination', $options);
        } else {
            ?>
            <table>
                <tr>
                    <td><?php echo lang('no-records') ?></td>
                </tr>
            </table>
            <?php
        }
        ?>
    </div>
</div>



<form id="paymentForm" action="<?php echo base_url('/admin/request_redeems/pay'); ?>" method="post">
    <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">
    <input type="hidden" id="request_id" value="" name="request_id">
    <input type="hidden" id="event_id" value="" name="event_id">
    <input type="hidden" id="user_id" value="" name="user_id">
    <input type="hidden" id="event_join_ids" value="" name="event_join_ids">
    <input type="hidden" id="amount" value="" name="amount">
    <input type="hidden" id="event_name" value="" name="event_name">

</form>
<script type="text/javascript">
    //remove dynamically populate error
    $("#search_term").keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            submit_search();
        }
    });

    $('.payment_action').click(function () {
        var record_id = $(this).attr('record_id');
        $('#request_id').val($('#request_id_' + record_id).val());
        $('#event_id').val($('#event_id_' + record_id).val());
        $('#user_id').val($('#user_id_' + record_id).val());
        $('#event_join_ids').val($('#event_join_id_' + record_id).val());
        $('#amount').val($('#amount_' + record_id).val());
        $('#event_name').val($('#event_name_id_' + record_id).val());
        $('#paymentForm').submit();

    });

    function attach_error_event() {
        $('div.formError').bind('click', function () {
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
        $(".check_box").click(function () {

            if ($(".check_box").length == $(".check_box:checked").length) {
                $("#check_all").prop("checked", true);
                $(".check_box").attr("checked", "checked");
            } else {
                $("#check_all").removeAttr("checked");
            }

        });
    });



    function delete_record(id) {
        res = confirm('<?php echo lang('delete-alert') ?>');
        if (res) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/request_redeems/delete',
                data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>: '<?php echo $this->_ci->security->get_csrf_hash(); ?>', id: id},
                success: function (data) {
                    //for managing same state while record delete
                    if ($('.rows') && $('.rows').length > 1) {
                        pageno = "&page_number=<?php echo $page_number; ?>";
                    } else {
                        pageno = "&page_number=<?php echo $page_number - 1; ?>";
                    }
                    ajaxLink('<?php echo base_url(); ?>admin/request_redeems/index', 'ajax_table', '<?php echo $querystr; ?>' + pageno);

                    //set responce message                    
                    $("#messages").show();
                    $("#messages").html(data);
                }
            });

        } else {
            return false;
        }
    }

    function submit_search()
    {
        $('#error_msg').fadeOut(1000); //hide error message it shown up while search
        if ($('#search_term').val() == '') {
            $('#search_term').validationEngine('showPrompt', '<?php echo lang('msg-search-req'); ?>', 'error');
            attach_error_event(); //for remove dynamically populate popup
            return false;
        }
        blockUI();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/request_redeems/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>: '<?php echo $this->_ci->security->get_csrf_hash(); ?>', search_term: encodeURIComponent($('#search_term').val())},
            success: function (data) {
                $("#ajax_table").html(data);
                unblockUI();
            }
        });

    }

    function sort_data(sort_by, sort_order)
    {
        $('#error_msg').fadeOut(1000); //hide error message it shown up while search
        blockUI();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/request_redeems/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>: '<?php echo $this->_ci->security->get_csrf_hash(); ?>', search_term: encodeURIComponent($('#search_term').val()), sort_by: sort_by, sort_order: sort_order},
            success: function (data) {
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
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/request_redeems/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>: '<?php echo $this->_ci->security->get_csrf_hash(); ?>', search_term: ""},
            success: function (data) {
                $("#ajax_table").html(data);
                unblockUI();
            }
        });
    }

</script>
