<?php

class Request_redeems_model extends Base_Model {

    protected $_tbl_request_redeems = TBL_REQUEST_REDEEM;
    protected $_tbl_events = TBL_event;
    protected $_tbl_users = TBL_USERS;
    protected $_tbl_redeem_payment = TBL_EVENT_REDEEM_PAYMENT;
    protected $_tbl_event_join = TBL_event_join;
    public $search_term = "";
    public $sort_by = "";
    public $sort_order = "";

    function __construct() {
        parent::__construct();
    }

    /**
     * Function get_role_listing to fetch all records of roles
     */
    function get_record_listing() {
        if (isset($this->search_term) && $this->search_term != "") {
            $this->db->like("LOWER(R.event_name)", strtolower($this->search_term));
        }
        if (isset($this->sort_by) && $this->sort_by != "" && $this->sort_order != "") {
            $this->db->order_by('R.' . $this->sort_by, $this->sort_order);
        }
        if (isset($this->record_per_page) && isset($this->offset) && !isset($this->_record_count) && $this->_record_count != true) {
            $this->db->limit($this->record_per_page, $this->offset);
        }

        $this->db->select('R.*,e.title as event_names,e.id as event_id,u.id as user_id,u.firstname,u.lastname');
        $this->db->from($this->_tbl_request_redeems . ' AS R');
        $this->db->join($this->_tbl_events . ' as e', ('e.id = R.event_id'), 'inner');
        $this->db->join($this->_tbl_users . ' as u', ('u.id = R.user_id'), 'inner');
        $this->db->where('u.status', 1);
        $this->db->where('R.paid', 0);
        $this->db->where('e.status', 1);
        $query = $this->db->get();
        if (isset($this->_record_count) && $this->_record_count == true) {
            return count($this->db->custom_result($query));
        } else {
            return $this->db->custom_result($query);
        }

        return $result;
    }

    public function reuest_redeem_payment($data) {
        $request_redeem_data = array();
        if (isset($data['request_redeem_id'])) {
            $request_redeem_data['request_redeem_id'] = $data['request_redeem_id'];
        }
        if (isset($data['payer_email'])) {
            $request_redeem_data['payer_email'] = $data['payer_email'];
        }
        if (isset($data['payer_paypal_id'])) {
            $request_redeem_data['payer_paypal_id'] = $data['payer_paypal_id'];
        }
        if (isset($data['txn_id'])) {
            $request_redeem_data['txn_id'] = $data['txn_id'];
        }
        if (isset($data['payment_fee'])) {
            $request_redeem_data['payment_fee'] = $data['payment_fee'];
        }
        if (isset($data['payment_gross'])) {
            $request_redeem_data['payment_gross'] = $data['payment_gross'];
        }
        if (isset($data['payment_status'])) {
            $request_redeem_data['payment_status'] = $data['payment_status'];
        }
        if (isset($data['receiver_paypal_id'])) {
            $request_redeem_data['receiver_paypal_id'] = $data['receiver_paypal_id'];
        }
        if (isset($data['receiver_email'])) {
            $request_redeem_data['receiver_email'] = $data['receiver_email'];
        }
        if (isset($data['verify_sign'])) {
            $request_redeem_data['verify_sign'] = $data['verify_sign'];
        }

        $this->db->set('created', 'NOW()', FALSE);
        if ($this->db->insert($this->_tbl_redeem_payment, $request_redeem_data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return 0;
    }
    
    function request_redeem_status($id){
        $this->db->set('modified', 'NOW()', FALSE);
        $this->db->where('id', $id);
        $this->db->set('paid', '1');
        return $this->db->update($this->_tbl_request_redeems);
    }
    
    function event_join_redeem_status($eventJoinIds){
        $eventIdsArray = explode(',',$eventJoinIds);
        $event_join_data['redeem_status'] = 1;
        
        $this->db->where_in('id', $eventIdsArray);
        $this->db->update($this->_tbl_event_join, $event_join_data);
    }
    
    /**
     * Function get_record_by_id to fetch records by id
     * @param int $id default = 0
     */
    function get_record_by_id($id = 0) {
        //Type Casting 
        $id = intval($id);

        $this->db->select('*');
        $this->db->from($this->_tbl_request_redeems);
        $this->db->where('id', $id);
        $result = $this->db->get();

        return $result->row_array();
    }

    /**
     * Function save_record to add/update record 
     * @param array $data 
     */
    public function save_record($data) {
        //Type Casting 
        $id = intval($data['id']);

        if ($id != 0 && $id != "") {
            $this->db->where('id', $id);
            $this->db->update($this->_tbl_request_redeems, $data);
            $id = $id;
        } else {
            $this->db->insert($this->_tbl_request_redeems, $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    /**
     * Function delete_record to delete record 
     * @param int $id 
     */
    public function delete_record($id) {
        //Type Casting 
        $id = intval($id);

        $this->db->where('id', $id);
        return $this->db->delete($this->_tbl_request_redeems);
    }

}

?>