<div id="ajax_table" style="text-align: left;">
    <div class="main-container" >                      
        <div class="grid-data grid-data-table">              
            <div class="search-box">
                <table cellspacing="2" cellpadding="4" border="0">
                    <tbody>
                        <tr>
                            <td align="right"><?php echo lang('search_by_title');?>:</td>
                            <td align="left">
                                <?php
                                $input_data = array(
                                    'name' => 'search_term',
                                    'id' => 'search_term',
                                    'title' => 'search',
                                    'value' => set_value('search_term',urldecode($search_term))
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
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="add-new">

                <?php echo anchor(get_current_section($this).'/settings/action/add',lang('settings-add'),'title="Add Setting" style="text-align:center;width:100%;"');?>
            </div>
            <?php
            if(!empty($settings))
            {
                ?>
                <table cellspacing="1" cellpadding="4" border="0" bgcolor="#e6ecf2" width="100%">            
                    <tbody bgcolor="#fff">

                    <th><?php echo lang('setting-id');?></th>
                    <th>
                        <?php
                        $field_sort_order = 'asc';
                        $sort_image = 'srt_down.png';
                        if($sort_by == 's.setting_title' && $sort_order == 'asc')
                        {
                            $sort_image = 'srt_up.png';
                            $field_sort_order = 'desc';
                        }
                        ?>
                        <a href="javascript:;" onclick="sort_data('s.setting_title', '<?php echo $field_sort_order;?>');" >
                            <?php echo lang('setting-title');?>
                            <?php
                            if($sort_by == 's.setting_title')
                            {
                                ?>
                                <div class="sorting">
                                    <?php echo add_image(array($sort_image));?>
                                </div>
                            <?php }
                            ?>
                        </a>
                    </th>                    
                    <th><?php echo lang('setting-label');?></th>
                    <th><?php echo lang('setting-value');?></th>
                    <th><?php echo lang('setting-comment');?></th>
                    <th><?php echo lang('setting-action');?></th>

                    <?php
                    if($page_number > 1)
                    {
                        $i = ($this->session->userdata[get_current_section($this)]['record_per_page']*($page_number-1)) +1;
                    }
                    else
                    {
                        $i = 1;
                    }
                    foreach ($settings as $data)
                    {
                        //take alias from an array
                        $alias = end(array_keys($data));
                        if($i % 2 != 0)
                        {
                            $class = "odd-row";
                        }
                        else
                        {
                            $class = "even-row";
                        }
                        ?>
                        <tr class="<?php echo $class;?> rows" id="row-<?php echo $data[$alias]['id'];?>">
                            <td><?php echo $i;?></td>
                            <td><?php echo $data[$alias]['setting_title'];?></td>
                            <td><?php echo $data[$alias]['setting_label'];?></td>                  
                            <td><?php echo $data[$alias]['setting_value'];?></td>
                            <td><?php echo $data[$alias]['comment'];?></td>
                            <td>
                                <div class="action">
                                    <div style="float:left;padding-right:10px;"><a title='View' href="<?php echo site_url().get_current_section($this);?>/settings/view_data/<?php echo $data[$alias]['id']; ?>"><?php echo  add_image(array('viewIcon.png')); ?></a></div>
                                    <div class="edit"><a href="<?php echo base_url().get_current_section($this).'/settings/action/edit/' . $data[$alias]['id'];?>" title="Edit"><?php echo add_image(array('edit.png'));?></a></div>
                                    <div class="delete"><a href="javascript:;" title="Delete" onclick="delete_settings(<?php echo $data[$alias]['id'];?>)"><?php echo add_image(array('delete.png'));?></a></div>
                                </div>    
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>                
                    </tbody>            
                </table>

                <?php
            }
            else
            {
                ?><table>
                    <tr>
                        <td><?php echo lang('setting-message-norec')?></td>
                    </tr>
                </table>
                <?php
            }
            $querystr = $this->theme->ci()->security->get_csrf_token_name() . '=' . urlencode($this->theme->ci()->security->get_csrf_hash()) . '&search_term=' . $search_term . '&sort_by=' . $sort_by . '&sort_order=' . $sort_order . '';
            $options = array(
                'total_records' => $total_records,
                'page_number' => $page_number,
                'isAjaxRequest' => 1,
                'base_url' => base_url().get_current_section($this)."/settings/index",
                'params' => $querystr,
                'element' => 'ajax_table'
            );
            widget('custom_pagination',$options);
            ?>

        </div>
    </div>   
    <script type="text/javascript">	
        $("#search_term").keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                submit_search();
            }
        });
        function delete_settings(id){        
            res = confirm('<?php echo lang('confirm-delete-msg');?>');    
            if(res){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url().get_current_section($this);?>/settings/delete',
                    data:{<?php echo $this->theme->ci()->security->get_csrf_token_name();?>:'<?php echo $this->theme->ci()->security->get_csrf_hash();?>',id:id},
                    success: function(data) {                        
                        //for managing same state while record delete
                        if($('.rows') && $('.rows').length > 1){
                            pageno = "&page_number=<?php echo $page_number;?>";                        
                        }else{
                            pageno = "&page_number=<?php echo $page_number - 1;?>";                        
                        }                    
                        ajaxLink('<?php echo base_url().get_current_section($this);?>/settings/index','ajax_table','<?php echo $querystr;?>'+pageno);
                    
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
            $('#error_msg').fadeOut(1000);
            /*if($('#search_term').val().trim() == ''){
                $('#search_term').validationEngine('showPrompt', '<?php echo lang('msg-search-req');?>', 'error');
                attach_error_event(); //for remove dynamically populate popup
                return false;
            }*/
            blockUI();
            $.ajax({
                type:'POST',
                url:'<?php echo base_url().get_current_section($this);?>/settings/index',
                data:{<?php echo $this->theme->ci()->security->get_csrf_token_name();?>:'<?php echo $this->theme->ci()->security->get_csrf_hash();?>',search_term:$('#search_term').val()},
                success: function(data) {
                    $("#ajax_table").html(data);
                    unblockUI();
                }
            });             
        }
    
        function sort_data(sort_by,sort_order)
        {           
            blockUI('removeError');
            $.ajax({
                type:'POST',
                url:'<?php echo base_url().get_current_section($this);?>/settings/index',
                data:{<?php echo $this->theme->ci()->security->get_csrf_token_name();?>:'<?php echo $this->theme->ci()->security->get_csrf_hash();?>',search_term:$('#search_term').val(),sort_by:sort_by,sort_order:sort_order},
                success: function(data) {                    
                    $("#ajax_table").html(data);                    
                    unblockUI();
                }
            });             
        }
        
        function reset_data()
        {           
            blockUI('removeError');
            $.ajax({
                type:'POST',
                url:'<?php echo base_url().get_current_section($this);?>/settings/index',
                data:{<?php echo $this->theme->ci()->security->get_csrf_token_name();?>:'<?php echo $this->theme->ci()->security->get_csrf_hash();?>',search_term:""},
                success: function(data) {
                    $("#ajax_table").html(data);
                    unblockUI();
                }
            });         
        }
    </script>
</div>   
