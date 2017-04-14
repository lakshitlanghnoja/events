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
                if (!empty($records))
                {?>
                <span style="float: left;"><?php echo add_image(array('active.png')) . " " . lang('active') . "  " . add_image(array('inactive.png')) . " " . lang('inactive') . ""; ?></span>
                <?php } ?>
                <?php echo anchor(site_url() . 'admin/faq/action/add', lang('add-record'), 'title="Add Record" style="text-align:center;width:100%;"'); ?>
            </div>
            <?php 
            $querystr = $this->_ci->security->get_csrf_token_name() . '=' . urlencode($this->_ci->security->get_csrf_hash()) . '&search_term=' . urlencode($search_term) . '&sort_by=' . $sort_by . '&sort_order=' . $sort_order . '';

            if (!empty($records))
            {
            ?>
                <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">
                    <?php echo form_open(); ?>
                    <tbody bgcolor="#fff">
                        <tr>
                            <th width="30px"><input type="checkbox" name="check_all" id="check_all" value="0"></th>
                            <th width="30px"><?php echo lang('no') ?></th><th>
                                <?php
                                $field_sort_order = 'asc';
                                $sort_image = 'srt_down.png';
                                if ($sort_by == 'question' && $sort_order == 'asc')
                                {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('question', '<?php echo $field_sort_order; ?>');" >
                                    Question
                                    <?php
                                    if ($sort_by == 'question')
                                    {
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
                                if ($sort_by == 'answer' && $sort_order == 'asc')
                                {
                                    $sort_image = 'srt_up.png';
                                    $field_sort_order = 'desc';
                                }
                                ?>
                                <a href="#" onclick="sort_data('answer', '<?php echo $field_sort_order; ?>');" >
                                    Answer
                                    <?php
                                    if ($sort_by == 'answer')
                                    {
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
                        if ($page_number > 1)
                        {
                            $i = ($this->_ci->session->userdata[get_section($this->_ci)]['record_per_page'] * ($page_number - 1)) + 1;
                        }
                        else
                        {
                            $i = 1;
                        }
                        foreach ($records as $record)
                        {
                            if ($i % 2 != 0)
                            {
                                $class = "odd-row";
                            }
                            else
                            {
                                $class = "even-row";
                            }
                            ?>
                            <tr class="<?php echo $class; ?> rows" >
                                <td><input type="checkbox" id="<?php echo $record['R']['id']; ?>" name="check_box[]" class="check_box" value="<?php echo $record['R']['id']; ?>"></td>
                                <td><?php echo $i; ?></td><td><?php echo $record['R']['question']; ?></td><td><?php echo $record['R']['answer']; ?></td>
                                <td>
                                    <div class="action">
                                        <?php $record_id = $record['R']['id']; ?>
                                        <div class="edit"><a href="<?php echo site_url(); ?>admin/faq/action/edit/<?php echo $record_id ?>" title="<?php echo lang('edit') ?>"><?php echo add_image(array('edit.png')); ?></a></div>
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
            'base_url' => base_url() . "admin/faq/index",
            'params' => $querystr,
            'element' => 'ajax_table'
        );

        widget('custom_pagination', $options);
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
    
    

    function delete_record(id){        
        res = confirm('<?php echo lang('delete-alert') ?>');    
        if(res){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>admin/faq/delete',
                data:{<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',id:id},
                success: function(data) {
                    //for managing same state while record delete
                    if($('.rows') && $('.rows').length > 1){
                        pageno = "&page_number=<?php echo $page_number; ?>";                        
                    }else{
                        pageno = "&page_number=<?php echo $page_number - 1; ?>";                        
                    }                    
                    ajaxLink('<?php echo base_url(); ?>admin/faq/index','ajax_table','<?php echo $querystr; ?>'+pageno);
                    
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
        if($('#search_term').val() == ''){
            $('#search_term').validationEngine('showPrompt', '<?php echo lang('msg-search-req'); ?>', 'error');
            attach_error_event(); //for remove dynamically populate popup
            return false;
        }        
        blockUI();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>admin/faq/index',
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
            url:'<?php echo base_url(); ?>admin/faq/index',
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
            url:'<?php echo base_url(); ?>admin/faq/index',
            data:{<?php echo $this->_ci->security->get_csrf_token_name(); ?>:'<?php echo $this->_ci->security->get_csrf_hash(); ?>',search_term:""},
            success: function(data) {
                $("#ajax_table").html(data);
                unblockUI();
            }
        });         
    }
    
</script>
