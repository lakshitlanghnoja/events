<?php

/**
 *  Events Controller (Front)
 *
 *  To perform login,registration and forgot password process.
 *
 * @package CIDemoApplication
 * @subpackage Users
 * @copyright	(c) 2013, TatvaSoft
 * @author panks
 */
class Events extends Base_Front_Controller {

    function __construct() {
        parent::__construct();
        //load helpers
        $this->theme->set_theme("events");
        $this->load->helper(array('url', 'cookie', 'captcha'));
        $this->load->library('form_validation');
        //$this->access_control($this->access_rules());
    }

    /**
     * Function access_rules to check login
     */
    private function access_rules() {
        return array(
            array(
                'actions' => array('action', 'search', 'create', 'index', 'paypal_test', 'joinevent', 'paymentsuccess', 'complete_event', 'request_redeem'),
                'users' => array('*'),
            ),
            array(
                'actions' => array('joinevent'),
                'users' => array('@'),
            )
        );
    }

    function index($slug_url = NULL) {
        if ($slug_url == '' || $slug_url == NULL) {
            redirect('/');
        }
        $stateModel = $this->load->model('states/states_model');
        $eventData = $this->events_model->getEventDetailBySlug($slug_url);
        $taxPersent = 0;
        if (isset($eventData['source_state']) && !empty($eventData['source_state'])) {
            $taxPersent = $stateModel->get_record_by_state_name($eventData['source_state']);
        }

        $eventData['tax_persent'] = $taxPersent;
        if (isset($eventData['id']) && !empty($eventData['id'])) {
            $eventRatings = $this->events_model->getEventRatings($eventData['id']);
            if (isset($eventRatings['event_rating']) && !empty($eventRatings['event_rating'])) {
                $eventData['event_rating'] = $eventRatings['event_rating'];
            }

            $userJoined = $this->events_model->getEventJoinedUser($eventData['id']);
            if (isset($userJoined['userJoined']) && !empty($userJoined['userJoined'])) {
                $eventData['userJoined'] = $userJoined['userJoined'];
            }
        }
        $this->theme->view($eventData);
    }

    public function joinevent() {
        if (!isset($this->session->userdata[$this->section_name]['user_id'])) {
            redirect("/");
        }
        $postData = $this->input->post();
        $item_name = (isset($postData['item_name']) && $postData['item_name'] != '') ? $postData['item_name'] : '';
        $totalSheets = (isset($postData['total_sheet']) && $postData['total_sheet'] != '') ? $postData['total_sheet'] : 0;
        $amount = (isset($postData['amount']) && $postData['amount'] != '') ? $postData['amount'] : '';

        $eventJoinData['event_id'] = (isset($postData['event_id']) && $postData['event_id'] != '') ? $postData['event_id'] : '';
        $eventJoinData['user_id'] = $this->session->userdata[$this->section_name]['user_id'];
        $eventJoinData['number_of_sheets'] = $totalSheets;


        $event_join_id = $this->events_model->join_event($eventJoinData);

        $this->load->library('paypal_lib');

        $returnURL = base_url() . 'events/paymentsuccess/' . $event_join_id; //payment success url
        $cancelURL = base_url() . 'events/paymentsuccess/' . $event_join_id; //payment cancel url
        $notifyURL = base_url() . 'events/paymentsuccess/' . $event_join_id; //ipn url
        //get particular product data
        //$product = $this->product->getRows($id);
        $userID = 1; //current user id
        //$logo = base_url().'assets/images/codexworld-logo.png';

        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $item_name);
        $this->paypal_lib->add_field('custom', $event_join_id);
        $this->paypal_lib->add_field('item_number', 1);
        $this->paypal_lib->add_field('amount', $amount);
        //$this->paypal_lib->image($logo);

        $this->paypal_lib->paypal_auto_form();
    }

    public function paymentsuccess($eventJoinId) {

        $paypalInfo = $this->input->post();

        if ($eventJoinId == '') {
            $eventJoinId = (isset($paypalInfo['custom'])) ? $paypalInfo['custom'] : '';
        }
        $paymentJoinData['even_join_id'] = $eventJoinId;
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
            $event_join_payment_id = $this->events_model->join_event_payment($paymentJoinData);

            if ($paymentJoinData['payment_status'] == 'Completed') {
                $updateEventJoinData['payment_status'] = 1;
                $event_join_payment_id = $this->events_model->update_event_join($eventJoinId, $updateEventJoinData);
            }
        }


        $eventSlug = $this->events_model->get_event_slug_by_event_join($eventJoinId);
        $this->theme->set_message(lang('You have successfully join the event'), "success");
        redirect('events/index/' . $eventSlug);
        exit;
    }

    public function complete_event() {
        if (!isset($this->session->userdata[$this->section_name]['user_id'])) {
            redirect("/");
        }
        $postData = $this->input->post();

        $data['event_id'] = (isset($postData['event_id'])) ? $postData['event_id'] : '';
        $data['event_join_id'] = (isset($postData['event_join_id'])) ? $postData['event_join_id'] : '';
        $data['rate'] = (isset($postData['eventRate'])) ? $postData['eventRate'] : '';
        $data['review'] = (isset($postData['review'])) ? $postData['review'] : '';
        $data['user_id'] = (isset($postData['user_id'])) ? $postData['user_id'] : $this->session->userdata[$this->section_name]['user_id'];

        if ($data['event_join_id'] != '') {
            $evetRateId = $this->events_model->complete_event($data);
            if ($evetRateId) {
                $return['status'] = 1;
                $return['msg'] = 'Review has been submitted successfully.';
            } else {
                $return['status'] = 0;
                $return['msg'] = 'Unable to save your review. Please try again later.';
            }
        } else {
            $return['status'] = 0;
            $return['msg'] = 'Invalid request.';
        }
        echo json_encode($return);
        exit;
    }

    function request_redeem() {
        if (!isset($this->session->userdata[$this->section_name]['user_id'])) {
            redirect("/");
        }
        $postData = $this->input->post();
        $request['event_id'] = (isset($postData['event_id'])) ? $postData['event_id'] : '';
        $request['user_id'] = (isset($postData['user_id'])) ? $postData['user_id'] : $this->_ci->session->userdata['front']['user_id'];
        $request['event_join_ids'] = (isset($postData['event_join_ids'])) ? $postData['event_join_ids'] : '';
        $request['amount'] = (isset($postData['amount'])) ? $postData['amount'] : '';

        if ($this->events_model->request_redeem($request)) {
            $return['status'] = 1;
            $return['msg'] = 'Request has been sent.';
        } else {
            $return['status'] = 0;
            $return['msg'] = 'Unable to send your request. Please try again later.';
        }
        echo json_encode($return);
        exit;
    }

    /*
     *  Function index for login
     */

    function search() {

        if ($this->input->post()) {
            $data = $this->input->post();
            //echo "<pre/>"; print_r($data);
            // Search Term ***
            if (isset($data['search_term']) && !empty($data['search_term'])) {
                $this->events_model->search_term = trim($data['search_term']);
                $this->session->set_custom_userdata($this->section_name, "event_search_term", $this->input->post('search_term'));
            } else {
                $this->session->set_custom_userdata($this->section_name, "event_search_term", "");
            }

            // Filter section
            if (isset($data['filter_duration']) && !empty($data['filter_duration'])) {
                $this->events_model->filter_duration = trim($data['filter_duration']);
                $this->session->set_custom_userdata($this->section_name, "filter_duration", $this->input->post('filter_duration'));
            } else {
                $this->session->set_custom_userdata($this->section_name, "filter_duration", "");
            }

            if (isset($data['filter_price']) && !empty($data['filter_price'])) {
                $this->events_model->filter_price = trim($data['filter_price']);
                $this->session->set_custom_userdata($this->section_name, "filter_price", $this->input->post('filter_price'));
            } else {
                $this->session->set_custom_userdata($this->section_name, "filter_price", "");
            }

            //echo "<pre/>"; print_r($this->session->userdata);			

            $events = $this->events_model->get_search_result();
            if (count($events) > 0) {
                $data['events'] = $events;
            } else {
                $data['events'] = array();
            }
        }
        $this->events_model->search_term = '';
        $this->events_model->filter_duration = '';
        $this->events_model->filter_price = '';
        $eventsOthers = $this->events_model->get_search_result();
        if (count($eventsOthers) > 0) {
            $data['eventsOthers'] = $eventsOthers;
        } else {
            $data['eventsOthers'] = array();
        }

        $this->theme->set('page_title', 'search-result');
        $this->theme->view($data, 'searchResult');
    }

    function create() {
        $data = array();
        //echo "<pre/>"; print_r($this->input->post());
        //echo "<pre/>"; print_r($_FILES);

        if ($this->input->post()) {
            if (!empty($_FILES['galleryImages']['name'])) {
                $filesCount = count($_FILES['galleryImages']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['galleryImage']['name'] = round(microtime(true)) . '.' . end(explode(".", $_FILES['galleryImages']['name'][$i]));
                    $_FILES['galleryImage']['type'] = $_FILES['galleryImages']['type'][$i];
                    $_FILES['galleryImage']['tmp_name'] = $_FILES['galleryImages']['tmp_name'][$i];
                    $_FILES['galleryImage']['error'] = $_FILES['galleryImages']['error'][$i];
                    $_FILES['galleryImage']['size'] = $_FILES['galleryImages']['size'][$i];

                    $uploadPath = 'themes/events/uploads';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('galleryImage')) {
                        echo "file juploading";
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                    }
                }
            }

            $data = $this->input->post();
            //echo "<pre/>"; print_r($uploadData);
            //echo "<pre/>"; print_r($_FILES['galleryImages']['name']);exit;
        }

        $this->theme->view($data, 'create');
    }

}
