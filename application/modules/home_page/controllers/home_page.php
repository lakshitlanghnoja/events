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
class Home_Page extends Base_Front_Controller
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
        $this->theme->view();
    }

    

}

?>