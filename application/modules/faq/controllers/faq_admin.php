<?php

class Faq_admin extends Base_Admin_Controller {
               
    function __construct()
    {
        parent::__construct();
                
        //Logic
        $this->access_control($this->access_rules());
        
        $this->load->library('form_validation');
        $this->load->model('faq_model');
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
        $this->faq_model->record_per_page = $this->record_per_page;
        $this->faq_model->offset = $offset;
            
        //set sort/search parameters in pagging
        if ($this->input->post())
        {
            $data = $this->input->post();
            if (isset($data['search_term']))
            {
                $this->faq_model->search_term = $data['search_term'];
            }
            if (isset($data['sort_by']) && $data['sort_order'])
            {
                $this->faq_model->sort_by = $data['sort_by'];
                $this->faq_model->sort_order = $data['sort_order'];
            }
        }
        
        //Get role listing data
        $records = $this->faq_model->get_record_listing();
        $this->faq_model->_record_count = true;
        $total_records = $this->faq_model->get_record_listing();
            
        // Pass data to view file  
        $data['records'] = $records;
        $data['page_number'] = $this->page_number;
        $data['total_records'] = $total_records;
        $data['search_term'] = $this->faq_model->search_term;
        $data['sort_by'] = $this->faq_model->sort_by;
        $data['sort_order'] = $this->faq_model->sort_order;
            
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
        $question = "";	
        $answer = "";
            
        //Logic
        switch ($action)
        {
            case 'add':
                break;
            case 'edit':
                $result = $this->faq_model->get_record_by_id($id);
                if (!empty($result))
                {
                    //Variable assignment for edit view
                    $question = $result['question'];
                    $answer = $result['answer'];
                }
                else
                {
                    redirect('admin/faq');
                }
                break;
            default :
                $this->theme->set_message(lang('action-not-allowed'), 'error');
                redirect('admin/faq');
                break;
        }
        
        // Pass data to view file 
        
        $data['id'] = $id;
        $data['question'] = $question;
        $data['answer'] = $answer;
					
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
            $question = trim($data['question']);
            $answer = trim($data['answer']);			
            $this->form_validation->set_rules('question', 'Question', 'required|trim|max_length[255]');			
            $this->form_validation->set_rules('answer', 'Answer', 'required|trim|max_length[5000]');
			
            if ($this->form_validation->run())
            {
                $data_array = array(
                'id' => $id,
                    'question' => $question,
                    'answer' => $answer
                    );
					
                // run insert model to write data to db
                $lastId = $this->faq_model->save_record($data_array);

                if ($id == 0)
                {
                    $this->theme->set_message(lang('record-add-success'), 'success');
                }
                else
                {
                    $this->theme->set_message(lang('record-edit-success'), 'success');
                }

                redirect('admin/faq');
                exit;
            }
        }
        else
        {
            $question = "";
            $answer = "";
        }
    
        // Pass data to view file
        $data['question'] = $question;
        $data['answer'] = $answer;
        
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

        $result = $this->faq_model->get_record_by_id($id);
        if (!empty($result))
        {
            $res = $this->faq_model->delete_record($id);
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