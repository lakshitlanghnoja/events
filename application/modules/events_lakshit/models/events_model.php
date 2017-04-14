<?php

/**
 *  Users Model
 *
 *  To perform queries related to user management.
 *
 * @package CIDemoApplication
 * @subpackage Users
 * @copyright	(c) 2013, TatvaSoft
 * @author panks
 */
class Events_model extends Base_Model {

    protected $_tbl_events = TBL_event;
    protected $_tbl_users = TBL_USERS;
    protected $_tbl_event_rating = TBL_event_rating;
    protected $_tbl_event_join = TBL_event_join;
    protected $_tbl_event_join_payment = TBL_EVENT_JOIN_PAYMENT;
    protected $_tbl_request_redeem = TBL_REQUEST_REDEEM;
    public $search_term = "";
    public $filter_price = "";
    public $filter_duration = "";
    public $sort_order = "";
    public $_record_count;

    /**
     * Function save_user to add/update user
     * @param array $data for user table
     * @param array $data_profile for user_profile table
     */
    public function getEventDetailBySlug($slug) {
        $this->db->where("slug", $slug);
        $this->db->join($this->_tbl_users . ' as u', ('u.id = e.user_id'), 'inner');
        $tableEvents = $this->db->get($this->_tbl_events . ' AS e');

        $eventsArray = $tableEvents->row_array();

        if (!empty($eventsArray)) {
            return $eventsArray;
        } else {
            return '';
        }
    }

    public function getEventRatings($eventId) {
        $this->db->select("AVG(er.rate) as event_rating");
        $this->db->from($this->_tbl_event_rating . ' AS er');
        $this->db->join($this->_tbl_events . ' as e', ('e.id = er.event_id'), 'inner');
        $this->db->where('er.event_id', $eventId);
        $this->db->where('e.status', 1);
        $result = $this->db->get();
        $eventsArray = $result->row_array();

        if (!empty($eventsArray)) {
            return $eventsArray;
        } else {
            return '';
        }
    }

    public function getEventJoinedUser($eventId) {
        $this->db->select("sum(ej.number_of_sheets) as userJoined");
        $this->db->from($this->_tbl_event_join . ' AS ej');
        $this->db->join($this->_tbl_events . ' as e', ('e.id = ej.event_id'), 'inner');
        $this->db->where('ej.event_id', $eventId);
        $this->db->where('ej.payment_status', 1);
        $this->db->where('e.status', 1);
        $result = $this->db->get();
        $eventsArray = $result->row_array();
        //echo $sql = $this->db->last_query();
        if (!empty($eventsArray)) {
            return $eventsArray;
        } else {
            return '';
        }
    }

    public function complete_event($data) {
        $event_complete_data = array();
        $event_rate_data = array();
        $flag = 0;

        if (isset($data['event_id'])) {
            $event_rate_data['event_id'] = $data['event_id'];
        }
        if (isset($data['user_id'])) {
            $event_rate_data['user_id'] = $data['user_id'];
        }
        if (isset($data['event_join_id'])) {
            $event_rate_data['event_join_id'] = $data['event_join_id'];
        }
        if (isset($data['rate'])) {
            $event_rate_data['rate'] = $data['rate'];
        }
        if (isset($data['review'])) {
            $event_rate_data['review'] = $data['review'];
        }

        $isReviewed = $this->check_already_reviewed($event_rate_data);
        if ($isReviewed) {
            //update Review
            $this->db->where('event_id', $event_rate_data['event_id']);
            $this->db->where('user_id', $event_rate_data['user_id']);
            $this->db->where('event_join_id', $event_rate_data['event_join_id']);
            $this->db->update($this->_tbl_event_rating, $event_rate_data);
            $flag = 1;
        } else {
            // insert review            
            $this->db->set('created', 'NOW()', FALSE);
            if ($this->db->insert($this->_tbl_event_rating, $event_rate_data)) {
                $id = $this->db->insert_id();
                $flag = 1;
            }
        }

        if ($flag == 1 && isset($data['event_join_id']) && $data['event_join_id'] != '') {
            $event_complete_data['completed'] = 1;
            $event_complete_data['completed_at'] = date('Y-m-d H:i:s');
            $this->db->where('id', $data['event_join_id']);
            $this->db->update($this->_tbl_event_join, $event_complete_data);
            return 1;
        }
        return 0;
    }

    public function request_redeem($data) {
        $requestData = array();
        if (isset($data['event_id'])) {
            $requestData['event_id'] = $data['event_id'];
        }
        if (isset($data['user_id'])) {
            $requestData['user_id'] = $data['user_id'];
        }
        if (isset($data['event_join_ids'])) {
            $requestData['event_join_ids'] = $data['event_join_ids'];
        }
        if (isset($data['amount'])) {
            $requestData['amount'] = $data['amount'];
        }

        $this->db->set('created', 'NOW()', FALSE);
        $this->db->set('requested_at', 'NOW()', FALSE);

        if ($this->db->insert($this->_tbl_request_redeem, $requestData)) {
            $id = $this->db->insert_id();
            $this->updateRedeemStatusforEventJoin($requestData['event_join_ids']);
            return $id;
        }
        return 0;
    }

    public function updateRedeemStatusforEventJoin($eventJoinIds) {
        $eventIdsArray = explode(',',$eventJoinIds);

        $event_join_data['redeem_status'] = 2;
        
        $this->db->where_in('id', $eventIdsArray);
        $this->db->update($this->_tbl_event_join, $event_join_data);
        //echo $this->db->last_query(); exit;
        return 1;
    }

    public function check_already_reviewed($data) {
        $event_id = '';
        $user_id = '';
        if (isset($data['event_id'])) {
            $event_id = $data['event_id'];
        }
        if (isset($data['user_id'])) {
            $user_id = $data['user_id'];
        }
        if (isset($data['event_join_id'])) {
            $join_id = $data['event_join_id'];
        }

        $this->db->select("er.id");
        $this->db->from($this->_tbl_event_rating . ' AS er');
        $this->db->where('er.event_id', $event_id);
        $this->db->where('er.user_id', $user_id);
        $this->db->where('er.event_join_id', $join_id);
        $result = $this->db->get();
        $eventsArray = $result->row_array();
        if (!empty($eventsArray) && isset($eventsArray['id'])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_event_slug_by_event_join($eventJoinId) {
        if ($eventJoinId == '') {
            return '';
        }

        $this->db->select("e.slug");
        $this->db->from($this->_tbl_event_join . ' AS ej');
        $this->db->join($this->_tbl_events . ' as e', ('e.id = ej.event_id'), 'inner');
        $this->db->where('ej.id', $eventJoinId);
        $this->db->where('e.status', 1);
        $result = $this->db->get();
        $eventsArray = $result->row_array();
        //echo $sql = $this->db->last_query();
        if (!empty($eventsArray) && isset($eventsArray['slug'])) {
            return $eventsArray['slug'];
        } else {
            return '';
        }
    }

    public function update_event_join($eventJoinId, $data) {
        $event_join_data = array();
        if (isset($data['payment_status'])) {
            $event_join_data['payment_status'] = $data['payment_status'];
        }

        $this->db->where('id', $eventJoinId);
        $this->db->update($this->_tbl_event_join, $event_join_data);
        return;
    }

    public function join_event($data) {
        $event_join_data = array();
        if (isset($data['event_id'])) {
            $event_join_data['event_id'] = $data['event_id'];
        }
        if (isset($data['user_id'])) {
            $event_join_data['user_id'] = $data['user_id'];
        }
        if (isset($data['number_of_sheets'])) {
            $event_join_data['number_of_sheets'] = $data['number_of_sheets'];
        }


        $this->db->set('created', 'NOW()', FALSE);

        if ($this->db->insert($this->_tbl_event_join, $event_join_data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return 0;
    }

    public function join_event_payment($data) {
        $event_join_data = array();
        if (isset($data['even_join_id'])) {
            $event_join_data['even_join_id'] = $data['even_join_id'];
        }
        if (isset($data['payer_email'])) {
            $event_join_data['payer_email'] = $data['payer_email'];
        }
        if (isset($data['payer_paypal_id'])) {
            $event_join_data['payer_paypal_id'] = $data['payer_paypal_id'];
        }
        if (isset($data['txn_id'])) {
            $event_join_data['txn_id'] = $data['txn_id'];
        }
        if (isset($data['payment_fee'])) {
            $event_join_data['payment_fee'] = $data['payment_fee'];
        }
        if (isset($data['payment_gross'])) {
            $event_join_data['payment_gross'] = $data['payment_gross'];
        }
        if (isset($data['payment_status'])) {
            $event_join_data['payment_status'] = $data['payment_status'];
        }
        if (isset($data['receiver_paypal_id'])) {
            $event_join_data['receiver_paypal_id'] = $data['receiver_paypal_id'];
        }
        if (isset($data['receiver_email'])) {
            $event_join_data['receiver_email'] = $data['receiver_email'];
        }
        if (isset($data['verify_sign'])) {
            $event_join_data['verify_sign'] = $data['verify_sign'];
        }

        $this->db->set('created', 'NOW()', FALSE);
        if ($this->db->insert($this->_tbl_event_join_payment, $event_join_data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return 0;
    }

    /**
     * Function get_user_listing to fetch all records of users
     * @param integer $user_id default = 0
     */
    function get_search_result() {
        if ($this->search_term != "") {
            $this->db->like("source_city", strtolower($this->search_term));
        }

        if ($this->filter_duration != "") {
            //$this->db->order_by($this->sort_by, $this->sort_order);
            $this->db->where("duration BETWEEN 0 AND $this->filter_duration");
        }

        if ($this->filter_price != "") {
            //$this->db->order_by($this->sort_by, $this->sort_order);
            $this->db->where("price BETWEEN 0 AND $this->filter_price");
        }

        $this->db->select('*');
        $this->db->from('events');
        $this->db->where('status', 1);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $this->db->custom_result($query);
    }

    /**
     * Function delete_records to delete URL
     * @param integer $id
     */
    public function delete_records($id = array()) {
        $this->db->set('modified', 'NOW()', FALSE);
        $this->db->where_in('id', $id);
        $this->db->set('status', '-1');
        return $this->db->update($this->_tbl_users);
    }

}
