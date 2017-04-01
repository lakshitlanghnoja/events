<?php

/**
 *  Events Model
 *
 *  To perform queries related to user management.
 *
 * @package CIDemoApplication
 * @subpackage Users
 * @copyright	(c) 2013, TatvaSoft
 * @author panks
 */
class Event_model extends Base_Model {

    protected $_tbl_events = TBL_event;
    protected $_tbl_users = TBL_USERS;
    protected $_tbl_event_rating = TBL_event_rating;
    protected $_tbl_event_join = TBL_event_join;

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
    
    public function getEventRatings($eventId){
        $this->db->select("AVG(er.rate) as event_rating");
        $this->db->from($this->_tbl_event_rating. ' AS er');
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
    
    public function getEventJoinedUser($eventId){
        $this->db->select("sum(ej.number_of_sheets) as userJoined");
        $this->db->from($this->_tbl_event_join. ' AS ej');
        $this->db->join($this->_tbl_events . ' as e', ('e.id = ej.event_id'), 'inner');
        $this->db->where('ej.event_id', $eventId);        
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
}
