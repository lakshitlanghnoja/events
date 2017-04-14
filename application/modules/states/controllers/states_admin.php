<?php

class States_admin extends Base_Admin_Controller {
               
    function __construct()
    {
        parent::__construct();
                
        //Logic
        $this->access_control($this->access_rules());
        
        $this->load->library('form_validation');
        $this->load->model('states_model');
    }	
    
    /**
     * Function for set permission
     * @return array
     */
    private function access_rules()
    {
        return array(
            array(
                'actions' => array('index', 'action', 'delete', 'save', 'view_data'),
                'users' => array('@'),
            )
        );
    }
    
    /**
     * Function index for listing
     * @return array
     */
    function index()
    {
        //Paging parameters
        $offset = get_offset($this->page_number, $this->record_per_page);
        $this->states_model->record_per_page = $this->record_per_page;
        $this->states_model->offset = $offset;
            
        //set sort/search parameters in pagging
        if ($this->input->post())
        {
            $data = $this->input->post();
            if (isset($data['search_term']))
            {
                $this->states_model->search_term = $data['search_term'];
            }
            if (isset($data['sort_by']) && $data['sort_order'])
            {
                $this->states_model->sort_by = $data['sort_by'];
                $this->states_model->sort_order = $data['sort_order'];
            }
        }
        
        //Get role listing data
        $records = $this->states_model->get_record_listing();
        $this->states_model->_record_count = true;
        $total_records = $this->states_model->get_record_listing();
            
        // Pass data to view file  
        $data['records'] = $records;
        $data['page_number'] = $this->page_number;
        $data['total_records'] = $total_records;
        $data['search_term'] = $this->states_model->search_term;
        $data['sort_by'] = $this->states_model->sort_by;
        $data['sort_order'] = $this->states_model->sort_order;
            
        //Render view
        $this->theme->view($data);
            
    }
    
    /**
     * Function action to perform insert & update by action parameter
     * @param string $action default = 'add'  
     * @param integer $id default = 0
     */
    public function action($action = "add", $id = 0)
    {
        //Type Casting 
        $id = intval($id);
        $action = trim(strip_tags($action));
        custom_filter_input('integer', $id);  
        
        //Variable Assignment	
        $name = "";	
        $tax = "";
            
        //Logic
        switch ($action)
        {
            case 'add':
                break;
            case 'edit':
                $result = $this->states_model->get_record_by_id($id);
                if (!empty($result))
                {
                    //Variable assignment for edit view
                    $name = $result['name'];
                    $tax = $result['tax'];
                }
                else
                {
                    redirect('admin/states');
                }
                break;
            default :
                $this->theme->set_message(lang('action-not-allowed'), 'error');
                redirect('admin/states');
                break;
        }
        
        // Pass data to view file 
        
        $data['id'] = $id;
        $data['name'] = $name;
        $data['tax'] = $tax;
					
        //Render view
        $this->theme->view($data, 'admin_add');
    }
    
    /**
     * Function action to perform insert & update by action parameter
     * @param string $action default = 'add'  
     * @param integer $id default = 0
     */
    public function save()
    {
        if ($this->input->post('mysubmit'))
        {
            $data = $this->input->post();

            //Type Casting 
            $id = intval($data['id']);

            //Variable Assignment   
            $name = trim($data['name']);
            $tax = trim($data['tax']);			
            $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[255]');			
            $this->form_validation->set_rules('tax', 'Tax', 'required|trim|is_numeric|max_length[255]');
			
            if ($this->form_validation->run())
            {
                $data_array = array(
                'id' => $id,
                    'name' => $name,
                    'tax' => $tax
                    );
					
                // run insert model to write data to db
                $lastId = $this->states_model->save_record($data_array);

                if ($id == 0)
                {
                    $this->theme->set_message(lang('record-add-success'), 'success');
                }
                else
                {
                    $this->theme->set_message(lang('record-edit-success'), 'success');
                }

                redirect('admin/states');
                exit;
            }
        }
        else
        {
            $name = "";
            $tax = "";
        }
    
        // Pass data to view file
        $data['name'] = $name;
        $data['tax'] = $tax;
        
        //create breadcrumbs & page-title
        if ($id == '')
        {
            $this->theme->set('page_title', lang('add-record'));
            $this->breadcrumb->add(lang('add-record'));
        }
        else
        {
            $this->theme->set('page_title', lang('edit-record'));
            $this->breadcrumb->add(lang('edit-record'));
        }
        
        //Render view
        $this->theme->view($data, 'admin_add');
    }
    
    /**
     * Function delete to Role (Ajax-Post)
     */
    function delete()
    {
        $data = $this->input->post();
        $id = intval($data['id']);

        $result = $this->states_model->get_record_by_id($id);
        if (!empty($result))
        {
            $res = $this->states_model->delete_record($id);
            if ($res)
            {
                $message = $this->theme->message(lang('record-delete-success'), 'success');
            }
        }
        else
        {
            $message = $this->theme->message(lang('invalid-id-msg'), 'error');
        }

        //message
        echo $message;
    }
}
?>