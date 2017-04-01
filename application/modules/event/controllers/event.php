<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  CMS Controller
 *
 *  CMS controller to display cms page in front site.
 *  Also dispaly default page of cms.
 * 
 * @package CIDemoApplication
 
 */
class Event extends Base_Front_Controller
{
    /*
     * Create an instance
    */
    function __construct()
    {
        parent::__construct();
        //load helpers
        $this->load->helper(array('url', 'cookie'));
        //load theme        
        $this->theme->set_theme("events");              
    }

    /**
     * action to display language wise cms page based on slug url
     * @param string $slug_url
     */
    function index($slug_url = NULL)
    {             
        if($slug_url == '' || $slug_url == NULL){
            redirect('/');
        }
        $eventData = $this->event_model->getEventDetailBySlug($slug_url);   
        if(isset($eventData['id']) && !empty($eventData['id'])){
            $eventRatings = $this->event_model->getEventRatings($eventData['id']);   
            if(isset($eventRatings['event_rating']) && !empty($eventRatings['event_rating'])){
                $eventData['event_rating'] = $eventRatings['event_rating'];
            }
            
            $userJoined = $this->event_model->getEventJoinedUser($eventData['id']);
            if(isset($userJoined['userJoined']) && !empty($userJoined['userJoined'])){
                $eventData['userJoined'] = $userJoined['userJoined'];
            }
        }
        $this->theme->view($eventData);
    }

}

?>