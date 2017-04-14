<?php

class Request_redeems_admin extends Base_Admin_Controller {

    function __construct() {
        parent::__construct();

        //Logic
        $this->access_control($this->access_rules());

        $this->load->library('form_validation');
        $this->load->model('request_redeems_model');
    }

    /**
     * Function for set permission
     * @return array
     */
    private function access_rules() {
        return array(
            array(
                'actions' => array('index', 'action', 'delete', 'save', 'view_data', 'pay','paymentsuccess'),
                'users' => array('@'),
            )
        );
    }

    /**
     * Function index for listing
     * @return array
     */
    function index() {
        //Paging parameters
        $offset = get_offset($this->page_number, $this->record_per_page);
        $this->request_redeems_model->record_per_page = $this->record_per_page;
        $this->request_redeems_model->offset = $offset;

        //set sort/search parameters in pagging
        if ($this->input->post()) {
            $data = $this->input->post();
            if (isset($data['search_term'])) {
                $this->request_redeems_model->search_term = $data['search_term'];
            }
            if (isset($data['sort_by']) && $data['sort_order']) {
                $this->request_redeems_model->sort_by = $data['sort_by'];
                $this->request_redeems_model->sort_order = $data['sort_order'];
            }
        }

        //Get role listing data
        $records = $this->request_redeems_model->get_record_listing();
        $this->request_redeems_model->_record_count = true;
        $total_records = $this->request_redeems_model->get_record_listing();

        // Pass data to view file  
        $data['records'] = $records;
        $data['page_number'] = $this->page_number;
        $data['total_records'] = $total_records;
        $data['search_term'] = $this->request_redeems_model->search_term;
        $data['sort_by'] = $this->request_redeems_model->sort_by;
        $data['sort_order'] = $this->request_redeems_model->sort_order;

        //Render view
        $this->theme->view($data);
    }

    public function pay() {
        $data = $this->input->post();
        $amount = (isset($data['amount']) && $data['amount'] != '') ? $data['amount'] : 0;
        $eventName = (isset($data['event_name']) && $data['event_name'] != '') ? $data['event_name'] : 'Event';
        $user_id = (isset($data['user_id']) && $data['user_id'] != '') ? $data['user_id'] : '';
        $event_join_ids = (isset($data['event_join_ids']) && $data['event_join_ids'] != '') ? $data['event_join_ids'] : '';
        $event_id = (isset($data['event_id']) && $data['event_id'] != '') ? $data['event_id'] : '';
        
        $record_id = (isset($data['request_id']) && $data['request_id'] != '') ? $data['request_id'] : '';
        if ($record_id != '') {
            $this->load->library('paypal_lib');

            $this->session->set_custom_userdata($this->section_name, array('redeem_request_data' => $data));

            $returnURL = base_url() . '/admin/request_redeems/paymentsuccess/' . $record_id; //payment success url
            $cancelURL = base_url() . '/admin/request_redeems/paymentsuccess/' . $record_id; //payment cancel url
            $notifyURL = base_url() . '/admin/request_redeems/paymentsuccess/' . $record_id; //ipn url

            $item_name = 'Payment for ' . $eventName;
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', $item_name);
            $this->paypal_lib->add_field('custom', $record_id);
            $this->paypal_lib->add_field('item_number', 1);
            $this->paypal_lib->add_field('amount', $amount);
            //$this->paypal_lib->image($logo);

            $this->paypal_lib->paypal_auto_form();
        } else {
            redirect('/admin/request_redeems');
        }
    }

    public function paymentsuccess($record_id) {

        $paypalInfo = $this->input->post();

        if ($record_id == '') {
            $record_id = (isset($paypalInfo['custom'])) ? $paypalInfo['custom'] : '';
        }
        $paymentJoinData['request_redeem_id'] = $record_id;
        $paymentJoinData['payer_email'] = (isset($paypalInfo['payer_email'])) ? $paypalInfo['payer_email'] : '';
        $paymentJoinData['payer_paypal_id'] = (isset($paypalInfo['payer_id'])) ? $paypalInfo['payer_id'] : '';
        $paymentJoinData['txn_id'] = (isset($paypalInfo['txn_id'])) ? $paypalInfo['txn_id'] : '';
        $paymentJoinData['payment_fee'] = (isset($paypalInfo['payment_fee'])) ? $paypalInfo['payment_fee'] : '';
        $paymentJoinData['payment_gross'] = (isset($paypalInfo['payment_gross'])) ? $paypalInfo['payment_gross'] : '';
        $paymentJoinData['payment_status'] = (isset($paypalInfo['payment_status'])) ? $paypalInfo['payment_status'] : '';
        $paymentJoinData['receiver_paypal_id'] = (isset($paypalInfo['receiver_id'])) ? $paypalInfo['receiver_id'] : '';
        $paymentJoinData['receiver_email'] = (isset($paypalInfo['business'])) ? $paypalInfo['business'] : '';
        $paymentJoinData['verify_sign'] = (isset($paypalInfo['verify_sign'])) ? $paypalInfo['verify_sign'] : '';
        if ($paymentJoinData['txn_id'] != '') {
            $event_join_payment_id = $this->request_redeems_model->reuest_redeem_payment($paymentJoinData);
           //pre($this->session->userdata[$this->section_name]['redeem_request_data']);
            if ($paymentJoinData['payment_status'] == 'Completed') {
                $this->updatePaymentInfo($this->session->userdata[$this->section_name]['redeem_request_data']);              
            }
        }        
        $this->theme->set_message(lang('You have successfully join the event'), "success");
        redirect('/admin/request_redeems');
        exit;
    }
    
    public function updatePaymentInfo($requestData){
        if(isset($requestData['request_id'])){
            $this->request_redeems_model->request_redeem_status($requestData['request_id']);
        }
        
        if(isset($requestData['event_join_ids'])){
            $this->request_redeems_model->event_join_redeem_status($requestData['event_join_ids']);
        }
        return;
    }

    /**
     * Function action to perform insert & update by action parameter
     * @param string $action default = 'add'  
     * @param integer $id default = 0
     */
    public function action($action = "add", $id = 0) {
        //Type Casting 
        $id = intval($id);
        $action = trim(strip_tags($action));
        custom_filter_input('integer', $id);

        //Variable Assignment	
        $event_name = "";
        $user_name = "";
        $amount = "";

        //Logic
        switch ($action) {
            case 'add':
                break;
            case 'edit':
                $result = $this->request_redeems_model->get_record_by_id($id);
                if (!empty($result)) {
                    //Variable assignment for edit view
                    $event_name = $result['event_name'];
                    $user_name = $result['user_name'];
                    $amount = $result['amount'];
                } else {
                    redirect('admin/test');
                }
                break;
            default :
                $this->theme->set_message(lang('action-not-allowed'), 'error');
                redirect('admin/test');
                break;
        }

        // Pass data to view file 

        $data['id'] = $id;
        $data['event_name'] = $event_name;
        $data['user_name'] = $user_name;
        $data['amount'] = $amount;

        //Render view
        $this->theme->view($data, 'admin_add');
    }

    /**
     * Function action to perform insert & update by action parameter
     * @param string $action default = 'add'  
     * @param integer $id default = 0
     */
    public function save() {
        if ($this->input->post('mysubmit')) {
            $data = $this->input->post();

            //Type Casting 
            $id = intval($data['id']);

            //Variable Assignment   
            $event_name = trim($data['event_name']);
            $user_name = trim($data['user_name']);
            $amount = trim($data['amount']);
            $this->form_validation->set_rules('event_name', 'event name', 'required|trim|xss_clean|max_length[255]');
            $this->form_validation->set_rules('user_name', 'User Name', 'required|trim|xss_clean|max_length[255]');
            $this->form_validation->set_rules('amount', 'amount', 'required|trim|is_numeric|max_length[255]');

            if ($this->form_validation->run()) {
                $data_array = array(
                    'id' => $id,
                    'event_name' => $event_name,
                    'user_name' => $user_name,
                    'amount' => $amount
                );

                // run insert model to write data to db
                $lastId = $this->request_redeems_model->save_record($data_array);

                if ($id == 0) {
                    $this->theme->set_message(lang('record-add-success'), 'success');
                } else {
                    $this->theme->set_message(lang('record-edit-success'), 'success');
                }

                redirect('admin/test');
                exit;
            }
        } else {
            $event_name = "";
            $user_name = "";
            $amount = "";
        }

        // Pass data to view file
        $data['event_name'] = $event_name;
        $data['user_name'] = $user_name;
        $data['amount'] = $amount;

        //create breadcrumbs & page-title
        if ($id == '') {
            $this->theme->set('page_title', lang('add-record'));
            $this->breadcrumb->add(lang('add-record'));
        } else {
            $this->theme->set('page_title', lang('edit-record'));
            $this->breadcrumb->add(lang('edit-record'));
        }

        //Render view
        $this->theme->view($data, 'admin_add');
    }

    /**
     * Function delete to Role (Ajax-Post)
     */
    function delete() {
        $data = $this->input->post();
        $id = intval($data['id']);

        $result = $this->request_redeems_model->get_record_by_id($id);
        if (!empty($result)) {
            $res = $this->request_redeems_model->delete_record($id);
            if ($res) {
                $message = $this->theme->message(lang('record-delete-success'), 'success');
            }
        } else {
            $message = $this->theme->message(lang('invalid-id-msg'), 'error');
        }

        //message
        echo $message;
    }

}

?>